<?php

namespace App\Http\Controllers;

use App\Models\Answers;
use App\Models\questions;
use App\Models\User;
use App\Models\user_answer;
use App\Models\Winners;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{

    public function index()
    {


        $mytime = Carbon::now();
        $questions = questions::whereDate('time' , '!=' , $mytime)->OrderByDesc('time')->get();

        $todays = questions::whereDate('time', $mytime)->first();

        return view('admin.questions.index', compact('questions', 'todays'));

    }

    public function create()
    {


        return view('admin.questions.create');

    }

    public function store(Request $request)
    {



        $request->validate([
            'question_img' => 'required',
            'correctAnswer' => 'required',
            'date' => 'required',
            'time'=>'required'
        ]);

        $filename = Carbon::now() . $request->question_img->getClientOriginalName();

        $request->question_img->move('upload/questions/imgs/', $filename);

        $question = questions::where('time', Carbon::parse($request->date)->format('Y-m-d'))->first();

        if (!is_null($question)) {

            session()->flash('fail', 'شما قبلا سوالی را برای برای تاریخ ' . $request->date . ' ذخیره کزده اید');
            return redirect()->back();
        }


        $today = new \DateTime();


        if(Carbon::parse($request->date)->format('Y-m-d') < $today->format('Y-m-d')){

            session()->flash('fail',  'اشتباه در درج تاریخ ، شما تاریخ مربوط به گذشته را انتخاب کرده اید');
            return redirect()->back();


        }

        // dd($request->time);
        $question = questions::create([
            'q_image' => $filename,
            'cucrrect_answer_item' => $request->correctAnswer,
            'answer_time'=>$request->time ,
            'time' => Carbon::parse($request->date),

        ]);


        if ($question) {

            $questions = questions::all();
            session()->flash('created', 'سوال حدید برای تاریخ ' . $request->date . 'موفقیت ذخیره شد');

            return redirect()->route('adminn.questions.index');
        }

    }
    public function show($questions, Request $request)
    {

        $questions = questions::find($questions);

        $today = new \DateTime('today');
        $tomorrow = new \DateTime('tomorrow');
        $todaysQuestion = questions::whereBetween('time', [$today, $tomorrow])->first();

        $userWrongAnswers = $questions->userWrongAnswers;

        $userCurrectAnswers = $questions->userCurrectAnswers;

        $userAnswers = $questions->userAnswers;

        $userWinner = $questions->userWinner;

        // dd($userAnswers);

        if ($request->has('showBy')) {
            $variable = $request->showBy;
            switch ($variable) {
                case 'all':
                    $userAnswers = $questions->userAnswers;
                    break;

                case 'currects':
                    $userAnswers = $questions->userCurrectAnswers;
                    break;

                case 'wrongs':
                    $userAnswers = $questions->userWrongAnswers;
                    break;

                default:
                    $userAnswers = $questions->userAnswers;
                    break;
            }
        }

        return view('admin.questions.show', compact('questions', 'userWrongAnswers', 'userCurrectAnswers', 'userAnswers', 'userWinner'));

    }

    public function edit($id)
    {

        $question = questions::findOrFail($id);
        return view('admin.questions.edit', compact('question'));

    }

    public function update(Request $request)
    {


        $request->validate([
            'id' => 'required',
            'correctAnswer' => 'required',
            'time'=>'required',

        ]);

        $question = questions::findOrFail($request->id);


            $qu = questions::where('time', $request->date)->first();



        $question->update([
            'cucrrect_answer_item' => $request->correctAnswer,
            'answer_time'=>$request->time ,
        ]);

        if ($question) {

            $questions = questions::all();
            session()->flash('edited', 'سوال مورد نظر با موفقیت ویرایش شد ...');

        }
        return redirect()->route('adminn.questions.index');

    }

    public function destroy(Request $request)
    {



        $question = questions::findOrFail($request->qid);


        $time = $question->time;

        $myTime = Carbon::now();

        $qTime =  Carbon::parse($time);


        $date = Carbon::parse($time);



        if($time >  $myTime){

            $question->delete();

            session()->flash('deleteStatus' , 'سوال تاریخ '.$time.' با موفقیت حذف شد');


        }else{

            session()->flash('deleteStatus' , 'شما نمیتوانید سوال های تاریخ گذشته را حذف کنید');

        }



        return redirect()->back();


    }

    public function updateImg(Request $request)
    {

        $request->validate([
            'id' => 'required',
        ]);

        $question = questions::findOrFail($request->id);

        $filename = Carbon::now() . $request->question_img->getClientOriginalName();

        $request->question_img->move('upload/questions/imgs/', $filename);

        $question->update([
            'q_image' => $filename,
        ]);

        return redirect()->back();

    }

    public function exam()
    {

        $mytime = Carbon::now();
        $todays = questions::whereDate('time', $mytime)->first();

        if ($todays) {
            return view('exam.index', compact('todays'));

        } else {
            return view('exam.noQuestionForToday');
        }

    }

    public function answer(Request $request)
    {

        $request->validate([

            'user_id' => 'required',
            'question_id' => 'required',
            'Answer' => 'required|integer',
        ]);

        $user = User::findOrFail($request->user_id);

        if (!$user) {
            session()->flash('notAvailable', 'خطای سیستمی');
            return redirect()->route('user.panel');

        }

        $today = new \DateTime('today');
        $tomorrow = new \DateTime('tomorrow');
        $todays = questions::whereBetween('time', [$today, $tomorrow])->first();

        $answerd = user_answer::where('question_id', $todays->id)
            ->where('user_id', $request->user_id)->first();

        if (!is_null($answerd)) {
            session()->flash('notAvailable', 'شما قبلا به سوال امروز پاسخ داده اید');
            return redirect()->route('user.panel');
        }

        $choiced = $request->Answer;

        $currect = $todays->cucrrect_answer_item;

        $user_last_allAnwers_count = $user->allAnwers_count;

        $user_last_CurrectAnwers_count = $user->CurrectAnwers_count;

        $user_last_WrongAnwers_count = $user->WrongAnwers_count;






        if ($choiced == $currect) {

            $user_answer = user_answer::create([

                'question_id' => $request->question_id,
                'user_id' => $request->user_id,
                'choiced_answer_item' => $request->Answer,
                'status' => '1',
            ]);

            $allcounts = $todays->allAnswersCount + 1;

            $currectCount = $todays->CurrectAnswersCount + 1;
            $todays->update([

                'allAnswersCount' => $allcounts,
                'CurrectAnswersCount' => $currectCount,
            ]);

            $user_last_allAnwers_count++;
            $user_last_CurrectAnwers_count++;

            $mojoodi = $user->mojoodi -1;
            $user->update([
                "mojoodi"=>$mojoodi ,
                'allAnwers_count' => $user_last_allAnwers_count,
                'CurrectAnwers_count' => $user_last_CurrectAnwers_count,
            ]);

        } else {
            $mojoodi = $user->mojoodi -1;

            $user_answer = user_answer::create([
                'question_id' => $request->question_id,
                'user_id' => $request->user_id,
                'choiced_answer_item' => $request->Answer,
                'status' => '0',

            ]);

            $allcounts = $todays->allAnswersCount + 1;

            $wrongCount = $todays->WrongAnswersCount + 1;
            $todays->update([
                "mojoodi"=>$mojoodi ,
                'allAnswersCount' => $allcounts,
                'WrongAnswersCount' => $wrongCount,
            ]);

            $user_last_allAnwers_count++;
            $user_last_WrongAnwers_count++;

            $user->update([

                'allAnwers_count' => $user_last_allAnwers_count,
                'WrongAnwers_count' => $user_last_WrongAnwers_count,
            ]);

        }

        session()->flash('answered', 'پاسخ شما با موفقیت ثبت شد ، نتیجه نهایی به زودی توسط پیج اینستاگرام betMath منتشر خواهد شد');

        return redirect()->route('user.panel');

    }

    public function betquestionPage($id)
    {

        $mytime = Carbon::now();

        $todays = questions::whereDate('time', $mytime)->first();

        if (!is_null($todays) && $todays->id == $id) {

            session()->flash('itsSoon', 'شما در این بازه زمانی مجاز به قرعه کشی سوال امروز نمی باشید');
            return redirect()->back();
        } else {

            $question = questions::findOrfail($id);

            if ($question->time > $mytime) {
                session()->flash('itsSoon', 'یرای قرعه کشی باید تا پایان زمان تعیین شده صبر کنید');
                return redirect()->back();
            } elseif (count($question->userWinner) > 0) {

                session()->flash('betBefore', 'شما قبلا قرعه کشی این سوال را انجام داده اید');
                return redirect()->back();

            } else {
                return view('admin.questions.bet', compact('question'));
            }

        }

    }

    public function bet(Request $request)
    {

        $question = questions::findOrFail($request->q_id);

        $userWithCorrectAnswers = $question->userCurrectAnswers;



        if (count($question->userAnswers) == 0) {

            session()->flash('hasNoAnswer', 'هنوز کسی به سوال مورد نظر پاسخ نداده است');

            return redirect()->back();
        } elseif (count($userWithCorrectAnswers) == 0) {
            session()->flash('hasNoCurrectAnswer', 'تعداد پاسخ های درست این سوال 0 می باشد');

            return redirect()->back();

        } elseif (count($question->userWinner) > 0) {
            session()->flash('betInPast', 'شما قبلا قرعه کشی این سوال را انجام داده اید');

            return redirect()->back();

        }

        $count = count($userWithCorrectAnswers) - 1;

        $rand = rand(0, $count);

        $user = $userWithCorrectAnswers[$rand]->user;

        if ($user) {

            $winner = Winners::create([

                'question_id' => $question->id,
                'user_id' => $user->id,
                'time' => Carbon::parse($question->time),

            ]);

            $user_winningCount = $user->winningCount + 1;

            $user->update([
                'winningCount' => $user_winningCount,
            ]);

            session()->flash('winner', $winner);

            return redirect()->route('adminn.BetResult' , ['id'=>$question->id]);
        }

    }

    public function myLastQuestion()
    {

        $user = Auth::user();

        if (count($user->userLastAnswers) == 0) {

            session()->flash('CustomError', 'شما تا کنون در هیج آزمونی شرکت نکرده اید');
            return redirect()->back();
        }

        $question = $user->userLastAnswers[0]->question;

        $answer = $user->userLastAnswers[0];

        return view('user.questions.show', compact('question', 'answer'));

    }

    public function userShow($id)
    {
        $question = questions::findOrFail($id);

        $answer = user_answer::where('user_id', Auth::user()->id)->where('question_id', $question->id)->first();

        return view('user.questions.show', compact('question', 'answer'));
    }

    public function myHistory(Request $request)
    {
        $user= Auth::user();

        $userAnsers = Auth::user()->userAnswers;
        $wins = "null";

        if ($request->has('showBy')) {

            $variable = $request->showBy;
            switch ($variable) {
                case 'all':
                    $userAnsers = Auth::user()->userAnswers;

                    break;
                case 'wins':
                    $wins = Auth::user()->winns;
                    $userAnsers = null;
                    break;
                case 'corrects':
                    $userAnsers = Auth::user()->userCurrectAnswers;
                    break;
                case 'wrongs':
                    $userAnsers = Auth::user()->userWrongAnswers;
                    break;

                default:
                    $userAnsers = Auth::user()->userAnswers;
                    break;
            }

        }

        return view('user.history.index', compact('userAnsers'  , 'wins' , 'user'));
    }




    public function betResult($id ){
        $question = questions::findOrFail($id);




        if(count($question->userWinner) == 0){

            session()->flash('NotBetBefore' , 'adasdasdasdasdasd');
            return view('admin.questions.betResult');
        }


        $winner = $question->userWinner[0];

        $firstName = $winner->user->firstname;

        $lastName = $winner->user->lastname;

        $fullName = $firstName . "-" . $lastName;


        return view('admin.questions.betResult' , compact('winner' , 'fullName'));

    }
}
