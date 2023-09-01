<?php

namespace App\Http\Controllers;

use App\Models\payment;
use App\Models\QuestionPay;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\Orders;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function paymentPage()
    {




        $payments = Auth::user()->Payments;

        // dd($payments);

        $QuestionPay = QuestionPay::first();

        return view('user.payment.payment' , compact('payments' , 'QuestionPay'));
    }

    public function payment(Request $request)
    {

        $pay = QuestionPay::first()->pay;

        $Amount = $pay * $request->count; //Amount will be based on Toman - Required

        $data = array(
            'MerchantID' => "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
            'Amount' => 1000,
            'CallbackURL' => route('payment.verify'),
            'Description' => 'خرید تست',
        );

        $jsonData = json_encode($data);
        $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData),
        ));

        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);

        curl_close($ch);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($result["Status"] == 100) {

                $payment = payment::create([
                    'user_id' => Auth::user()->id,
                    'PaymentCount' => $request->count,
                    'totalAmount' => $Amount,

                ]);

                return redirect()->to("https://sandbox.zarinpal.com/pg/StartPay/" . $result["Authority"]);

                // $array = ['Authority'=>$result["Authority"]];
                // header('Content-Type: application/json');
                // echo json_encode($array);
            } else {
                echo 'ERR: ' . $result["Status"];
            }
        }

    }

    public function verifyy(Request $request)
    {

        $MerchantID = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";

        $Authority = $request->Authority;

        $data = array('MerchantID' => $MerchantID, 'Authority' => $Authority, 'Amount' => 1000);
        $jsonData = json_encode($data);
        $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData),
        ));

        $result = curl_exec($ch);

        $err = curl_error($ch);
        curl_close($ch);

        $result = json_decode($result, true);
        $payment = Auth::user()->lastPayment;

        $order = new Orders();

        $order->user_id  = Auth::user()->id ;
        $order->payment_id   = $payment->id;
        
        $order->ref_id = $result['RefID'];
        $order->callback_url =  route('payment.verify');
        $order->status = $result['Status'];


        $order->save();


        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($result['Status'] == 100) {



                





                

                
                $user = User::findOrFail($payment->user_id);

                $payment->update([
                    'status'=> 1
                ]);

                $mojoodi = $payment->PaymentCount + $user->mojoodi;
             


                $user->update([
                    'mojoodi' => $mojoodi,

                ]);
        

                // $query = query("UPDATE orders SET order_refid='{$result['RefID']}' order by order_id desc limit 1");

                session()->flash('PaymentSuccess', 'پرداخت شما با موفقیت انجام شد و حساب کاربری شما شارز  شد');

                return redirect()->route('payment.paymentPage');

            } else {

                session()->flash('PaymentFail', 'عملیات پرداخت با شکست مواجه شد');

                return redirect()->route('payment.paymentPage');

            }
        }
    }

}
