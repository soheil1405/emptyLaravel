@extends('user.dashboard.master')




@section('headers')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
@endsection


@section('title')
    آخرین سوال من
@endsection

@section('content')
    <div class="container-fluid background-math">

        @if (Session::has('notAvailable'))
            <div class="alert alert-danger">
                {{ Session::get('notAvailable') }}
            </div>
        @endif


        <div>
            <img src="{{ url('/upload/questions/imgs/' . $question->q_image) }}" class="rounded mx-auto d-block pt-1 pb-1"
                alt="">


            <canvas id="myChart" style="max-width:500px;"></canvas>


        </div>




        @if ($answer)
            <div class=" container alert alert-info container">


                پاسخ شما به سوال: گزینه {{ $answer->choiced_answer_item }}

            </div>
        @endif


        {{-- <div class="container alert alert-success "style="display:flex; justify-content:space-around;"> --}}

            {{-- <span> --}}

                {{-- تعداد کل شرکت کنندگان --}}
                {{-- : --}}
                {{-- {{ $question->allAnswersCount }} --}}


            {{-- </span> --}}


            {{-- <span> --}}
                {{-- تعداد کل پاسخ های درست --}}
                {{-- : --}}
                {{-- {{ $question->CurrectAnswersCount }} --}}
            {{-- </span> --}}

            {{-- <span> --}}
                {{-- تعداد کل پاسخ های غلط --}}
                {{-- : --}}
                {{-- {{ $question->WrongAnswersCount }} --}}
            {{-- </span> --}}
        {{-- </div> --}}


        <div class="container">
            <div class="row">
                <div class="headback rounded">
                    <h2 class="text-center">
                        لیست شرکت کنندگان
                    </h2>
                </div>
            </div>
            <div class="row bg-white rounded">

                <div class="col-md-12 divmain p-5">
                    <div class="row">
                        <table class="table table-hover table-striped table-bordered text-center">



                            <thead>
                                <th>
                                    نام کاربری
                                </th>


                                <th>
                                    تعداد جواب های درست
                                </th>

                                <th>
                                    تعداد جواب های غلط
                                </th>

                                <th>
                                    تعداد برنده شدن
                                </th>
                            </thead>

                            <tbody>
                                @foreach ($question->userAnswers as $item)
                                    @if ($item->user)
                                        <tr @if ($answer && $item->user->id == $answer->user_id) style="background-color:yellow;" @endif>
                                            <th>
                                                <a


                                                href="{{ route('user.showUser' , ['id'=>$item->user->id]) }}"



                                                >{{ $item->user->firstname }} - {{ $item->user->lastname }}</a>

                                            </th>


                                            <th>
                                                {{ $item->user->allAnwers_count }}
                                            </th>

                                            <th>

                                                {{ $item->user->CurrectAnwers_count }}
                                            </th>
                                            <th>

                                                {{ $item->user->WrongAnwers_count }}
                                            </th>


                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>







                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script>
        var xValues = ["پاسخ اشتباه", "پاسخ درست"];


        var yValues = [    {{ $question->WrongAnswersCount }},{{ $question->CurrectAnswersCount }}];
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
                    text: "تعداد کل شرکت کنندگان : "+ {{ count($question->userAnswers) }}
                }
            }
        });
    </script>
@endsection
