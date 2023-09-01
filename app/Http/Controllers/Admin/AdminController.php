<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_answer;
class AdminController extends Controller
{
    public function index(){

        // i have to edit here ... for best performans i have to save this counts inside another table ...
        $currectAnswers  = user_answer::where('status' , 1)->get();

        $wrongAnswers = user_answer::where('status' , "!=" , 1)->get();





        return view('admin.dashboard.dashboard' ,compact( 'currectAnswers' , 'wrongAnswers'));



    }
}
