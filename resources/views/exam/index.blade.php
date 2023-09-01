@extends('exam.examMaster');
@section('headers')
    <style>
        .blur {
            background-color: rgba(0, 0, 0, 0.9);
            border-radius: 5px;
            font-family: sans-serif;
            text-align: center;
            -webkit-backdrop-filter: blur(25px);
            backdrop-filter: blur(25px);
            width: 50%;
            height: 50%;
            right: 30%;
            position: fixed;

            justify-content: center;
            color: #ffff;
            display: none;
            flex-direction: column;
            z-index: 1000;
            top: 15%;


        }


        .blur ul li span {
            color: red;
        }

        li {
            list-style-type: none;
        }

        .desc {
            padding: 30px;
            list-style-type: none;
        }

        .twice_ul {
            padding: 30px;
        }

        .desc {
            width: 100%;
            text-align: right;
        }

        .blur btn {
            width: 50px;
        }

        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap');

        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            font-family: 'Roboto', sans-serif;
            color: #2C4A64;
        }

        .main {
            height: 100vh;
            background-size: cover;
            /* background: url('https://i.ibb.co/jfLZFhm/Bitmap.png') no-repeat top center; */
        }

        h1 {
            text-align: center;
            font-weight: 400;
            font-size: 3rem;
            padding-top: 30px;
            text-transform: uppercase;
        }

        .countdown {
            display: flex;
            justify-content: center;
            gap: 20px;
        }



        .countdown>div {
            display: flex;
            flex-wrap: nowrap;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
            box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.25);
            width: 80px;
            height: 80px;
            border-radius: 5px;
        }

        .number {
            font-weight: 500;
            font-size: 44px;
            color: #CAA78C;
        }

        div span:last-of-type {
            font-size: 12px;
        }





        @media screen and (max-width:600px) {
            h1 {
                font-size: 40px;
            }

            .countdown {
                flex-direction: column;
                align-items: center;
                gap: 10px;
                margin-top: 30px;
            }

            .countdown>div {
                background-color: #fff;
                width: 250px;
                height: 60px;
                margin: 0;
                flex-direction: row;
                justify-content: space-between;
                padding: 20px;
            }

            div span:last-of-type {
                font-size: 24px;
                text-transform: uppercase;
            }

            .number {
                font-size: 34px;
            }
        }
    </style>
@endsection


@section('content')



    <div id="blur" class="blur">


        <ul>

            <li class="twice_ul" style="font-size: 30px;">

                پاسخ خود را تایید می کنید؟

            </li>

            <span onclick=" $('#blur').css('display' , 'none');   "
                style="cursor: pointer; border:1px solid gray; padding: 15px ; font-size: 30px;">خیر</span>


            <span onclick="$('#answerForm').submit();"
                style="cursor: pointer; border:1px solid gray; padding: 15px; font-size: 30px;">بله</span>


        </ul>




    </div>




    <form action="{{ route('question.answer') }}" method="post" id="answerForm">

        @csrf
        <input type="hidden" name="question_id" value="{{ $todays->id }}">

        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

        <img src="{{ url('/upload/questions/imgs/' . $todays->q_image) }}" style="width:500px; height:400px;"
            alt="">


        <hr>

        <div class="alert alert-danger" id="errrr" style="display: none;">
            ابتدا یکی از گزینه های زیر را انتخاب کنید
        </div>


        <input type="radio" name="Answer" id="1" value="1">
        <label for="1">گزینه 1</label>


        <input type="radio" name="Answer" id="2" value="2">
        <label for="2">گزینه 2</label>

        <input type="radio" name="Answer" id="3" value="3">
        <label for="3">گزینه 3</label>

        <input type="radio" name="Answer" id="4" value="4">
        <label for="4">گزینه 4</label>
        <hr>

        <a class="btn btn-success" onclick="finalSubmit()" disable>ثبت پاسخ</a>
        <a href="{{ route('home') }}">بازگشت</a>

    </form>




    <hr>


    <div class="main">
        <h1>زمان باقی مانده</h1>
        <div class="countdown">


            <div>
                <span class="number minutes"></span>
                <span></span>
            </div>
            <div>
                <span class="number seconds"></span>
                <span></span>
            </div>

        </div>


    </div>


    @if ($errors)
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
@endsection

<script>
    function finalSubmit() {


        var Answer = $('input[name="Answer"]:checked').val();


        if (Answer) {
            $('#blur').css('display', 'flex');
        } else {

            $('#errrr').css('display', 'block');

        }



    }


    var allseconds = parseInt({{ $todays->answer_time }}) * 60;
    var minutes = parseInt({{ $todays->answer_time }});

    var seconds = allseconds % 60;



    const countdown = setInterval(() => {

        if (seconds === 0) {
            minutes = minutes - 1;
            if (minutes < 0) {
                console.log('finished');
                // stopInterval();
            } else {
                seconds = 59;
            }
        } else {
            seconds = seconds - 1;
        }


        console.log('seconds:' + seconds);

        console.log('minutes:' + minutes);







        document.querySelector(".seconds").innerHTML = seconds < 10 ? '0' + seconds : seconds
        document.querySelector(".minutes").innerHTML = minutes < 10 ? '0' + minutes : minutes




        if (allseconds === 0) {
            clearInterval(countdown)
            document.querySelector(".countdown").innerHTML = 'Happy Birthday Ahmed'
        } else {
            allseconds = allseconds - 1;
        }

    }, 1000)
</script>
