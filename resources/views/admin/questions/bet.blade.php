@extends('admin.dashboard.master')




@section('headers')
@endsection


@section('title')
    داشبورد
@endsection

@section('content')



<form action="{{route('adminn.betquestion')}}" method="POST" >



    @csrf
    <input type="hidden" name="q_id" value="{{$question->id}}">
    <input type="submit" value="قرعه کشی">



</form>



@if (Session::has('hasNoAnswer'))
<span class="text-success">{{ Session::get('hasNoAnswer') }}</span>
@endif



@if (Session::has('hasNoCurrectAnswer'))
<span class="text-success">{{ Session::get('hasNoCurrectAnswer') }}</span>
@endif




@if (Session::has('betInPast'))
<span class="text-success">{{ Session::get('betInPast') }}</span>
@endif







@endsection
