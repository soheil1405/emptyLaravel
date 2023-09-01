


@extends('exam.examMaster');



@section('content')
    

<img src="{{ url(env('QUESTION_PIC_DIRECTORY') . $todays->q_image) }}" style="width:500px; height:400px;"
alt="">
<label for="1">{{ $todays->answers->answer1 }}</label>
    
    
<label for="2">{{ $todays->answers->answer2 }}</label>

<label for="3">{{ $todays->answers->answer3 }}</label>

<label for="4">{{ $todays->answers->answer4 }}</label>




<div class="alert alert-info">  

    شما قبلا به سوال امروز پاسخ داده اید
     
    <hr>

    پاسخ شما به سوال: گزیته {{$answered->choiced_answer_item}}

</div>



<span>
    تعداد کل شرکت کنندگان:
</span>

<span>
{{$todays->allAnswersCount}}
</span>


<span>
    تعداد پاسخ های درست :
</span>
<span>

    {{$todays->CurrectAnswersCount}}
</span>


<span>
    تعداد پاسخ های غلط
</span>

<span>
    {{$todays->WrongAnswersCount}}

</span>





@endsection