<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification Code</title>
</head>
<body style="margin:0; padding:0; background:#f4f7f4; font-family:Arial, sans-serif; color:#162032;">
    <div style="max-width:620px; margin:0 auto; padding:32px 18px;">
        <div style="background:#ffffff; border-radius:24px; overflow:hidden; box-shadow:0 20px 50px rgba(15,23,42,0.08);">
            <div style="background:linear-gradient(135deg,#0f172a,#0f766e); padding:28px; color:#ffffff;">
                <div style="display:inline-block; padding:10px 14px; border-radius:14px; background:rgba(255,255,255,0.12); font-weight:700; letter-spacing:0.08em;">
                    TOURFREAK
                </div>
                <h1 style="margin:18px 0 8px; font-size:28px; line-height:1.2;">Verify your email address</h1>
                <p style="margin:0; color:rgba(255,255,255,0.82); font-size:15px;">Use the code below to complete your registration.</p>
            </div>

            <div style="padding:30px 28px;">
                <p style="margin:0 0 14px; font-size:15px;">Hello {{ $user->name }},</p>
                <p style="margin:0 0 20px; color:#667085; font-size:15px; line-height:1.7;">
                    Your one-time verification code for TourFreak is:
                </p>

                <div style="margin:0 0 22px; padding:18px; border-radius:20px; background:#edf4ef; text-align:center;">
                    <span style="font-size:34px; font-weight:800; letter-spacing:0.22em; color:#0f766e;">
                        {{ $user->otp_code }}
                    </span>
                </div>

                <p style="margin:0 0 10px; color:#667085; font-size:14px; line-height:1.7;">
                    This code will expire in 10 minutes. If you did not create this account, you can ignore this email.
                </p>

                <p style="margin:24px 0 0; font-size:13px; color:#98a2b3;">
                    Sent by TourFreak verification system
                </p>
            </div>
        </div>
    </div>
</body>
</html>
