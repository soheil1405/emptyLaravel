<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\auth\authverifyCode;
use App\Models\cities;
use App\Models\classLevels;
use App\Models\Fileds_of_studys;
use App\Models\User;
use App\Models\user_roles;
use App\Notifications\OtpNotification;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function gotoRegisterPage()
    {
        $user = Auth::user();

        if (!is_null($user)) {

            if ($user->mobile_verified_at) {
                return redirect()->route('home');
            } else {
                return redirect()->route('verifyMobile');

            }
        } else {
            $cities = cities::all();
            $class_levels = classLevels::all();
            $fields_of_study = Fileds_of_studys::all();

            return view('auth.register', compact('cities', 'class_levels', 'fields_of_study'));
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required|digits:11',
            'city' => 'required',
            'classLevel' => 'required',
            'Field_of_Study' => 'required',
            'password' => 'required|min:4|same:password_confirmation',
            'password_confirmation' => 'required',
        ]);



        $user = Auth::user();



        if (!is_null($user)) {

            if ($user->mobile_verified_at) {
                return redirect()->route('home');
            } else {
                return redirect()->route('verifyMobile');

            }


        } else {


            $sameNumber = User::where('number', $request->mobile)->first();

            if ($sameNumber) {
                session()->flash('customError', 'این شماره تلفن قبلا در سیستم ثبت نام کرده است ...');
                return redirect()->back();

            } else {
                $pass = Hash::make($request->password);

                $check = hash::check($request->password, $pass);

                if ($check) {
                    $user = User::create([
                        'firstname' => $request->first_name,
                        'lastname' => $request->last_name,
                        'number' => $request->mobile,
                        'city_id' => $request->city,
                        'class_level_id' => $request->classLevel,
                        'fileds_of_studys_id' => $request->Field_of_Study,
                        'password' => $pass,
                    ]);

                    user_roles::create([
                        'user_id' => $user->id,
                        'role_id' => '1',
                    ]);



                    $code = authverifyCode::create([
                        'user_id' => $user->id,
                        'code' => rand(10000, 99999),
                        'for' => 'mobile'
                    ]);


                    if ($user) {
                        Auth::login($user);
                        return redirect()->route('home');
                    } else {
                        Session::flash('customError', 'عملیات با شکست مواجه شد ...');

                        return redirect()->back();
                    }


                    return rdirect()->route('verifyMobile');
                } else {


                    Session::flash('customError', 'عملیات با شکست مواجه شد ...');

                    return redirect()->back();


                }
            }
        }
    }
}