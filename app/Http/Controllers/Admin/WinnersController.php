<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\questions;
use App\Models\Winners;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WinnersController extends Controller
{

    public function index()
    {

        $winners = Winners::all();

        // dd($winners[0]->question);

        return view('admin.winners.index', compact('winners'));

    }

    public function show(Request $request, $id)
    {


        $question = questions::findOrFail($id);
        $today = new \DateTime('today');
        $tomorrow = new \DateTime('tomorrow');
   


        // $Qtimep
        


        $todaysQuestion = questions::whereBetween('time', [ $today , $tomorrow])->first();


        if(is_null($todaysQuestion)){
            $winner = $question->userWinner[0];
            
            $firstName = $winner->user->firstname;

            $lastName = $winner->user->lastname;

            $fullName = $firstName . "-" . $lastName;


        }else{
            $winner = null;
            $fullName = null;
        }

        $userWrongAnswers = $question->userWrongAnswers;

        $userCurrectAnswers = $question->userCurrectAnswers;

        $userAnswers = $question->userAnswers;

        $userWinner = $question->userWinner;


        


        if ($request->has('showBy')) {
            $variable = $request->showBy;
            switch ($variable) {
                case 'all':
                    $userAnswers = $question->userAnswers;
                    break;
              
                case 'currects':
                    $userAnswers = $question->userCurrectAnswers;
                    break;

                case 'wrongs':
                    $userAnswers = $question->userWrongAnswers;
                    break;

                default:
                    $userAnswers = $question->userAnswers;
                    break;
            }
        }

        return view('admin.winners.show', compact( 'question' , 'winner', 'fullName', 'userWrongAnswers', 'userCurrectAnswers', 'userAnswers', 'userWinner'));

    }




    public function userIndex(){
        $winners = Winners::all();

        // dd($winners[0]->question);

        return view('user.winners.index', compact('winners'));
    }



























}
