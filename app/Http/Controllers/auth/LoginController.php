<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\auth\authverifyCode;

use Carbon\Carbon;

class LoginController extends Controller
{

    public function gotoLoginPage()
    {

        $user = Auth::user();

        if (!is_null($user)) {
            return redirect()->route('home');
        } else {
            return view('auth.login');
        }
    }

    public function Login(Request $request)
    {



        if ($request->type == "forgot") {



            // $request->validate([

            //     'number' => 'required|digits:11|exists:users,number',
            // ]);

            $user = User::where('number', $request->number)->first();





            if (is_null($user)) {
                
                return response()->json('شماره وارد شده معتبر نیست' , 403);
            }

            session()->put('number' , $user->number);

            return redirect()->route('auth.sendForgotPassCode');




        } else {

            $request->validate([
                'password' => 'required|min:4',
                'number' => 'required|digits:11|exists:users,number',
            ]);



            $user = User::where('number', $request->number)->first();


            if ($user) {
                $check = Hash::check($request->password, $user->password);

                if ($check) {
                    Auth::login($user);

                    session()->flash('wellcome', 'خوش آمدید');

                    if (Auth::user()->role->role_id != 2) {


                        return redirect()->route('home');


                    } else {
                        return redirect()->route('adminn.panel');

                    }


                } else {

                    session()->flash('customError', 'رمز عبور وارد شده اشتباه است');
                    return redirect()->back();
                }


            } else {

                session()->flash('customError', 'کاربری با این مشخصات یافت نشد ');
                return redirect()->back();

            }



        }





    }

    public function logout()
    {
        $user = Auth::user();


        Auth::logout($user);

        return redirect()->route('home');
    }
}