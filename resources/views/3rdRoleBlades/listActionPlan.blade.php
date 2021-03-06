@extends('layouts.app')
@section('title', 'Action Plan')
@section('content')

    <script>
        $(document).ready( function() {
            $('.dropdown-button').dropdown();
        });
    </script>

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
            <a href="{{route('student.action.show',$program)}}" class="a-none blackhex d-inline-block">
                <h6>Action Plan</h6>
            </a>
        </div>

        <div class="row">
            <h1 class="col font-weight-bold">Action Plan {{ $program->name }}</h1>
        </div>

        <div class="row" style="margin-top: 30px;">
            <link href='//fonts.googleapis.com/css?family=Roboto:100,400,300' rel='stylesheet' type='text/css'>
            <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
            <div class="quiz-window quiz-padding">
                <div class="quiz-window-body">
                    <div class="gui-window-awards">
                        <ul class="guiz-awards-row guiz-awards-header">
                            <li class="guiz-awards-header-star">&nbsp;</li>
                            <li class="guiz-awards-header-title">Name</li>
                            @if($edit == true)
                            <li class="guiz-awards-header-time">Action</li>
                            @endif
                        </ul>

                        <?php $yes = 0; ?>
                        @foreach($actions as $actionPlan)
                            <ul class="
                            @if($yes%2 == 0)
                                guiz-awards-row guiz-awards-row-even
                            @else
                                guiz-awards-row guiz-awards-row
                            @endif
                                quizz">
                                <a href="{{route('student.actionTask.show', $actionPlan)}}" class="a-none">
                                    <li class="guiz-awards-star">
                                <span class="star"></span>
                                    </li>
                                    <li class="guiz-awards-title">{{$actionPlan->name}}
                                        <div class="guiz-awards-subtitle">{{$actionPlan->description}}</div>
                                    </li>
                                    @if($edit == true)
                                    <li class="guiz-awards-time">
                                        <div class="dropdown">
                                            <div class="dropdown show">
                                                <a class="dropdown-button iconCommitteeAct" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="26.414" height="13.207" viewBox="0 0 26.414 13.207">
                                                        <path id="Path_1462" data-name="Path 1462" d="M1215,2144l12,12,12-12Z" transform="translate(-1213.793 -2143.5)" fill="none" stroke="#000" stroke-linejoin="round" stroke-width="1"/>
                                                    </svg>
                                                </a>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <form action="{{ route('student.action.edit', $actionPlan) }}" method="get">
                                                        @csrf
                                                        <button type="submit" class="pl-2 btnA dropdown-item">Edit</button>
                                                    </form>
                                                    <button
                                                        type="button"
                                                        data-toggle="modal"
                                                        data-target="#deleteAction-{{ $actionPlan->id }}"
                                                        class="pl-2 btnA dropdown-item btnDelete">Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                </a>
                            </ul>

                            {{--        Delete Action Plan--}}

                            <div class="modal fade" id="deleteAction-{{$actionPlan->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Are you sure want to delete this {{ $actionPlan->name }} action plan?</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body d-inline-block text-center" style="text-align: left;">
                                            <form action="{{ route('student.action.destroy', $actionPlan) }}" method="post" class="d-inline-block">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btnA circular redstar font-weight-bold p-2 red-hover">Yes</button>
                                            </form>
                                            <button type="button" class="btnA circular bluestar font-weight-bold p-2 blue-hover" data-dismiss="modal">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $yes += 1; ?>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
