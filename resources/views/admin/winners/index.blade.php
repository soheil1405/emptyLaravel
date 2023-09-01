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
<div class="headback rounded">
        <div class="container">
       
            <div class="row">
                    <span class = "border border-dark">
                    <h2 class="text-center iransansultralight"> لیست سوالات</h2>
                 </span>
                </div>
            </div>
            <div class="row bg-white rounded">
            <div class="row bg-white rounded">
                <div class="col-md-12 divmain p-5">
                    <div class="row">
                        <table class="table table-hover table-striped table-bordered text-center">



                            
<thead>
        <th>
             نام و نام خانوادگی 
        </th>

        <th>
            کد سوال
        </th>
        
        <th>
            تاریخ سوال            
        </th>



        
        
    </thead>

    <tbody>

        @foreach ( $winners as $winner )
            <tr>
                <th>
                    <a href="{{ route('adminn.users.show', ['user' => $winner->user]) }}">{{ $winner->user->firstname }} - {{ $winner->user->lastname }}</a>
                </th>

                <th>
                    {{$winner->question->id}}
                </th>
                
                <th>
                    {{$winner->question->time}}
                </th>
                <th>
                    
   
                    <a class="btn btn-info" href="{{route('adminn.questions.show' , ['question'=>$winner->question])}}"> <svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path
                                                        d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg><span class="p-3">مشاهده سوال</span></a>

                </th>
            </tr>
        @endforeach
    </tbody>







                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>
<table>
    







</table>

@endsection