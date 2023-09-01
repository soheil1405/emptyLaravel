@extends('admin.dashboard.master')




@section('headers')
@endsection


@section('title')
    داشبورد
@endsection

@section('content')




@if(isset($winner))


<div class="aler alert-success">
    


    <a href="{{ route('adminn.users.show', ['user' => $winner->user]) }}"
        
        
        >برنده سوال تاریخ {{$winner->time}}کاریر {{$fullName }} می باشد .</a>

</div>



@else


<div class="alert alert-danger">
    شما هنوز قرعه کشی این سوال را انجام نداده اید
</div>


@endif




<a href="{{ route('adminn.questions.index') }}" class="btn btn-secondary">بازگشت</a>



@endsection
