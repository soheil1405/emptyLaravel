<?php

namespace App\Http\Controllers\Admin;

use App\Models\payment;
use App\Models\QuestionPay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
class SettingControler extends Controller
{



    public function index(){

        $setting = QuestionPay::first();

        $payments = payment::OrderByDesc('id')->get();


        $todays = payment::whereDate('created_at', Carbon::today())->where('status' , 1)->get();


        $all = payment::where('status' , 1)->get();


        $allpays = 0;
        $allBuys = 0;
        $allpaysCount = 0;



        $todasyPay = 0;
        $todaysBuys = 0;
        $todaysCount = 0;

        foreach ($all as $pays ) {
            $allpaysCount++;
            $allpays += $pays ->totalAmount;
            $allBuys += $pays->PaymentCount;
        }


        foreach ($todays as $pays ) {
           
            $todasyPay += $pays ->totalAmount;
            $todaysBuys += $pays->PaymentCount;
            $todaysCount ++;
        }



        
        
        return view('admin.setting.index' ,
         compact('setting' , 'payments' ,'allpaysCount' , 'todaysCount', 'todasyPay' , 'todaysBuys' , 'allpays' , 'allBuys'));
    }
    





    public function edit(Request $request){

        $setting = QuestionPay::first();

        $setting->update([

            'pay'=>$request->pay 
        ]);


        session()->flash('edited' , 'مبلغ سوال با موقیت تغییر کرد');
        return redirect()->back();

    }



}
