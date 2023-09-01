<!DOCTYPE html>
<html lang="en">

<head>
    @yield('headers')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('/asset/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/asset/main/css/style.css') }}" rel="stylesheet">


    <script src="{{ asset('/asset/jquery.js') }}"></script>
    <script src="{{ asset('/asset/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/asset/bootstrap/js/bootstrap.bundle.min.js') }}"></script>






    @include('admin.style.scripts')


    <title>پنل گاربری | @yield('title')</title>



</head>

<body dir="rtl">
    <div class="container-fluid bg-admin ">
        <div class="container">
            <div class="row">

                <!-- <div class="nav pt-4 pb-4">



                style="display: flex; width:100% ; justify-content: space-around;" -->


                <!-- <a class="btn btn-secondary " href="{{ route('home') }}">صفحه اصلی</a>
       
        <a class="btn btn-secondary " href="{{ route('user.panel') }}">داشبورد کاربر</a>

        <a class="btn btn-danger "  href="{{ route('question.exam') }}">حل سوال امروز</a>
        
        <a class="btn btn-secondary " href="{{ route('user.CompetitionList') }}">برترین ها</a>
        <a  class="btn btn-secondary " href="{{ route('user.winners') }}">اسامی برندگان </a>
  
        <a class="btn btn-secondary " href="{{ route('user.myHistory') }}">سوال هایی که من شرکت کردم</a>
        
        {{-- <a href="">سوال های از دست داده (شرکت نکرده ام)</a> --}}
        
        {{-- <a href="">نتیجه سوالات</a> --}}
        


        <a class="btn btn-secondary" href="{{ route('payment.paymentPage') }}">مدیریت مالی</a>

        <a  class="btn btn-secondary" href="{{ route('logout') }}">خروج</a> -->



                <!-- </div>  -->

            </div>

        </div>
    </div>
    </div>
    <!-- <div class="nav" style="width: 100%; display: flex; justify-content: space-around;">
    
    
    
    </div> -->

    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0  ">

                    <li class="nav-item iransansmedium ">
                        <a class="nav-link" href="{{ route('home') }}">صفحه اصلی</a>
                    </li>
                    <li class="nav-item iransansmedium">
                        <a class="nav-link" href="{{ route('user.panel') }}">داشبورد کاربر </a>
                    </li>
                    <li class="nav-item iransansmedium">
                        <a class="nav-link" href="{{ route('question.exam') }}">حل سوال امروز </a>
                    </li>
                    <li class="nav-item iransansmedium">
                        <a class="nav-link" href="{{ route('user.CompetitionList') }}">برترین ها </a>
                    </li>
                    <li class="nav-item iransansmedium">
                        <a class="nav-link" href="{{ route('user.winners') }}">اسامی برندگان </a>
                    </li>
                    <li class="nav-item iransansmedium">
                        <a class="nav-link" href="{{ route('user.myHistory') }}">سوال هایی که من شرکت کردم </a>
                        {{-- <a href="">سوال های از دست داده (شرکت نکرده ام)</a> --}}

                        {{-- <a href="">نتیجه سوالات</a> --}}
                    </li>
                    <li class="nav-item iransansmedium">
                        <a class="nav-link" href="{{ route('payment.paymentPage') }}">مدیریت مالی</a>
                    </li>
                    <li class="nav-item iransansmedium">
                        <a class="nav-link" href="{{ route('logout') }}">خروج</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>







    @if (Session::has('CustomError'))
        <div class="alert alert-success">
            {{ Session::get('CustomError') }}
        </div>
    @endif
    </div>
    @yield('content')

</body>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script> --}}

</html>
