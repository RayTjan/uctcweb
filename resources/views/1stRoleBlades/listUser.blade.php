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

    @auth()
        <div class="clearfix">
            {{-- auth to limit content, it cannot be accessed until login --}}
            <div class="float-right">
                 <a href="{{route('coordinator.user.create')}}" role="button" aria-pressed="true">
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
                                fill="#fff"
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
            <div class="">
                <div class="gui-window-awards">


                    <ul class="quiz-window-body guiz-awards-row guiz-awards-row-margin mb-2 budget card-bg-change">
                        <li class="guiz-awards-time customComittee font-weight-bold">Name</li>
                        <li class="guiz-awards-time customComittee font-weight-bold">Email</li>
                        <li class="guiz-awards-time customComittee font-weight-bold">Role</li>
                        <li class="guiz-awards-time customComittee font-weight-bold">Status</li>
                        <li class="guiz-awards-time customComittee font-weight-bold">Action</li>
                    </ul>

                    @foreach($users as $user)
                    <ul class="quiz-window-body guiz-awards-row guiz-awards-row-margin mb-2 budget">
                        <li class="guiz-awards-time customComittee">{{$user->identity->name}}</li>
                        <li class="guiz-awards-time customComittee">{{$user->email}}</li>
                        <li class="guiz-awards-time customComittee">{{$user->role->name}}</li>
                        <li class="guiz-awards-time customComittee">
                            @if($user->identity_type == 'App\Models\Lecturer')
                                Lecturer
                            @elseif($user->identity_type == 'App\Models\Staff')
                                Staff
                            @elseif($user->identity_type == 'App\Models\Student')
                                Student
                            @endif
                        </li>
                        <li class="guiz-awards-time customComittee">
                            <div class="dropdown">
                                <div class="dropdown show">
                                    <a class="dropdown-button iconCommitteeAct" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26.414" height="13.207" viewBox="0 0 26.414 13.207">
                                            <path id="Path_1462" data-name="Path 1462" d="M1215,2144l12,12,12-12Z" transform="translate(-1213.793 -2143.5)" fill="none" stroke="#000" stroke-linejoin="round" stroke-width="1"/>
                                        </svg>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{route('coordinator.user.edit',$user)}}">Edit</a>
                                        <a class="dropdown-item btnDelete" href="#"
                                                data-toggle="modal"
                                                data-target="#delete-{{$user->id}}">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                        {{--        Delete User--}}

                        <div class="modal fade" id="delete-{{ $user->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Are you sure want to delete this user {{ $user->identity->name }} ?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body d-inline-block text-center" style="text-align: left;">
                                        <form action="{{ route('coordinator.user.destroy', $user) }}" method="post" class="d-inline-block">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btnA circular redstar font-weight-bold p-2 red-hover widthSubmitButton">Yes</button>
                                        </form>
                                        <button type="button" class="btnA circular bluestar font-weight-bold p-2 blue-hover widthSubmitButton" data-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
