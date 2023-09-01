<!DOCTYPE html>
<html lang="en">

<head>


    @yield('headers')


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <!-- <script src="{{ asset('/asset/jquery.js') }}"></script>
    <link href="{{ asset('/asset/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/bootstrap/js/bootstrap.bundle.min.js') }}" rel="stylesheet">
    --> --}}
    <link rel="stylesheet" href="{{ asset('asset/datepicker/datepicker.css') }}">
      
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="{{ asset('/asset/main/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/main/css/responsive.css') }}" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    @include('admin.style.scripts')


    <title>bet Math | @yield('title')</title>
</head>
<style>

  
.navbar-nav{
    float:right !important;
}
</style>
<body dir="rtl">

    <!-- <div class="container-fluid bg-admin ">
        <div class="container">
            <div class="row">
                <div class="nav pt-4 pb-4">
                 



                    <div class="" style="display: flex; width:100% ; justify-content: space-around;">
                        <a href="{{ route('home') }}">صفحه اصلی</a>

                        <a href="{{ route('adminn.users.index') }}">کاربران</a>

                        <a href="{{ route('adminn.questions.index') }}">همه سوالات</a>

                        <a href="{{ route('adminn.questions.create') }}">افزودن سوال جدید</a>

                        <a href="{{ route('adminn.winners.index') }}">اسامی برندگان تا کنون</a>

                        <a href="{{ route('adminn.setting.index') }}"> پرداخت های انجام شده </a>


                        {{-- <a href="">ویژگی دانش آموزان</a> --}}


                        {{-- <a href="">تیکت ها</a> --}}

                        <a href="{{ route('logout') }}">خروچ</a>
                        

                    </div>

                </div>

            </div>
        </div>
    </div> -->
    
    <nav class="navbar navbar-inverse  ">
  <div class="container-fluid">
    <div class="navbar-header ">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
     
    </div>
    <div class="collapse navbar-collapse  " id="myNavbar">
      <ul class="nav navbar-nav justify-content-center ">
        
        {{-- <a href="">ویژگی دانش آموزان</a> --}}

           {{-- <a href="">تیکت ها</a> --}}
          
           
           <li ><a href="{{ route('home') }}">صفحه اصلی</a></li> 
           <li ><a href="{{ route('adminn.setting.index') }}">پرداخت های انجام شده</a></li>
           <li ><a href="{{ route('adminn.winners.index') }}">اسامی برندگان تاکنون</a></li>
           <li ><a href="{{ route('adminn.questions.create') }}">افزودن سوال جدید</a></li>
           <li ><a href="{{ route('adminn.questions.index') }}">همه سوالات</a></li>
           <li><a href="{{ route('adminn.users.index') }}">کاربران</a></li>           
           <li ><a href="{{ route('logout') }}">خروج</a></li>
       
    </ul>
  </div>
  </div>
</nav>
    @yield('content')

</body>

</html>



<script src="{{ asset('asset/datepicker/persiandate.js') }}"></script>
<script src="{{ asset('asset/datepicker/datepicker.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $(".example1").pDatepicker({
            autoClose: true,
            onSelect: function(unix) {
                // console.log('datepicker select : ' + unix);
                var day = new persianDate(unix).toDate();
                // console.log('day :' + day);



                var standard = new Date(day).toISOString();


                
                $('#date').val(standard);
                
                console.log( $('#date').val());

            }
        });

        //     $(".example2").pDatepicker({
        //         autoClose: true,
        //         onSelect: function(unix) {
        //             // console.log('datepicker select : ' + unix);
        //             var day = new persianDate(unix).toDate();
        //             // console.log('day :' + day);
        //             var standard =  new Date(day).toISOString();


        //    $('#fromDate').val(standard);
        //         }
        //     });

    });
</script>


