<?php

namespace App\Http\Controllers;

use App\Models\ActionPlan;
use App\Models\Fund;
use App\Models\Program;
use App\Models\Proposal;
use App\Models\Report;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $allprograms = Program::all();
            $createdPrograms = $allprograms->where('created_by', $user->id);
            $participatedPrograms = $user->attends;
            $myprograms = $createdPrograms->merge($participatedPrograms);

            $allprogramssort = $allprograms->sortByDesc('updated_at');
            $programs = $myprograms->sortByDesc('name');

            if (Auth::user()->isAdmin()) {
                $proposals = Proposal::all()->where('status','0');
                $reports = Report::all()->where('status','0');
                $funds = Fund::all()->where('status','0');
                return view('1stRoleBlades.dashboard', compact('allprogramssort', 'proposals','reports','funds'));
            }else if (Auth::user()->isCreator()) {
                $allactions = ActionPlan::all();
                $actions = $allactions->sortByDesc('program');
                return view('2ndRoleBlades.dashboard', compact('allprogramssort','programs', 'actions'));
            }else if ((Auth::user()->isUser())) {
                $alltasks = Task::all()->where('PIC', Auth::id());
                $ongoingTask = $alltasks->where('status', '0');
                $tasks = $ongoingTask->sortByDesc('due_date');
                return view('3rdRoleBlades.dashboard', compact('programs', 'tasks'));
            }
        }

        return redirect()->route('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
