@extends('admin.dashboard.master')





@section('headers')
@endsection


@section('title')
    داشبورد
@endsection

@section('content')
    @if ($errors->has('created'))
        <span class="text-danger">{{ $errors->first('created') }}</span>
    @endif

    @if (Session::has('itsSoon'))
        <span class="text-danger">{{ Session::get('itsSoon') }}</span>
    @endif


    @if (Session::has('betBefore'))
        <span class="text-danger">{{ Session::get('betBefore') }}</span>
    @endif

    @if (Session::has('created'))
        <span class="text-success">{{ Session::get('created') }}</span>
    @endif


    @if (Session::has('edited'))
        <span class="text-success">{{ Session::get('edited') }}</span>
    @endif


    @if (Session::has('deleteStatus'))
        <div class="alert alert-danger">{{ Session::get('deleteStatus') }}</div>
    @endif






    <div class="container-fluid background-math">
        <div class="headback rounded">
            <div class="container">
                <div class="row">


                    <h2 class="text-center iransansultralight"> لیست سوالات</h2>
                </div>
            </div>
            <div class="row bg-white rounded">
                <div class="col-md-12 divmain p-5">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table  table-hover table-striped table-bordered text-center">



                                <thead>

                                    <th class="iransansultralight">
                                        کد سوال
                                    </th>

                                    <th class="iransansultralight">
                                        وضعبت
                                    </th>

                                    <th class="iransansultralight">
                                        تاریخ سوال
                                    </th>

                                    <th class="iransansultralight">
                                        تعداد شرکت کنندگان
                                    </th>
                                    <th class="iransansultralight">
                                        تعداد جواب های درست
                                    </th>

                                    <th class="iransansultralight">
                                        تعداد جواب های غلط
                                    </th>
                                    <th class="iransansultralight">
                                        اقدمات
                                    </th>




                                </thead>

                                <tbody>


                                    @if (isset($todays) && !is_null($todays))
                                        <tr>
                                            <th>

                                                {{ $todays->id }}

                                            </th>

                                            <th class="iransansultralight">

                                                سوال امروز

                                            </th>

                                            <th class="iransansultralight">
                                                {{ $todays->time }}
                                            </th>

                                            <th class="iransansultralight">
                                                {{ $todays->allAnswersCount }}
                                            </th>
                                            <th class="iransansultralight">
                                                {{ $todays->CurrectAnswersCount }}
                                            </th>

                                            <th class="iransansultralight">
                                                {{ $todays->WrongAnswersCount }}
                                            </th>
                                            <th class="iransansultralight">

                                                <a class="btn btn-secondary"
                                                    href="{{ route('adminn.questionWinner', ['questionId' => $todays->id]) }}"
                                                    class="btn btn-primary">
                                                    نتیجه لحظه ای </a>

                                                {{-- 
                         @if (is_null($todays->user_winner))
                            <a href="{{ route('adminn.betquestionPage', ['id' => $todays->id]) }}" class="btn btn-success">قرعه
                                کشی</a>
                         @endif --}}




                                                {{-- 
                                            <a class="btn btn-info"
                                                href="{{ route('adminn.questions.show', ['question' => $todays]) }}"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path
                                                        d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg><span class="p-3 iransansultralight">مشاهده سوال</span> --}}
                                                </a>


                                            </th>


                                        </tr>
                                    @else
                                        <tr>

                                            <th class="iransansultralight col-12">

                                                سوالی برای امروز طرح نشده است

                                            </th>


                                        </tr>
                                    @endif

                                    <?php $today = Carbon\Carbon::now(); ?>
                                    @foreach ($questions as $question)
                                        @if ($question->time < Carbon\Carbon::parse($today) || $question->time > Carbon\Carbon::parse($today))
                                            <tr>

                                                <th>

                                                    {{ $question->id }}

                                                </th>

                                                <th>
                                                    @if ($question->time > $today)
                                                        در صف انتشار
                                                    @else
                                                        منتشر شده
                                                    @endif

                                                </th>

                                                <th>
                                                    {{ $question->time }}
                                                </th>

                                                <th>
                                                    {{ $question->allAnswersCount }}
                                                </th>
                                                <th>
                                                    {{ $question->CurrectAnswersCount }}
                                                </th>

                                                <th>
                                                    {{ $question->WrongAnswersCount }}
                                                </th>
                                                <th>
                                                    @if ($question->time >= Carbon\Carbon::now()->format('Y-m-d'))
                                                    <a class="btn btn-warning iransansultralight"
                                                        href="{{ route('adminn.questions.edit', ['question' => $question->id]) }}">
                                                      <svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-pencil-square"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                            <path fill-rule="evenodd"
                                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                        </svg><span class="p-3">ویرایش</span></a>
                                                         @endif




                                                    @if ($question->time < $today && count($question->userWinner) == 0)
                                                        <a href="{{ route('adminn.betquestionPage', ['id' => $question->id]) }}"
                                                            class="btn btn-success iransansultralight "><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-award"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z" />
                                                                <path
                                                                    d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z" />
                                                            </svg><span class="p-3">قرعه کشی</span></a>
                                                    @elseif($question->time < $today && count($question->userWinner) > 0)
                                                        <a href="{{ route('adminn.questionWinner', ['questionId' => $question->id]) }}"
                                                            class="btn btn-primary iransansultralight"> مشاهده نتیجه </a>
                                                    @endif



                                                    <a class="btn btn-info iransansultralight"
                                                        href="{{ route('adminn.questions.show', ['question' => $question]) }}"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-question-circle"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path
                                                                d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                        </svg><span class="p-3">مشاهده سوال</span>
                                                    </a>




                                                    <button type="button" class="btn btn-danger iransansultralight"
                                                        onclick="deleteee({{ $question->id }})">


                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-x-lg"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                                        </svg>

                                                        حذف

                                                    </button>


                                                    <form id="deleteForm" action="{{ route('adminn.deleteQuestion') }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="qid" id="dqid"
                                                            value="{{ $question->id }}">

                                                    </form>



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
    </div>
@endsection



<script>
    function deleteee(id) {


        var answer = window.confirm("آیا میخواهید این سوال را حذف کنید ؟");
        if (answer) {
            $('#dqid').val(id);

            $('#deleteForm').submit();


        } else {



        }

    }
</script>
