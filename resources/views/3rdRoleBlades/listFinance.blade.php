@extends('layouts.app')
@section('title', 'Finance')
@section('content')

    <div class="d-flex justify-content-between">
        <h1 class="col font-weight-bold">Finance List</h1>
        @auth()
            <div class="clearfix">
                {{-- auth to limit content, it cannot be accessed until login --}}
                <div class="float-right">
                    {{--                <a href="{{route('action.create')}}" class="btn btn-primary btn-block" role="button" aria-pressed="true">New action</a>--}}
                    <a role="button" aria-pressed="true"
                       title="Add Finance"
                       data-toggle="modal"
                       data-target="#addFinance">
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
    </div>

    {{--            modal add finance--}}
    <div class="modal fade" id="addFinance">
        <div class="modal-dialog">
            <div class="modal-content card-bg-change">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title font-weight-bold">Add Finance </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body" style="text-align: left;">
                    <form action="{{route ('student.finance.store')}}" method="POST">
                        <div class="form-group">
                            {{ csrf_field() }}
                            <input type="hidden" name="program" value="{{$program->id}}">
                            <div class="form-group">
                                <label>Name: </label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label>Type: </label>
                                <select name="type" class="custom-select">
                                    <option hidden>Select Type</option>
                                    <option value="0">Income</option>
                                    <option value="1">Expenditure</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Value: </label>
                                <input type="text" class="form-control" name="value" required>
                            </div>

                        </div>
                        <div class="form-group">
                            <button class="btnA circular bluestar font-weight-bold p-2 blue-hover" type="submit">Add Finance</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container-table100">
        <div class="wrap-table100">
            <div class="table100 ver1">

                <div class="">
                    <div class="table100-nextcols">
                        <table>
                            <thead>
                            <tr class="row100 head">
                                <th class="cell100 column2">Name</th>
                                <th class="cell100 column3">Type</th>
                                <th class="cell100 column6">Value</th>
                                <th class="cell100 column6">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($finances as $finance)
                                <tr class="row100 body">
                                    <td class="cell100 column2">
                                        {{$finance->name}}
                                    </td>
                                    <td class="cell100 column3">
                                        @if($finance->type == '0')
                                            <div class="text-success">Income</div>
                                        @elseif($finance->type == '1')
                                            <div class="text-danger">Expenditure</div>
                                        @endif
                                    </td>
                                    <td class="cell100 column3">Rp. {{$finance->value}}</td>
                                    <td class="cell100 column9 d-flex">

                                        {{--                                    edit--}}

                                        <button class="btnA circular purplestar purple-hover iconAct mr-1 p-1" title="Edit"
                                                data-toggle="modal"
                                                data-target="#editFinance-{{$finance->id}}">
                                            <i class="fa fa-pencil"></i>
                                        </button>

                                        {{--                                    delete--}}
                                        <form action="{{route('student.finance.destroy', $finance)}}"
                                              method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btnA circular redstar red-hover iconAct mr-1 p-1" title="Delete">
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>

                                {{--            modal edit finance--}}
                                <div class="modal fade" id="editFinance-{{$finance->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content card-bg-change">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title font-weight-bold">Edit {{$finance->name}} </h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body" style="text-align: left;">
                                                    <form action="{{route ('student.finance.update',$finance)}}" method="POST">
                                                        <div class="form-group">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="_method" value="PATCH">
                                                            <div class="form-group">
                                                                <label>Name: </label>
                                                                <input type="text" class="form-control" name="name" value="{{$finance->name}}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Type: </label>
                                                                <select name="type" class="custom-select">
                                                                    <option hidden>
                                                                        @if($finance->type == '0')
                                                                            Income
                                                                        @elseif($finance->type == '1')
                                                                            Expenditure
                                                                        @endif
                                                                    </option>
                                                                    <option value="0">Income</option>
                                                                    <option value="1">Expenditure</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Value: </label>
                                                                <input type="text" class="form-control" name="value" value="{{$finance->value}}" required>
                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <button class="btnA circular bluestar font-weight-bold p-2 blue-hover" type="submit">Edit Finance</button>
                                                        </div>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection