<?php

namespace App\Http\Controllers\Coordinator;

use App\Http\Controllers\Controller;
use App\Models\ActionPlan;
use App\Models\Program;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $program = Program::findOrFail($id);
        return view( '1stRoleBlades.addActionPlan',compact('program'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ActionPlan::create($request->all());
        return redirect()->route('coordinator.action.show', $request->program);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $program = Program::findOrFail($id);

        $actions = ActionPlan::where('program',$id)->get();

        return view('1stRoleBlades.listActionPlan', compact('program','actions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $action = ActionPlan::findOrFail($id);
        return view( '1stRoleBlades.editActionPlan',compact('action'));
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
        $action = ActionPlan::findOrFail($id);
        $action->update($request->all());
        return redirect(route('coordinator.action.show', $action->program));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $action = ActionPlan::findOrFail($id);
        $action->delete();
        return redirect()->route('coordinator.action.show', $action->program);
    }
}
