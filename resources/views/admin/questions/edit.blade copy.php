@extends('admin.dashboard.master')



@section('headers')
@endsection


@section('title')
    داشبورد
@endsection

@section('content')


    <h1> ویرایش سوال
     
        تاریخ 

    {{$question->time}}
    
    
    </h1>


    @if (Session::has('fail'))
    <span class="text-success">{{ Session::get('fail') }}</span>
    @endif


    <form action="{{ route('adminn.questionimg.update') }}" id="imgQform" method="post" enctype="multipart/form-data">

        @method('put')
        @csrf

        <input type="hidden" name="id" value="{{$question->id}}">

        <img src="{{ url('/upload/questions/imgs/'. $question->q_image)}}" id="blah"  style="width:500px; height:400px;" alt="">
        <input type="file"  name="question_img" id=""  onchange="document.getElementById('imgQform').submit();" >

        
    </form>

    <form action="{{ route('adminn.questions.update' , ['question'=>$question]) }}" method="post" enctype="multipart/form-data">

        @method('put')
        @csrf







        <input type="hidden" name="id" value="{{$question->id}}">

        
        <hr>


        تاریخ سوال
        <input type="date" name="date" id="">


        <hr>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <label for="">گزینه ۱ </label>
        <input value="{{$question->answers->answer1}}" type="text" name="g1" id="">

        <label for="">گزینه ۲ </label>
        <input value="{{$question->answers->answer2}}" type="text" name="g2" id="">

        <label for="">گزینه ۳ </label>
        <input value="{{$question->answers->answer3}}" type="text" name="g3" id="">

        <label  for="">گزینه ۴ </label>
        <input value="{{$question->answers->answer4}}" type="text" name="g4" id="">

        <hr>








        {{-- <input type="text" class="example1" /> --}}













        انتخاب گزینه درست

        <hr>

        <label for="1">1</label>
        <input type="radio" name="correctAnswer"
        
        @if($question->cucrrect_answer_item == 1)

        checked
        @endif
        
        id="1" value="1">

        <label for="2">2</label>
        <input
                
        @if($question->cucrrect_answer_item == 2)

        checked
        @endif
        

        
        type="radio" name="correctAnswer" id="2" value="2">

        <label for="3">3</label>
        <input 
        
                
        @if($question->cucrrect_answer_item == 3)

        checked
        @endif
        

        
        
        type="radio" name="correctAnswer" id="3" value="3">

        <label for="4">4</label>
        <input
        
        
                
        @if($question->cucrrect_answer_item == 4)

        checked
        @endif
        

        
        
        type="radio" name="correctAnswer" id="4" value="4">
        <hr>


        <input type="submit" value="ویرایش سوال">


        <hr>
        <a href="{{ route('adminn.panel') }}">بازگشت</a>



        @if ($errors)
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif


    </form>

@endsection



<script>
    jalaliDatepicker.startWatch({
  minDate: "attr",
  maxDate: "attr"
}); 
/* Below is a js demo | you don't need to use */
setTimeout(function(){
  var elm=document.getElementsByTagName("input")[0];
  elm.focus();
  jalaliDatepicker.hide();
  jalaliDatepicker.show(elm);
}, 1000);
</script>