<?php

namespace App\Http\Controllers\Coordinator;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Proposal;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::all();
        $requestedReports = $reports->where('status', '0');
        $approvedReports = $reports->where('status', '1');
        $rejectedReports = $reports->where('status', '2');
        return view('1stRoleBlades.listReport',compact('reports','requestedReports','approvedReports','rejectedReports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $program = Program::findOrFail($id);

        if (isset($program->hasReports[0])) {
            return redirect(route('coordinator.report.show',$program));
        }
        return view('1stRoleBlades.addReport',compact('program'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //perubahan status pada program

        $pdf = $request->validate([
//            'report' => 'required|max:50000|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp',
            'report' => 'required|max:10000|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp,pdf',
        ]);

        $pdfName = $pdf['report']->getClientOriginalName().'-'.time().'.'.$pdf['report']->extension();
        $pdf['report']->move(public_path('/files/report'), $pdfName);

        $dataReport = array(
            'report' => $pdfName,
            'program' => $request->program,
        );

        Report::create($dataReport);
        return redirect(route('coordinator.program.show', $request->program));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $program = Program::findOrFail($id);
        $reports = Report::where('program',$id)->get();

        $lastReport = $reports->last();
        $addAvailability = true;
        if ($lastReport != null){
            if ($lastReport->status == '0' || $lastReport->status == '1'){
                $addAvailability = false;
            }
        }
        return view('1stRoleBlades.listReportProgram',compact('program','reports','addAvailability'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        $pdf = $request->validate([
            'report' => 'required|max:10000|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp,pdf',
        ]);

        $pdfName = $pdf['report']->getClientOriginalName().'-'.time().'.'.$pdf['report']->extension();
        $pdf['report']->move(public_path('/files/report'), $pdfName);

        $dataReport = array(
            'report' => $pdfName,
            'status' => $request->statusReport,
            'program' => $request->program,
        );

        $report->update([
            'report' => $dataReport['report']
        ]);

        return empty($report) ? redirect()->back()->with('Fail', "Failed to delete")
            : redirect()->back()->with('Success', 'Success delete report');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('coordinator.report.index');
    }
    public function approve($id){
        $report = Report::findOrFail($id);
        $report->update([
            'status' => '1',
        ]);

        return empty($program) ? redirect()->back()->with('Fail', "Failed to approve")
            : redirect()->back()->with('Success', 'Success program proposal: #('.$report->program->name.') approved');
    }
    public function reject($id, Request $request){
        $report = Report::findOrFail($id);
        $report->update([
            'status' => '2',
            'note' => $request->note,
        ]);

        return empty($program) ? redirect()->back()->with('Fail', "Failed to reject")
            : redirect()->back()->with('Success', 'Success program proposal: #('.$report->program->name.') Rejected');
    }
}
