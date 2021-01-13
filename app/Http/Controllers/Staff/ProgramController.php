<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Finance;
use App\Models\Program;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::all();
        return view('2ndRoleBlades.listProgram', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        $types = Type::all();
        return view( '2ndRoleBlades.addProgram',compact('users','categories','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Program::create($request->all());
        return redirect()->route('staff.program.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $program = Program::findOrFail($id);
        $programs = Program::all()->except($id)->pluck('id');

        $committees = User::whereIn('id',function ($query) use ($programs){
            $query->select('uctc_user_id')->from('uctc_program_user')->where('is_approved','1')->whereNotIn('uctc_program_id',$programs);
        })->get();

        $committeeList = User::whereNotIn('id',function ($query) use ($programs){
            $query->select('uctc_user_id')->from('uctc_program_user')->whereNotIn('uctc_program_id',$programs);
        })->where('role_id',3)->get();

//        dd(User::whereIn('id',function ($query) use ($programs){
//            $query->select('uctc_user_id')->from('uctc_program_user')->where('is_approved','1')->whereNotIn('uctc_program_id',$programs);
//        })->get());

        return view('2ndRoleBlades.detailProgram',compact('program','committeeList','committees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        $users = User::all();
        $categories = Category::all();
        $types = Type::all();
        return view('2ndRoleBlades.editProgram',compact('program','users','categories','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $data = $request->all();
        $program->update($request->all());


        //untuk Finances
        foreach ($data['value'] as $item => $value) {
            $dataFinance = array(
                'name' => $data['nameBudget'][$item],
                'value' => $data['value'][$item],
                'type' => $data['typeFinance'][$item],
                'program' => $program->id,
            );

            if (!isEmpty($dataFinance['name'])&&!isEmpty($dataFinance['value'])){
                dd($dataFinance['type']);
                Finance::create($dataFinance);
            }
        }

        return redirect()->route('staff.program.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $program = Program::findOrFail($id);
        $program->delete();
        return redirect()->route('staff.program.index');
    }

}
