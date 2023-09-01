@extends('auth.authMaster')

@section('title')
    ثبت نام
@endsection
@section('headers')
@endsection





@section('content')
    <div class="container-fluid p-0 ">
        <div class="container-fluid bg-admin">
            <div class="container">
                <div class="row">
                    <div class="nav pt-4 pb-4">




                        <div class="" style="display: flex; width:100% ; justify-content: space-around;">
                            {{-- <a href="{{ route('home') }}">صفحه اصلی</a> --}}
                            @if (Session::has('wellcome'))
                                {{ Session::get('wellcome') }}
                            @endif








                        </div>


                    </div>

                </div>

            </div>
        </div>
        <section class="container">

            <h1 class="text-center pt-4 h3">BET MATH</h1>
            <div class="row bg-white">
                <div class="col-md-6 h-400px  ">
                    <h2 class="h4">ثبت نام</h2>
                    <form action="{{ route('auth.register') }}" method="post">

                        @csrf
                        <div class="row mt-3">
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">نام</label>
                                <input class="form-control" type="text" name="first_name"
                                    value="{{ old('first_name') }}">
                                @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">نام خانوادگی</label>
                                <input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}">

                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>


                            


                            <div class="mb-3 col-md-6">
                                <label class="form-label">شماره تلفن</label>
                                <input class="form-control" type="text" name="mobile" value="{{ old('mobile') }}">

                                @if ($errors->has('mobile'))
                                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                @endif

                            </div>



                            <div class="mb-3 col-md-6">

                                <label class="form-label">شهر</label>

                                <select class="form-select" name="city" id="" value="{{ old('city') }}">

                                    @foreach ($cities as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach

                                </select>


                                @if ($errors->has('city'))
                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                                @endif
                            </div>
                            <div class="mb-3 col-md-6">

                                <label class="form-label">مقطع تحصیلی</label>

                                <select class="form-select" name="classLevel" id=""
                                    value="{{ old('classLevel') }}">
                                    @foreach ($class_levels as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach


                                </select>

                                @if ($errors->has('classLevel'))
                                    <span class="text-danger">{{ $errors->first('classLevel') }}</span>
                                @endif

                            </div>
                            <div class="mb-3 col-md-6">

                                <label class="form-label">رشته تحصیلی</label>

                                <select class="form-select" name="Field_of_Study" id=""
                                    value="{{ old('Field_of_Study') }}">
                                    @foreach ($fields_of_study as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach

                                </select>

                                @if ($errors->has('Field_of_Study'))
                                    <span class="text-danger">{{ $errors->first('Field_of_Study') }}</span>
                                @endif

                            </div>



                            <div class="mb-3 col-md-6">
                                <label class="form-label">رمز عبور</label>
                                <input class="form-control" type="text" name="password" value="{{ old('password') }}">

                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif


                            </div>


                            <div class="mb-3 col-md-6">
                                <label class="form-label">تکرار رمز عبور</label>
                                <input class="form-control" type="text" name="password_confirmation"
                                    value="{{ old('password_confirmation') }}">

                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif


                            </div>


                            @if (Session::has('customError'))
                                <p class="alert alert-info">{{ Session::get('customError') }}</p>
                            @endif
                            <input class="btn btn-first mb-3 mt-3 " type="submit" value="ثبت نام">
                        </div>
                    </form>

                    <a class="btn btn-outline-info w-100 mb-5" href="{{ route('home') }}">بازگشت</a>

                </div>
                <div class="col-md-6 h-400px col-sm-12">
                    <img src="{{ asset('/asset/images/Studying Concept Illustration.svg') }}" alt="">
                </div>
            </div>

        </section>
    </div>
@endsection
