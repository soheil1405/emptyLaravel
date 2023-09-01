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



    

        @if(!is_null($winner))

        <a href="{{ route('adminn.users.show', ['user' => $winner->user]) }}">برنده سوال تاریخ {{ $winner->time }}کاریر {{ $fullName }} می باشد .</a>

        @else


    
        برنده این سوال پس از اتمام وقت و قرعه کشی نهایی اعلام خواهد شد

        @endif

    
     

        <img src="{{ url('/upload/questions/imgs/'. $question->q_image)}}"  style="width:500px; height:400px;" alt="">
     

        

        <hr>

  تعداد همه پاسخ ها
    {{count($userAnswers)}}
    <hr>
    تعداد پاسخ های درست : {{count($userCurrectAnswers)}}

    <hr>

    تعداد پاسخ های غلط

    {{count($userWrongAnswers)}}
   
    <hr>
    
    <form action="" method="get" id="showByForm">

        <select name="showBy" id="" onchange="document.getElementById('showByForm').submit();">
            <option value="all"  @if(request()->has('showBy') && request('showBy')=="all" ) selected   @endif >همه پاسخ ها</option>
            <option value="currects" @if(request()->has('showBy') && request('showBy')=="currects" ) selected   @endif>پاسخ های درست</option>
            <option value="wrongs" @if(request()->has('showBy') && request('showBy')=="wrongs" ) selected   @endif>پاسخ های غلط</option>
        </select>


    </form>

    <hr>
   
   
    <table>
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
                        <a href="{{ route('adminn.users.show', ['user' => $item->user]) }}">>{{$item->user->firstname }} - {{$item->user->lastname}}</a>
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

@endsection
