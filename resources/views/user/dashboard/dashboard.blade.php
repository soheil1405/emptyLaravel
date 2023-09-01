@extends('user.dashboard.master')




@section('headers')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
@endsection


@section('title')
    داشبورد
@endsection

@section('content')
    <div class="container-fluid background-math">

        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="headback rounded">
                    <h5 class="text-center">

                        امروز
                    </h5>


                    <h5>
                        دوشنبه
                        {{ $date = \Morilog\Jalali\Jalalian::now() }}

                        {{-- {{\Morilog\Jalali\Jalalian::now()}} --}}
                    </h5>

                </div>
                <div class="headback rounded">
                    <div class="my-1 text-center">
                        <div class="text-center my-1">
                            <h5>
                                سلام {{ Auth::user()->firstname }}
                            </h5>




                            @if (Session::has('notAvailable'))
                                <div class="alert alert-danger">
                                    {{ Session::get('notAvailable') }}
                                </div>
                            @endif


                            @if (Session::has('passEdited'))
                                <div class="alert alert-success">
                                    {{ Session::get('passEdited') }}
                                </div>
                            @endif

                            @if (Session::has('answered'))
                                <div class="alert alert-success">
                                    {{ Session::get('answered') }}
                                </div>
                            @endif





                        </div>


                        <h4>به وب سایت <strong class="text-first">BETMATH</strong> خوش آمدید</h4>

                    </div>
                </div>
                <div class="headback rounded text-center">

                    <h5>
                        <span class="p-2">
                            موجودی شما :

                            <span class="text-first h5">


                                {{ Auth::user()->mojoodi }}

                                سوال</span>
                        </span>
                    </h5>



                    <a href="{{ route('payment.paymentPage') }}" class="btn btn-success mx-auto">


                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                        </svg>
                        <span>افزایش اعتبار</span>



                    </a>
                </div>

            </div>
            <div class="row bg-white rounded">
                <div class="col-md-6">


                    <div class="m-2 bg-ef p-2 text-center">
                        <p class="m-0">تعداد کل مسابقه هایی که شرکت کردید :
                            <span>

                                {{ count($user->userAnswers) }}

                                عدد </span>
                        </p>
                    </div>


                    <div class="m-2 bg-ef p-2 text-center">
                        <p class="m-0">تعداد جواب های درست :
                            <span>
                                {{ count($user->userCurrectAnswers) }}

                                عدد </span>
                        </p>
                    </div>

                    <div class="m-2 bg-ef p-2 text-center">
                        <p class="m-0">تعداد جواب های غلط :
                            <span>
                                {{ $user->WrongAnwers_count }}

                                عدد </span>
                        </p>
                    </div>

                    <div class="m-2 bg-ef p-2 text-center">
                        <p class="m-0"> آخرین سوالی که جواب داده اید :
                            <span>



                                @if (count($user->userLastAnswers) > 0)
                                    <a class="btn btn-info" href="{{ route('user.myLastQuestion') }}">مشاهده</a>
                                @endif



                            </span>
                        </p>
                    </div>



                    <div class="text-center">
                        <img class="img-fluid w-40" src="{{ 'asset/images/Cat with a witch hat-cuate.svg' }}"
                            alt="">
                    </div>
                </div>
                {{-- <canvas id="myChart2" style="max-width:500px;"></canvas> --}}

                <div class="col-md-6 text-center">
                    <img class="img-fluid w-75" src="{{ 'asset/images/Mathematics-cuate.svg' }}" alt="">
                </div>


            </div>
            <canvas id="myChart" style="max-width:500px;"></canvas>

        </div>


    </div>


    <script>
        var xValues = ["تعداد پاسخ های غلط ", "تعداد پاسخ های درست "];


        var yValues = [{{ $user->WrongAnwers_count }}, {{ $user->CurrectAnwers_count }}];
        var barColors = [
            "#b91d47",
            "#00aba9",
            "#2b5797",
            "#e8c3b9",
            "#1e7145"
        ];

        new Chart("myChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "تعداد کل پاسخ ها : " + {{ $user->WrongAnwers_count + $user->CurrectAnwers_count }}
                }
            }
        });




        var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
        var yValues = [55, 49, 44, 24, 15];
        var barColors = ["red", "green", "blue", "orange", "brown"];

        new Chart("myChart2", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "World Wine Production 2018"
                },

                interaction: {
                    mode: 'index',
                    axis: 'y'
                },


            }

        });
    </script>
@endsection
