@extends('layouts.app')
@section('title', 'List User')
@section('content')

<script>
    $(document).ready( function() {
        $('.dropdown-button').dropdown();
    });
</script>

<div class="container clearfix" style="margin-top: 20px;">
    <div class="row">
        <h1 class="col font-weight-bold">User List View</h1>
    </div>

    <div class="row" style="margin-top: 30px;">
        <link href='//fonts.googleapis.com/css?family=Roboto:100,400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <div class="quiz-window quiz-padding">
            <div class="quiz-window-body">
                <div class="gui-window-awards">


                    <ul class="quiz-window-body guiz-awards-row guiz-awards-row-margin mb-2 budget card-bg-change">
                        <li class="guiz-awards-time customComittee">Name</li>
                        <li class="guiz-awards-time customComittee">Email</li>
                        <li class="guiz-awards-time customComittee">Role</li>
                        <li class="guiz-awards-time customComittee">Event (Create/Joined)</li>
                        <li class="guiz-awards-time customComittee">Action</li>
                    </ul>

                    @foreach($users as $user)
                    <ul class="quiz-window-body guiz-awards-row guiz-awards-row-margin mb-2 budget">
                        <li class="guiz-awards-time customComittee">{{$user->identity->name}}</li>
                        <li class="guiz-awards-time customComittee">{{$user->email}}</li>
                        <li class="guiz-awards-time customComittee">{{$user->role_id}}</li>
                        <li class="guiz-awards-time customComittee">ntah</li>
                        <li class="guiz-awards-time customComittee">
                            <div class="dropdown">
                                <div class="dropdown show">
                                    <a class="dropdown-button iconCommitteeAct" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26.414" height="13.207" viewBox="0 0 26.414 13.207">
                                            <path id="Path_1462" data-name="Path 1462" d="M1215,2144l12,12,12-12Z" transform="translate(-1213.793 -2143.5)" fill="none" stroke="#000" stroke-linejoin="round" stroke-width="1"/>
                                        </svg>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">Edit</a>
                                        <a class="dropdown-item btnDelete" href="#">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
