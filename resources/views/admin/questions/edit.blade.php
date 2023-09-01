@extends('admin.dashboard.master')



@section('headers')
@endsection


@section('title')
    داشبورد
@endsection

@section('content')
    <div class="container-fluid background-math">
        <div class="headback rounded">
            <div class="container">
                <div class="row">

                    <h1 class="text-center"> ویرایش سوال


                        <!-- تاریخ  -->

                        <!-- {{ $question->time }} -->


                    </h1>
                </div>
            </div>
            <div class="row bg-white rounded">

                <div class="col-md-12 text-center thumbnail p-5">
                    <div class="row">

                        <form action="{{ route('adminn.questionimg.update') }}" id="imgQform" method="post"
                            enctype="multipart/form-data">

                            @method('put')
                            @csrf

                            <input class="form-control" type="file" onchange="$('#imgQform').submit();  " name="question_img" id="">


                            <input type="hidden" name="id" value="{{ $question->id }}">

                            <img src="{{ url('/upload/questions/imgs/' . $question->q_image) }}" class="img-fluid"
                                id="blah" alt="">
                                
                                

                        </form>
                    </div>
                </div>



                <form action="{{ route('adminn.questions.update', ['question' => $question]) }}" method="post"
                    enctype="multipart/form-data">

                    @method('put')
                    @csrf


                    
                    
                    <input type="hidden" name="id" value="{{ $question->id }}">

                    <div class="col-md-10 mx-auto">
                        <div class="d-flex justify-content-around ">


                        </div>

                        <hr>
                        <div class="col-md-10 mx-auto">
                            <div class="d-flex justify-content-around">
                                <div class="form-check btn btn-outline-success">

                                    <label class="h4 form-check-label" for="1">گزینه اول</label>
                                    <input class="form-check-input" type="radio" name="correctAnswer" id="1"


                                    @if($question->cucrrect_answer_item == "1")


                                    checked

                                    @endif



                                        value="1">
                                </div>
                                <div class="form-check btn btn-outline-success"><label class="h4 form-check-label"
                                        for="2">گزینه دوم</label>
                                    <input class="form-check-input" type="radio" name="correctAnswer" id="2"
                                        
                                    
                                    
                                    @if($question->cucrrect_answer_item == "2")


                                    checked

                                    @endif
                                    
                                    value="2">
                                </div>
                                <div class="form-check btn btn-outline-success"><label class="h4 form-check-label"
                                        for="3">گزینه سوم</label>
                                    <input class="form-check-input" type="radio" name="correctAnswer" id="3"
                                    
                                    @if($question->cucrrect_answer_item == "3")


                                    checked

                                    @endif   
                                    
                                    
                                    value="3">
                                </div>
                                <div class="form-check btn btn-outline-success"><label class="h4 form-check-label"
                                        for="4">گزینه چهارم</label>
                                    <input class="form-check-input" type="radio" name="correctAnswer" id="4"
                                     
                                    
                                    
                                    @if($question->cucrrect_answer_item == "4")


                                    checked

                                    @endif
                                    
                                    value="4">
                                </div>
                            </div>
                        </div>

                        <hr>



                        @if (Session::has('fail'))
                            <span class="text-success">{{ Session::get('fail') }}</span>
                        @endif


                        <input class="btn  btn-block btn-lg btn-primary w-100" type="submit" value="ویرایش سوال">


                        <hr>
                        <div class="text-center">
                            <a class="btn btn-warning btn-lg text-center"
                                href="{{ route('adminn.questions.index') }}">بازگشت</a>
                        </div>
                    @endsection
