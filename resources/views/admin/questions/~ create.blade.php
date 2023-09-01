@extends('admin.dashboard.master')




@section('headers')
@endsection


@section('title')
    داشبورد
@endsection

@section('content')
    <div class="container-fluid background-math">

        <div class="container">
            <div class="row">
                <div class="headback rounded">
                    <h2 class="text-center">افزودن سوال جدید</h2>
                </div>
            </div>
           
            <div class = "row bg-white rounded">
                <div class="col-md-12 divmain p-5">
                    <div class="row">
                        @if (Session::has('fail'))
                            <span class="text-success">{{ Session::get('fail') }}</span>
                        @endif



                        <form action="{{ route('adminn.questions.store') }}" method="post" enctype="multipart/form-data">

                            @csrf
                            <div class="mb-3">
                                <h4>آپلود عکس سوال </h4>
                                <!-- <label class="pr-50" for="question_img">عکس سوال</label> -->
                                <input class="form-control" type="file" name="question_img" id="">
                            </div>
                            <hr>
                            <div class="d-flex justify-content-around">
                              
                                <form class = "form-inline" action ="/action_page.php">
                                <div class="form-group">
                                <label  for="" >گزینه 1 </label>
                                <input type="text" class="form-control"  name="g1" value="{{old('g1')}}" id="">
                                </div> 
                                <div class="form-group">
                                <label for="">گزینه 2 </label>
                                <input type="text" class="form-control"  name="g1" value="{{old('g1')}}" id="">
                                </div> 
                                <div class="form-group">
                                <label for="">گزینه 3 </label>
                                <input type="text" class="form-control"  name="g1" value="{{old('g1')}}" id="">
                                </div> 
                                <div class="form-group">
                                <label for="">گزینه 4 </label>
                                <input type="text" class="form-control"  name="g1" value="{{old('g1')}}" id="">
                                </div> 
                  
                            </div>
                                       

    
                            </form>
                            <hr>



                            <h4>
                                انتخاب گزینه درست
                            </h4>


                            <div class="col-md-10 mx-auto">
                                <div class="d-flex justify-content-around">
                                    <div class="form-check btn btn-outline-success">
                                    
                                        <label class="h4 form-check-label" for="1">گزینه اول</label>
                                        <input class="form-check-input" type="radio" name="correctAnswer" id="1"
                                            value="1">
                                    </div>
                                    <div class="form-check btn btn-outline-success"><label class="h4 form-check-label"
                                            for="2">گزینه دوم</label>
                                        <input class="form-check-input" type="radio" name="correctAnswer" id="2"
                                            value="2">
                                    </div>
                                    <div class="form-check btn btn-outline-success"><label class="h4 form-check-label"
                                            for="3">گزینه سوم</label>
                                        <input class="form-check-input" type="radio" name="correctAnswer" id="3"
                                            value="3">
                                    </div>
                                    <div class="form-check btn btn-outline-success"><label class="h4 form-check-label"
                                            for="4">گزینه چهارم</label>
                                        <input class="form-check-input" type="radio" name="correctAnswer" id="4"
                                            value="4">
                                    </div>
                                </div>
                            </div>










                            <hr>
                            <div class="mb-5 mt-5 ">
                                <h4>تاریخ سوال</h4>
                                <label class="h6 pr-50" for=""> انتخاب</label>

                                <input class="form-control" type="date" name="date" id="">
                                <!-- <input class="example1 " />
                                <input class="form-control" type="hidden" name="date" id="date">

                                {{-- <input type="date" name="date" id=""> --}} -->
                            </div>

                            <input class="btn  btn-block btn-lg btn-primary w-100 " type="submit" value="ثبت سوال">


                            <hr>
                            <div class="text-center">
                                <a class="btn btn-warning btn-lg text-center" href="{{ route('adminn.panel') }}">بازگشت</a>
                            </div>


 
                            @if ($errors)
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            @endif


                        
                    </div>
                </div>
             
            </div>
        </div>
    </div>
    </div>





@endsection
