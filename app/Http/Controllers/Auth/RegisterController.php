<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpVerificationMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Throwable;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = null;

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
            ]);

            $this->issueOtp($user);
            $this->sendOtpEmail($user);
            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();

            Log::error('Failed to send registration OTP email.', [
                'user_id' => $user?->id,
                'email' => $request->email,
                'error' => $exception->getMessage(),
            ]);

            return redirect()->route('register.create')
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors([
                    'email' => $this->mailErrorMessage($exception),
                ]);
        }

        return redirect()->route('otp.verify.form', $user->id)
            ->with('status', 'We have sent you an OTP to your email. Please verify.');
    }

    public function showOtpForm($id)
    {
        $user = User::findOrFail($id);
        return view('auth.verify-otp', compact('user'));
    }

    public function resendOtp($id)
    {
        $user = User::findOrFail($id);

        $this->issueOtp($user);

        try {
            $this->sendOtpEmail($user);
        } catch (Throwable $exception) {
            Log::error('Failed to resend OTP email.', [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $exception->getMessage(),
            ]);

            return back()->withErrors([
                'otp' => 'The OTP could not be emailed right now. Please check your mail configuration and try again.',
            ]);
        }

        return back()->with('status', 'A new OTP has been sent to your email address.');
    }

    public function verifyOtp(Request $request, $id)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user = User::findOrFail($id);

        if (
            $user->otp_code &&
            $user->otp_code == $request->otp &&
            $user->otp_expires_at &&
            now()->lt($user->otp_expires_at)
        ) {
            $user->email_verified_at = now();
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->save();

            event(new Registered($user));
            Auth::login($user);

            return redirect()->route('home')->with('status', 'Your email has been verified successfully!');
        }

        return back()->withErrors(['otp' => 'Invalid or expired OTP']);
    }

    protected function issueOtp(User $user): void
    {
        $user->forceFill([
            'otp_code' => (string) random_int(100000, 999999),
            'otp_expires_at' => now()->addMinutes(10),
        ])->save();
    }

    protected function sendOtpEmail(User $user): void
    {
        Mail::to($user->email)->send(new OtpVerificationMail($user));
    }

    protected function mailErrorMessage(Throwable $exception): string
    {
        $message = $exception->getMessage();

        if (str_contains($message, 'Username and Password not accepted')) {
            return 'Gmail rejected the login. Use your full Gmail address as MAIL_USERNAME and a valid 16-character Gmail App Password as MAIL_PASSWORD.';
        }

        if (str_contains($message, 'does not comply with addr-spec')) {
            return 'MAIL_FROM_ADDRESS is invalid. Use a full email address like yourname@gmail.com.';
        }

        if (str_contains($message, 'Connection could not be established')) {
            return 'Mail server connection failed. For Gmail, set MAIL_HOST=smtp.gmail.com, MAIL_PORT=587, and MAIL_ENCRYPTION=tls.';
        }

        if ($exception instanceof TransportExceptionInterface) {
            return 'Email verification could not be sent because the mail transport failed. Please check your Gmail SMTP settings and try again.';
        }

        return 'Email verification could not be sent. Please check your Gmail SMTP settings and try again.';
    }
}
