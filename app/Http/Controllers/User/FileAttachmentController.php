<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ActionPlan;
use App\Models\FileAttachment;
use App\Models\Program;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileAttachmentController extends Controller
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
        return view('3rdRoleBlades.addAttachment', compact('program'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        FileAttachment::create([
            'name' => $request->name,
            'file_attachment' => $request->file_attachment,
            'program' => $request->program,
        ]);
        return redirect()->route('student.file.show', $request->program);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FileAttachment  $fileAttachment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $program = Program::findOrFail($id);

        //check edit
        $edit = false;
        $user = Auth::user();
        $participatedPrograms = $user->attends;
        foreach ($participatedPrograms as $pprogram){
            if ($pprogram->id == $program->id){
                $edit = true;
            }
        }
        if ($program->created_by == $user->id){
            $edit = true;
        }

        return view('3rdRoleBlades.listFileAttachment', compact('program','edit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FileAttachment  $fileAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = FileAttachment::findOrFail($id);
        return view('3rdRoleBlades.editAttachment', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FileAttachment  $fileAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $file = FileAttachment::findOrFail($id);
        $file->update($request->all());
        return redirect(route('student.file.show', $request->program));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FileAttachment  $fileAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = FileAttachment::findOrFail($id);
        $file->delete();
        return redirect(route('student.file.show', $file->program));
    }
}
