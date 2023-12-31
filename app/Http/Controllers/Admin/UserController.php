<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\auth\authverifyCode;
use App\Models\cities;
use App\Models\classLevels;
use App\Models\Fileds_of_studys;
use App\Models\User;
use App\Models\user_roles;
use Carbon\Carbon;
use Hekmatinasser\Verta\Laravel\JalaliValidator;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;
use App\Models\auth\authverifyEmail;


class UserController extends Controller
{
    public function index()
    {

        $rols = user_roles::OrderByDesc('id')->get();

        return view('admin.users.index', compact('rols'));

    }

    public function dashboard()
    {

        $user = Auth::user();



        // $now = Jalalian::now();

        // dd($now);


        //    $now =  Carbon::now();

        //    $v = new \Hekmatinasser\Verta\Facades\Verta($now);



        //     dd($v);
        return view('user.dashboard.dashboard', compact('user'));
    }

    public function show($user, Request $request)
    {

        $user = User::findOrFail($user);

        $userAnswers = $user->userAnswers;

        if ($request->showBy) {
            $variable = $request->showBy;

            switch ($variable) {
                case 'all':
                    $userAnswers = $user->userAnswers;
                    break;
                case 'currects':
                    $userAnswers = $user->userCurrectAnswers;
                    break;

                case 'wrongs':
                    $userAnswers = $user->userWrongAnswers;
                    break;

                case 'wins':
                    $userAnswers = $user->Winns;
                    break;

                default:
                    # code...
                    break;
            }

        }

        return view('admin.users.show', compact('user', 'userAnswers'));

    }

    public function Competition()
    {

        $users = User::OrderBy('allAnwers_count')->where('CurrectAnwers_count' , '>' , 0)->OrderByDesc('CurrectAnwers_count')->take(20)->get();



        // dd($users);


        return view('user.competition.index', compact('users'));
    }

    public function destroy(User $user, Request $request)
    {

        $user = User::findOrFail($request->Uid);

        foreach ($user->userAnswers as $answer) {

            $answer->delete();

        }

        foreach ($user->winns as $win) {

            $win->delete();

        }

        foreach ($user->userAnswers as $answer) {

            $answer->delete();

        }

        foreach (user_roles::where('user_id', $user->id)->get() as $rol) {
            $rol->delete();
        }

        $user->delete();

        session()->flash('deleteStatus', 'کاربر  موردنظر با موفقیت حذف شد');

        return redirect()->back();

    }

    public function edit(User $user)
    {

        $cities = cities::all();
        $class_levels = classLevels::all();
        $fields_of_study = Fileds_of_studys::all();

        return view('admin.users.edit', compact('user', 'cities', 'class_levels', 'fields_of_study'));

    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required|digits:11',
            'email' => 'required|email',
            'city' => 'required',
            'classLevel' => 'required',
            'Field_of_Study' => 'required',
        ]);

        $user = User::findOrFail($request->userId);

        $user->update([
            'firstname' => $request->first_name,
            'lastname' => $request->last_name,
            'number' => $request->mobile,
            'city_id' => $request->city,
            'email' => $request->email,
            'class_level_id' => $request->classLevel,
            'fileds_of_studys_id' => $request->Field_of_Study,

        ]);

        session()->flash('edited', 'کاربر مورد نظر با موفقیت ویرایش شد');
        return redirect()->route('adminn.users.index');
    }




    public function checkNumber(Request $request)
    {


        // $request->validate([
        //     'number' => 'exists:users,number|digits:11'
        // ]);


        $user =User::where('number', $request->number)->first();

        if (is_null($user)) {
            return response()->json('user not found', 401);
        } else {

            return response()->json('ok', 200);



        }






    }



public function showUser( Request $request , $id){


$user= User::findOrFail($id);


$userAnsers = $user->userAnswers;
$wins = "null";

if ($request->has('showBy')) {

    $variable = $request->showBy;
    switch ($variable) {
        case 'all':
            $userAnsers = $user->userAnswers;

            break;
        case 'wins':
            $wins = $user->winns;
            $userAnsers = null;
            break;
        case 'corrects':
            $userAnsers = $user->userCurrectAnswers;
            break;
        case 'wrongs':
            $userAnsers = $user->userWrongAnswers;
            break;

        default:
            $userAnsers = $user->userAnswers;
            break;
    }

}

return view('user.history.index', compact('userAnsers'  , 'wins' , 'user'));

}
}
