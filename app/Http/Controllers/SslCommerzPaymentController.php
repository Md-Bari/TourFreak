<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Library\SslCommerz\SslCommerzNotification;

class SslCommerzPaymentController extends Controller
{
    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders_ssl"
        # In "orders_ssl" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        // Pull user (if logged in) and merge with posted form data
        $user = Auth::user();

        // Amount: respect the "cannot pay less than 10" rule
        $incomingAmount = (float) ($request->input('amount') ?? $request->input('total_amount') ?? 10);
        $totalAmount = max(10, $incomingAmount);

        // Customer details from form (fallback to user if present)
        $cus_name  = $request->input('customer_name')  ?? ($user->name  ?? 'Customer Name');
        $cus_email = $request->input('customer_email') ?? ($user->email ?? 'customer@mail.com');
        $cus_phone = $request->input('customer_mobile') ?? $request->input('customer_phone') ?? ($user->phone ?? '8801XXXXXXXXX');

        // Address may come as "customer_address" (our recommended) or "address" (original demo field had no name)
        $cus_address = $request->input('customer_address') ?? $request->input('address') ?? ($user->address ?? 'Customer Address');

        $post_data = array();
        $post_data['total_amount'] = (string) $totalAmount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $cus_name;
        $post_data['cus_email'] = $cus_email;
        $post_data['cus_add1'] = $cus_address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "Dhaka";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $cus_phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = $cus_name;
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = $cus_phone;
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Booking Payment";
        $post_data['product_category'] = "Goods";

        // Use app URLs (keeps your original endpoints)
        $post_data['success_url'] = url('/');             // original: http://127.0.0.1:8000
        $post_data['fail_url']    = url('/fail');         // original: http://127.0.0.1:8000/fail
        $post_data['cancel_url']  = url('/cancel');       // original: http://127.0.0.1:8000/cancel
        $post_data['ipn_url']     = url('/ipn');          // original: http://127.0.0.1:8000/ipn
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        DB::table('orders_ssl')->updateOrInsert(
            ['transaction_id' => $post_data['tran_id']], // unique key
            [
                'name'           => $post_data['cus_name'],
                'email'          => $post_data['cus_email'],
                'phone'          => $post_data['cus_phone'],
                'amount'         => $post_data['total_amount'],
                'status'         => 'Pending',
                'address'        => $post_data['cus_add1'],
                'currency'       => $post_data['currency'],
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        );

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function payViaAjax(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders_ssl"
        # In orders_ssl table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        // Pull user (if logged in) and merge with posted form data
        $user = Auth::user();

        $incomingAmount = (float) ($request->input('amount') ?? $request->input('total_amount') ?? 10);
        $totalAmount = max(10, $incomingAmount);

        $cus_name  = $request->input('customer_name')  ?? ($user->name  ?? 'Customer Name');
        $cus_email = $request->input('customer_email') ?? ($user->email ?? 'customer@mail.com');
        $cus_phone = $request->input('customer_mobile') ?? $request->input('customer_phone') ?? ($user->phone ?? '8801XXXXXXXXX');
        $cus_address = $request->input('customer_address') ?? $request->input('address') ?? ($user->address ?? 'Customer Address');

        $post_data = array();
        $post_data['total_amount'] = (string) $totalAmount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $cus_name;
        $post_data['cus_email'] = $cus_email;
        $post_data['cus_add1'] = $cus_address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "Dhaka";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $cus_phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = $cus_name;
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = $cus_phone;
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Booking Payment";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to update as Pending.
        DB::table('orders_ssl')->updateOrInsert(
            ['transaction_id' => $post_data['tran_id']],
            [
                'name'           => $post_data['cus_name'],
                'email'          => $post_data['cus_email'],
                'phone'          => $post_data['cus_phone'],
                'amount'         => $post_data['total_amount'],
                'status'         => 'Pending',
                'address'        => $post_data['cus_add1'],
                'currency'       => $post_data['currency'],
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        );

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        $order_details = DB::table('orders_ssl')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')
            ->first();

        if ($order_details && $order_details->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                DB::table('orders_ssl')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing', 'updated_at' => now()]);

                return redirect()->route('home')->with('success', 'Payment Successful!');
            } else {
                return redirect()->route('home')->with('error', 'Payment Validation Failed!');
            }
        } elseif ($order_details && ($order_details->status == 'Processing' || $order_details->status == 'Complete')) {
            return redirect()->route('home')->with('success', 'Payment Already Completed!');
        } else {
            return redirect()->route('home')->with('error', 'Invalid Transaction!');
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders_ssl')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')
            ->first();

        if ($order_details && $order_details->status == 'Pending') {
            DB::table('orders_ssl')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed', 'updated_at' => now()]);

            return redirect()->route('home')->with('error', 'Payment Failed!');
        } elseif ($order_details && ($order_details->status == 'Processing' || $order_details->status == 'Complete')) {
            return redirect()->route('home')->with('success', 'Payment Already Successful!');
        } else {
            return redirect()->route('home')->with('error', 'Invalid Transaction!');
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders_ssl')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')
            ->first();

        if ($order_details && $order_details->status == 'Pending') {
            DB::table('orders_ssl')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled', 'updated_at' => now()]);

            return redirect()->route('home')->with('error', 'Payment Canceled!');
        } elseif ($order_details && ($order_details->status == 'Processing' || $order_details->status == 'Complete')) {
            return redirect()->route('home')->with('success', 'Payment Already Successful!');
        } else {
            return redirect()->route('home')->with('error', 'Invalid Transaction!');
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {
            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders_ssl')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if (!$order_details) {
                echo "Invalid Transaction";
                return;
            }

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate(
                    $request->all(),
                    $tran_id,
                    $order_details->amount,
                    $order_details->currency
                );

                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    DB::table('orders_ssl')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing', 'updated_at' => now()]);

                    echo "Transaction is successfully Completed";
                } else {
                    DB::table('orders_ssl')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed', 'updated_at' => now()]);

                    echo "Validation Failed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}
