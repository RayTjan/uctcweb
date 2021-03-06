@extends('layouts.app')
@section('title', 'Client')
@section('content')

    <div class="container clearfix" style="margin-top: 20px;">

        {{--        navigation--}}
        <div>
            <a href="{{route('student.program.show',$program)}}" class="a-none blackhex d-inline-block">
                <h6>Program</h6>
            </a>
            <i class="fa fa-angle-right d-inline-block mr-1 ml-1"></i>
            <a href="{{route('student.program.show',$program)}}" class="a-none blackhex d-inline-block">
                <h6>Detail</h6>
            </a>
            <i class="fa fa-angle-right d-inline-block mr-1 ml-1"></i>
            <a href="{{route('student.client.show',$program)}}" class="a-none blackhex d-inline-block">
                <h6>Client</h6>
            </a>
        </div>

        <div class="row">
            <h1 class="col font-weight-bold">Client List</h1>
        </div>

        <div class="row" style="margin-top: 30px;">
            <link href='//fonts.googleapis.com/css?family=Roboto:100,400,300' rel='stylesheet' type='text/css'>
            <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
            <div class="quiz-window quiz-padding">
                <div class="">
                    <div class="gui-window-awards">


                        <ul class="quiz-window-body guiz-awards-row guiz-awards-row-margin mb-2 budget card-bg-change">
                            <li class="guiz-awards-time customComittee25 font-weight-bold">Name</li>
                            <li class="guiz-awards-time customComittee25 font-weight-bold">Phone</li>
                            <li class="guiz-awards-time customComittee25 font-weight-bold">Address</li>
                            <li class="guiz-awards-time customComittee25 font-weight-bold">Email</li>
                        </ul>

                        @foreach($program->clients as $client)
                            <ul class="quiz-window-body guiz-awards-row guiz-awards-row-margin mb-2 budget">
                                <li class="guiz-awards-time customComittee25">{{ $client->name }}</li>
                                <li class="guiz-awards-time customComittee25">{{ $client->phone }}</li>
                                <li class="guiz-awards-time customComittee25">{{ $client->address }}</li>
                                <li class="guiz-awards-time customComittee25">{{ $client->email }}</li>
                            </ul>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
