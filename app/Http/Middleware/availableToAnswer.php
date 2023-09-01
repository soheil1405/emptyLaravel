<?php

namespace App\Http\Middleware;

use App\Models\user_answer;
use Closure;
use Illuminate\Http\Request;
use App\Models\questions;
use Illuminate\Support\Facades\Auth;

class availableToAnswer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $today = new \DateTime('today');
        $tomorrow = new \DateTime('tomorrow');
        $todays = questions::whereBetween('time', [ $today , $tomorrow])->first();



        if(is_null($todays)){


       session()->flash('notAvailable' , 'سوالی برای امروز طراحی نشده است');
            return redirect()->back();
     

        }


        $user = Auth::user();


        $answerd = user_answer::where('question_id' , $todays->id)
                                ->where('user_id', $user->id)->first();
                                
                                
        if(!is_null($answerd)){
   
            session()->flash('notAvailable' , 'شما قبلا به سوال امروز پاسخ داده اید');

            return redirect()->route('user.questions.show' , ['id'=>$todays->id]) ;
   
        }



        if( !is_null($user) &&  $user->mojoodi == 0 && $user->role->role_id != 2){

            


            return redirect()->route('payment.paymentPage');
        }




        return $next($request);
    }
}
