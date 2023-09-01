@extends('auth.authMaster')

@section('title')
ورود
@endsection
@section('headers')
@endsection





@section('content')
  
<form action="{{route('checkMobileVerify')}}" method="post">

        @csrf
    
       کد اعتبار سنجی برای شما ارسال شده است

        <div>
            
            <input type="number" name="mobileVerifyCode" value="{{ old('mobileVerifyCode') }}">
            @if ($errors->has('mobileVerifyCode'))
                <span class="text-danger">{{ $errors->first('mobileVerifyCode') }}</span>
            @endif

            
        </div>

        @if (Session::has('customError'))
            <p class="alert alert-info">{{ Session::get('customError') }}</p>
        @endif
        <div class="">

            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        <input type="submit" value=" ورود " >

        </div>
    </form>

    <a href="{{}}">بازگشت</a>
@endsection
