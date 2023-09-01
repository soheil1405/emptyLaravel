@extends('user.dashboard.master')




@section('headers')
@endsection


@section('title')
    لیست کاربران
@endsection

@section('content')
    @if ($errors->has('created'))
        <span class="text-danger">{{ $errors->first('created') }}</span>
    @endif




    @if (Session::has('created'))
        <span class="text-success">{{ Session::get('created') }}</span>
    @endif


    @if (Session::has('edited'))
        <span class="text-success">{{ Session::get('edited') }}</span>
    @endif

    <div class="container-fluid background-math">

        <div class="container">
            <div class="row">
                <div class="headback rounded">
                    <h2 class="text-center"> {{ count($users) }} کاربر برتر </h2>
                    {{-- @dd($users) --}}
                </div>
            </div>
            <div class="row bg-white rounded">

                <div class="col-md-12 divmain p-5">
                    <div class="row">
                        <table class="table table-hover table-striped table-bordered text-center">



                            <thead>

                                <th>
                                    رتبه
                                </th>

                                <th>
                                    نام کاربری
                                </th>


                                <th>
                                    تعدا د مسابقات شرکت کرده
                                </th>

                                <th>
                                    تعداد جواب های درست
                                </th>

                                <th>
                                    تعداد جواب های غلط
                                </th>
                            </thead>

                            <tbody>
                                <?php $j = 0; ?>
                                @for ($i = 0; $i < count($users); $i++)
                                    <?php $j++; ?>
                                    <tr @if ($users[$i ]->id == Auth::user()->id) style="background-color:yellow;" @endif>
                                        <th>
                                            {{ $j }}
                                        </th>
                                        <th>

                                            <a href="{{ route('user.showUser' ,['id'=>$users[$i]->id]) }}">{{ $users[$i]->firstname }} - {{ $users[$i]->lastname }}</a>

                                        </th>


                                        <th>
                                            {{ $users[$i ]->CurrectAnwers_count + $users[$i]->WrongAnwers_count  }}
                                        </th>

                                        <th>

                                            {{ $users[$i]->CurrectAnwers_count }}
                                        </th>
                                        <th>

                                            {{ $users[$i]->WrongAnwers_count }}
                                        </th>


                                    </tr>
                                @endfor
                            </tbody>







                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
