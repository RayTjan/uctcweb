@extends('layouts.app')
@section('title', 'Program')
@section('content')
    <div class="container clearfix" style="margin-top: 20px;">
        <div class="row">
            <h1 class="col font-weight-bold">Program View</h1>
        </div>

        <div class="d-flex justify-content-between">

            <div class="align-self-center">
                <div class="font-weight-bold">Sort by:</div>
                <div>
                    <form action="{{route('lecturer.program.index')}}"
                          method="GET" class="d-inline-block mr-1">
                        {{ csrf_field() }}
                        @if($page == "all")
                            <button class="btnA circular gray-pages font-weight-bold p-1 gray-hover widthSubmitButton" role="button"  type="submit" disabled="disabled">All</button>
                        @else
                            <button class="btnA circular graystar font-weight-bold p-1 gray-hover widthSubmitButton" role="button"  type="submit">All</button>
                        @endif
                    </form>
                    @foreach($types as $type)
                        <form action="{{route('lecturer.program.filterProgramType')}}"
                              method="GET" class="d-inline-block mr-1">
                            {{ csrf_field() }}
                            <input name="value" type="hidden" value="{{$type->id}}">
                            @if($page == "type-".$type->id)
                                <button class="btnA circular font-weight-bold p-1 gray-pages gray-hover" role="button"
                                        type="submit" disabled="disabled">{{$type->name}}</button>
                            @else
                                <button class="btnA circular graystar font-weight-bold p-1 gray-hover" role="button"
                                        type="submit">{{$type->name}}</button>
                            @endif
                        </form>
                        {{--                        <a href="{{route('lecturer.program.filterProgram')}}" class="btn btn-primary btn-block" role="button" aria-pressed="true">$type->name</a>--}}
                    @endforeach
                    @foreach($categories as $category)
                        <form action="{{route('lecturer.program.filterProgramCategory')}}"
                              method="GET" class="d-inline-block mr-1">
                            {{ csrf_field() }}
                            <input name="value" type="hidden" value="{{$category->id}}">
                            @if($page == "category-".$category->id)
                                <button class="btnA circular gray-pages font-weight-bold p-1 gray-hover" role="button"  type="submit" disabled="disabled">{{$category->name}}</button>
                            @else
                                <button class="btnA circular graystar font-weight-bold p-1 gray-hover" role="button"  type="submit">{{$category->name}}</button>
                            @endif
                        </form>
                    @endforeach
                    <form action="{{route('lecturer.program.filterProgramStatus')}}"
                          method="GET" class="d-inline-block mr-1">
                        {{ csrf_field() }}
                        <input name="value" type="hidden" value="0">
                        @if($page == "status-0")
                            <button class="btnA circular gray-pages font-weight-bold p-1 gray-hover widthSubmitButton" role="button"  type="submit" disabled="disabled">Pending</button>
                        @else
                            <button class="btnA circular graystar font-weight-bold p-1 gray-hover widthSubmitButton" role="button"  type="submit">Pending</button>
                        @endif
                    </form>
                    <form action="{{route('lecturer.program.filterProgramStatus')}}"
                          method="GET" class="d-inline-block mr-1">
                        {{ csrf_field() }}
                        <input name="value" type="hidden" value="1">
                        @if($page == "status-1")
                            <button class="btnA circular gray-pages font-weight-bold p-1 gray-hover widthSubmitButton" role="button"  type="submit" disabled="disabled">Ongoing</button>
                        @else
                            <button class="btnA circular graystar font-weight-bold p-1 gray-hover widthSubmitButton" role="button"  type="submit">Ongoing</button>
                        @endif
                    </form>
                    <form action="{{route('lecturer.program.filterProgramStatus')}}"
                          method="GET" class="d-inline-block mr-1">
                        {{ csrf_field() }}
                        <input name="value" type="hidden" value="2">
                        @if($page == "status-2")
                            <button class="btnA circular gray-pages font-weight-bold p-1 gray-hover widthSubmitButton" role="button"  type="submit" disabled="disabled">Finished</button>
                        @else
                            <button class="btnA circular graystar font-weight-bold p-1 gray-hover widthSubmitButton" role="button"  type="submit">Finished</button>
                        @endif
                    </form>
                    <form action="{{route('lecturer.program.filterProgramStatus')}}"
                          method="GET" class="d-inline-block mr-1">
                        {{ csrf_field() }}
                        <input name="value" type="hidden" value="3">
                        @if($page == "status-3")
                            <button class="btnA circular gray-pages font-weight-bold p-1 gray-hover" role="button"  type="submit" disabled="disabled">Suspended</button>
                        @else()
                            <button class="btnA circular graystar font-weight-bold p-1 gray-hover" role="button"  type="submit">Suspended</button>
                        @endif
                    </form>
                </div>
            </div>

            <div class="clearfix align-self-center">
                <div class="">
                    <a href="{{route('lecturer.program.create')}}" role="button" aria-pressed="true">
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
                                    fill="currentColor"
                                    d="m408,184h-136c-4.418,0 -8,-3.582 -8,-8v-136c0,-22.09 -17.91,-40 -40,-40s-40,17.91 -40,40v136c0,4.418 -3.582,8 -8,8h-136c-22.09,0 -40,17.91 -40,40s17.91,40 40,40h136c4.418,0 8,3.582 8,8v136c0,22.09 17.91,40 40,40s40,-17.91 40,-40v-136c0,-4.418 3.582,-8 8,-8h136c22.09,0 40,-17.91 40,-40s-17.91,-40 -40,-40zM408,184"
                                    class="iconplus">
                                </path>
                            </g>
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        <div class="row" style="margin-top: 30px;">
            <link href='//fonts.googleapis.com/css?family=Roboto:100,400,300' rel='stylesheet' type='text/css'>
            <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
            <div class="quiz-window">
                <div class="quiz-window-body">
                    <div class="gui-window-awards">
                        <ul class="guiz-awards-row guiz-awards-header">
                            <li class="guiz-awards-header-star">&nbsp;</li>
                            <li class="guiz-awards-header-title">Name</li>
                            <li class="guiz-awards-header-time">Date</li>
                        </ul>

                        <?php $yes = 0; ?>
                        @foreach($myPrograms as $program)
                            <ul class="
                            @if($yes%2 == 0)
                                guiz-awards-row guiz-awards-row-even
                            @else
                                guiz-awards-row guiz-awards-row
                            @endif
                                quizz">
                                <a href="{{route('lecturer.program.show',$program)}}" class="a-none">
                                    <li class="guiz-awards-star">
                                <span class="
                                    @if($program->status == '0')
                                    star yellowstar
                                    @elseif($program->status == '1')
                                    star toscastar
                                    @elseif($program->status == '2')
                                    star greenstar
                                    @elseif($program->status == '3')
                                    star redstar
                                    @endif
                                    "></span>
                                    </li>
                                    <li class="guiz-awards-title">{{$program->name}}
                                        <div class="guiz-awards-subtitle">{{$program->goal}}</div>
                                    </li>
                                    <li class="guiz-awards-time">{{ str_replace("-","/",date("d-m-Y", strtotime($program->program_date))) }}</li>
                                </a>
                            </ul>
                            <?php $yes += 1; ?>
                        @endforeach

                    </div>
                </div>
            </div>
            {{--            <table class="table table-striped table-dark">--}}
            {{--                <thead>--}}
            {{--                <tr>--}}
            {{--                    <th scope="col">Title</th>--}}
            {{--                    <th scope="col">View</th>--}}
            {{--                    <th scope="col">Type</th>--}}
            {{--                    <th scope="col">Category</th>--}}
            {{--                    <th scope="col">Description</th>--}}
            {{--                    <th scope="col">Status</th>--}}
            {{--                    <th scope="col">Goal</th>--}}
            {{--                    <th scope="col">Date</th>--}}
            {{--                    <th scope="col">Created by</th>--}}
            {{--                </tr>--}}
            {{--                </thead>--}}
            {{--                <tbody>--}}
            {{--                @foreach($programs as $program)--}}
            {{--                    <tr>--}}
            {{--                        <td>{{$program->name}}</td>--}}
            {{--                        <td><form action="{{ route('program.show' , $program)}}" method="POST">--}}
            {{--                            <input name="_method" type="hidden" value="DELETE">--}}
            {{--                            {{ csrf_field() }}--}}
            {{--                            <button type="submit" class="btn btn-primary">View</button>--}}
            {{--                        </form>--}}
            {{--                        </td>--}}
            {{--                        <td><a href="{{route('program.show',$program)}}">View</a></td>--}}
            {{--                        <td>{{$program->categorized->name}}</td>--}}
            {{--                        <td>{{$program->classified->name}}</td>--}}
            {{--                        <td>{{$program->description}}</td>--}}
            {{--                        <td>{{$program->status}}</td>--}}
            {{--                        <td>{{$program->goal}}</td>--}}
            {{--                        <td>{{$program->program_date}}</td>--}}
            {{--                        <td>{{$program->creator->name}}</td>--}}
            {{--                    </tr>--}}
            {{--                @endforeach--}}
            {{--                </tbody>--}}
            {{--            </table>--}}
        </div>
    </div>
@endsection
