@extends('admin.dashboard.master')




@section('headers')
@endsection


@section('title')
    داشبورد
@endsection

@section('content')
 

    
<div class="container-fluid background-math">
<div class="headback rounded opacity-100">
<div class="container">
    <div class="row">
       
        <label for="" class = "p-2" >
    اطلاعات کاربری :
    </label>
    <span>

        آیدی کاربر
    </span>
    
    <span>

{{$user->id}}
</span>
<div class="">
<span class = "p-2">
نام
</span>

<span>
{{$user->firstname}}
</span>

</div>
<div class="">
    <span class = "p-2">
        نام خانوادگی
   </span>

   <span>
   {{$user->lastname}}
   </span>

</div>
<div class="">
    <span class = "p-2">
        شماره تلفن
    </span>

    <span>
    {{$user->number}}
    </span>

</div>
<div class="">
    <span class = "p-2" >
        ایمیل
    
    </span>

    <span>
    {{$user->email}}
    </span>

</div>
<div class="">
    <span class = "p-2">
        شهر    
        </span>
    
        <span>
        {{$user->city->name}}
        </span>
    
</div>
<div class="">
    <span class = "p-2">
        مقطع تحصیلی
    </span>

    <span>
        {{$user->classLevel->name}}
    </span>

</div>

<div class="">
    <span class = "p-2">
        رشته تحصیلی
    </span>

    <span>
        {{$user->filedOfStudy->name}}
    </span>


</div>
<div class="">
    <span class = "p-2">
        تعداد سوالات شرکت کرده
    </span>


    <span>
        {{$user->allAnwers_count}}
    </span>

</div>
<div class="">
    <span class = "p-2" >
        تعدا د پاسخ های درست
    </span>

    <span>
        {{$user->CurrectAnwers_count}}
    </span>
</div>    

<div class="">
    <span class = "p-2" >
        تعدا د پاسخ های اشتباه
    </span>

    <span>
        {{$user->WrongAnwers_count}}
    </span>

</div>
    
<div class="">
    <span class = "p-2" >
        تعداد دفعات برنده شدن 
    </span>

    <span>
        {{$user->winningCount}}
    </span>

</div>

<div class="">
    <span class = "p-2">
        تاریخ عضویت در سایت
    </span>


    <span>
    {{$user->created_at}}
    </span>

</div>
<div class="">
    <span class = "p-2" >
    موجودی حساب کاربر
    </span>


    <span>
    {{$user->mojoodi}}
    </span>

</div>


<div class="">
    <span class = "p-2" >
        وضعیت ایمیل کاربر 
     </span>
 
 
     <span>
         
         @if($user->email_verified_at)
 
         تایید شده
 
         @else
 
         در انتظار تایید
         @endif
 
 
     </span>
     <form action="" method="get" id="showByForm">

<select name="showBy" id="" onchange="document.getElementById('showByForm').submit();">
    <option value="all"  @if(request()->has('showBy') && request('showBy')=="all" ) selected   @endif >همه پاسخ ها</option>
    <option value="currects" @if(request()->has('showBy') && request('showBy')=="currects" ) selected   @endif>پاسخ های درست</option>
    <option value="wrongs" @if(request()->has('showBy') && request('showBy')=="wrongs" ) selected   @endif>پاسخ های غلط</option>
    <option value="wins" @if(request()->has('showBy') && request('showBy')=="wins" ) selected   @endif>برنده شده ها</option>

</select>
<hr>
<table class = "table table-bordered table-striped">
        <thead>

            <tr>
                

                <th>
                    تاریخ سوال
                </th>

                <th>
                    گزینه انتخاب کرده
                </th>

                <th>
                    نتیجه 
                </th>

            </tr>

        </thead>
        <tbody>

            @foreach ($userAnswers as $item)

            @if (request()->has('showBy') && request('showBy')=="wins")
          
            
            <tr>
                
                <th>
                    {{$item->question->time}}
                </th>
                <th>
                   گزینه
                    {{$item->question->cucrrect_answer_item}}
                </th>
                <th>


                    
                        <span class="btn btn-success">درست</span>

                        
                    
                </th>

                <th>

                    <a href="{{route('adminn.questions.show' , ['question'=>$item->question])}}">مشاهده سوال</a>

                </th>
            </tr>


            @else
           
            <tr>
                

                <th>
                    {{$item->question->time}}
                </th>

                <th>
                    گزینه
                     {{$item->choiced_answer_item}}
                 </th>


                <th>
                   
                    @if($item->choiced_answer_item == $item->question->cucrrect_answer_item)

                        <span class="btn btn-success">درست</span>

                    @else


                    <span class="btn btn-danger">اشتباه</span>

                    @endif
                    

                </th>

                
                    <th>

                        <a href="{{route('adminn.questions.show' , ['question'=>$item->question])}}">مشاهده سوال</a>

                    </th>
            </tr>


            @endif
            @endforeach
        

        </tbody>
    </table>

</form>
</div>
</div>
</div>
</div>

</div>

@endsection
