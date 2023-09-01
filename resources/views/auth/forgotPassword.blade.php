@extends('auth.authMaster')

@section('title')
    ورود
@endsection
@section('headers')
@endsection





@section('content')
    <form 
    {{-- action="{{route('auth.EnterResetPassCode')}}"\ --}}
    
    action="{{ route('auth.EnterResetPassCode') }}" method="post"
    >
        @csrf
        <div class="form-group">
            <input class="form-control" type="hidden" name="number" value="{{ $user->number }}">
            <input type="number"   class="form-control"  name="authEmailcode" value="{{ old('authEmailcode') }}" required>
        </div>
        <div class="">
            <input type="submit" value=" ورود ">
        </div>
    </form>








    @if ($errors->has('authEmailcode'))
        <span class="text-danger">{{ $errors->first('authEmailcode') }}</span>
    @endif

    
    @if (Session::has('userNotFound'))
        <p class="alert alert-info">{{ Session::get('userNotFound') }}</p>
    @endif
    @if (Session::has('wrongCode'))
        <p class="alert alert-info">{{ Session::get('wrongCode') }}</p>
    @endif
    @if (Session::has('sendEmailAgain'))
        <p class="alert alert-info">{{ Session::get('sendEmailAgain') }}</p>
    @endif

    @if (Session::has('sendEmailError'))
        <p class="alert alert-info">{{ Session::get('sendEmailError') }}</p>
    @endif

    <a href="{{ route('auth.LoginPage') }}">بازگشت</a>
@endsection
