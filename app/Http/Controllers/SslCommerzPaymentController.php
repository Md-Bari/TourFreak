<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SslCommerzPaymentController extends Controller
{
    /**
     * Show the hosted payment form (exampleHosted.blade.php)
     */
    public function showPaymentForm(Request $request)
    {
        // You should pass the package info and amount to the view from the previous page
        // Assuming $request has package_id and amount, or you get the package here by id
        // For example:
        // $package = TourPackage::findOrFail($request->package_id);
        // return view('exampleHosted', compact('package'));

        // But for demo, just pass request data:
        return view('exampleHosted', [
            'package_id' => $request->package_id,
            'amount' => $request->amount,
            'customer_name' => Auth::user()->name ?? '',
            'customer_mobile' => Auth::user()->phone ?? '',
            'customer_email' => Auth::user()->email ?? '',
        ]);
    }

    /**
     * Process the payment request from the form and initiate SSLCommerz payment
     */
    public function pay(Request $request)
    {
        // Validate inputs including package_id
        $request->validate([
            'package_id'       => 'required|integer|exists:tour_packages,id',
            'customer_name'    => 'required|string|max:255',
            'customer_mobile'  => 'required|string|max:20',
            'customer_email'   => 'nullable|email|max:255',
            'amount'           => 'required|numeric|min:1',
        ]);

        // Generate unique transaction ID
        $transaction_id = Str::uuid()->toString();

        // Save order info to DB with package_id included
        $order = Order::create([
            'package_id'      => $request->package_id,
            'user_name'       => $request->customer_name,
            'user_phone'      => $request->customer_mobile,
            'user_email'      => $request->customer_email ?? 'noemail@example.com',
            'total_price'     => $request->amount,
            'transaction_id'  => $transaction_id,
            'status'          => 'Pending',
            'user_id'         => Auth::id() ?? null,
        ]);

        // Prepare data for SSLCommerz
        $post_data = [
            'total_amount'    => $order->total_price,
            'currency'        => "BDT",
            'tran_id'         => $transaction_id,

            // Customer Information
            'cus_name'        => $order->user_name,
            'cus_email'       => $order->user_email,
            'cus_add1'        => $request->address ?? 'N/A',
            'cus_add2'        => $request->address2 ?? '',
            'cus_city'        => $request->state ?? 'N/A',
            'cus_state'       => $request->state ?? 'N/A',
            'cus_postcode'    => $request->zip ?? '1000',
            'cus_country'     => $request->country ?? 'Bangladesh',
            'cus_phone'       => $order->user_phone,
            'cus_fax'         => '',

            // Shipping Information (can be same as billing)
            'ship_name'       => $order->user_name,
            'ship_add1'       => $request->address ?? 'N/A',
            'ship_add2'       => $request->address2 ?? '',
            'ship_city'       => $request->state ?? 'N/A',
            'ship_state'      => $request->state ?? 'N/A',
            'ship_postcode'   => $request->zip ?? '1000',
            'ship_country'    => $request->country ?? 'Bangladesh',

            // URLs to handle payment response
            'success_url'     => route('payment.success'),
            'fail_url'        => route('payment.fail'),
            'cancel_url'      => route('payment.cancel'),

            // Product Info
            'product_name'    => 'Tour Package',
            'product_category'=> 'Tour',
            'product_profile' => 'general',
        ];

        // Initialize SSLCommerz payment gateway library
        $sslc = new \App\Library\SslCommerz\SslCommerzNotification();

        // Make payment request (hosted checkout)
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            // Payment initialization failed - show error
            return redirect()->back()->with('error', 'Payment initialization failed!');
        }

        // Return payment redirect response (usually a redirect)
        return $payment_options;
    }

    /**
     * Success callback URL
     */
    public function paymentSuccess(Request $request)
    {
        $order = Order::where('transaction_id', $request->tran_id)->first();

        if ($order) {
            $order->status = 'Paid';
            $order->save();
        }

        return redirect()->route('home')->with('success', 'Payment successful! Thank you.');
    }

    /**
     * Fail callback URL
     */
    public function paymentFail(Request $request)
    {
        $order = Order::where('transaction_id', $request->tran_id)->first();

        if ($order) {
            $order->status = 'Failed';
            $order->save();
        }

        return redirect()->route('home')->with('error', 'Payment failed! Please try again.');
    }

    /**
     * Cancel callback URL
     */
    public function paymentCancel(Request $request)
    {
        $order = Order::where('transaction_id', $request->tran_id)->first();

        if ($order) {
            $order->status = 'Cancelled';
            $order->save();
        }

        return redirect()->route('home')->with('error', 'Payment cancelled.');
    }
}
