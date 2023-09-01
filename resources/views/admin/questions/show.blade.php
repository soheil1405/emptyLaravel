@extends('admin.dashboard.master')




@section('headers')
@endsection


@section('title')
    داشبورد
@endsection

@section('content')
    @if (Session::has('winnerfound'))
        <div class="alert  alert-success">{{ Session::get('winnerfound') }}</div>
    @endif



    @if (Session::has('winnerNotfound'))
        <span class="alert  alert-danger">{{ Session::get('winnerNotfound') }}</span>
    @endif
    <div class="container-fluid background-math">
   
 <div class="container">
    <div calss ="row">
    <div class = " text-center">
        <img src="{{ url('/upload/questions/imgs/'. $questions->q_image)}}"   alt="">
        </div> 
    </div>
 </div>
 <br>
    <div class="container">
    <div calss ="row">
    <div class = "alert alert-info text-center">
@if(count($userWinner)>0)

<a href="">برنده سوال تاریخ {{ $userWinner[0]->time }}کاریر {{ $userWinner[0]->user->firstname }} - {{$userWinner[0]->user->lastname}} می باشد .</a>

@else

برنده این سوال هنوز مشخص نشده است.


@endif
</div>
</div>
</div>


</div>
        <div class="container">
    <div calss ="row">
    <div class = "alert alert-info text-center">
  تعداد همه پاسخ ها
    {{count($userAnswers)}}
    <hr>
    تعداد پاسخ های درست : {{count($userCurrectAnswers)}}

    <hr>

    تعداد پاسخ های غلط

    {{count($userWrongAnswers)}}
   
    <hr>
    </div>
</div>
</div>
<div class="container">
    <div calss ="row">
    <form action="" method="get" id="showByForm">

        <select  class="form-control" name="showBy" id="" onchange="document.getElementById('showByForm').submit();">
            <option value="all"  @if(request()->has('showBy') && request('showBy')=="all" ) selected   @endif >همه پاسخ ها</option>
            <option value="currects" @if(request()->has('showBy') && request('showBy')=="currects" ) selected   @endif>پاسخ های درست</option>
            <option value="wrongs" @if(request()->has('showBy') && request('showBy')=="wrongs" ) selected   @endif>پاسخ های غلط</option>
        </select>


    </form>
    </div>
</div>
    <hr>
    <div class="headback rounded">
    <div class="container">
    <div class = "row">
    <table class="table table-striped">
        <thead>

            <tr>
                <th>
                    نام کاربری
                </th>

                <th>
                    گزینه انتخاب کرده
                </th>

                <th>
                    نتیجه 
                </th>

            </tr>

        </thead>
        <tbody>

            @foreach ($userAnswers as $item)
            
                <tr>
                    <th>
                        <a href="{{route('adminn.users.show' , ['user'=>$item->user->id])}}">{{$item->user->firstname }} - {{$item->user->lastname}}</a>
                    </th>
                    <th>
                       گزینه
                        {{$item->choiced_answer_item}}
                    </th>
                    <th>
                       
                        @if($item->choiced_answer_item == $item->question->cucrrect_answer_item)

                            <span class="btn btn-sucess">درست</span>

                        @else


                        <span class="btn btn-danger">اشتباه</span>

                        @endif
                        
                    </th>

                </tr>

            @endforeach
        

        </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
@endsection
