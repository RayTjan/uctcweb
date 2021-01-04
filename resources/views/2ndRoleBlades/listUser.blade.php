@extends('layouts.app')
@section('title', 'List User')
@section('content')
{{--    <div class="container" style="margin-top: 20px;">--}}
{{--        <div class="row">--}}
{{--            <h1 class="col">User List View</h1>--}}
{{--        </div>--}}
{{--        <div class="row" style="margin-top: 30px;">--}}
{{--            <table class="table table-striped table-dark">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th scope="col">Name</th>--}}
{{--                    <th scope="col">Email</th>--}}
{{--                    <th scope="col">Role</th>--}}
{{--                    <th scope="col">Events (create/joined) </th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach($users as $user)--}}
{{--                    <tr>--}}
{{--                        <td>{{$user->identity->name}}</td>--}}
{{--                        <td>{{$user->email}}</td>--}}
{{--                        <td>{{$user->role_id}}</td>--}}
{{--                        @if($user->role_id == 2)--}}
{{--                            @foreach($user->createProgram as $program)--}}
{{--                                <td>{{$program->name}}</td>--}}
{{--                            @endforeach--}}
{{--                        @elseif($user->role_id == 3)--}}
{{--                            <td>--}}
{{--                            @foreach($user->attends as $program)--}}
{{--                                <p>{{$program->name}}</p>--}}
{{--                            @endforeach--}}
{{--                            </td>--}}
{{--                        <td>{{$user->attends->name}}</td>--}}
{{--                        @endif--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </div>--}}

<script>
    $(document).ready( function() {
        $('.dropdown-button').dropdown();
    });
</script>

<div class="container clearfix" style="margin-top: 20px;">
    <div class="row">
        <h1 class="col font-weight-bold">User List View</h1>
    </div>

    @auth()
        <div class="clearfix">
            {{-- auth to limit content, it cannot be accessed until login --}}
            <div class="float-right">
                 <a href="{{route('staff.user.create')}}" role="button" aria-pressed="true">
                    <svg
                        aria-hidden="true"
                        focusable="false"
                        data-prefix="fad"
                        data-icon="angle-double-right"
                        role="img"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512"
                        class="svg-inline--fa fa-angle-double-right fa-w-14 fa-5x iconplus float-right"
                    >
                        <g>
                            <path
                                fill="#000000"
                                d="m408,184h-136c-4.418,0 -8,-3.582 -8,-8v-136c0,-22.09 -17.91,-40 -40,-40s-40,17.91 -40,40v136c0,4.418 -3.582,8 -8,8h-136c-22.09,0 -40,17.91 -40,40s17.91,40 40,40h136c4.418,0 8,3.582 8,8v136c0,22.09 17.91,40 40,40s40,-17.91 40,-40v-136c0,-4.418 3.582,-8 8,-8h136c22.09,0 40,-17.91 40,-40s-17.91,-40 -40,-40zM408,184"
                                class="fa-secondary">
                            </path>
                        </g>
                    </svg>
                </a>

            </div>
        </div>
    @endauth

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
