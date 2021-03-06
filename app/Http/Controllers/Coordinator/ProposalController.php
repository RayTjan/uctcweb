<?php

namespace App\Http\Controllers\Coordinator;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proposals = Proposal::all();
        $requestedProposals = $proposals->where('status', '0');
        $approvedProposals = $proposals->where('status', '1');
        $rejectedProposals = $proposals->where('status', '2');
        return view('1stRoleBlades.listRequest', compact('proposals','requestedProposals','approvedProposals','rejectedProposals'));
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
        $pdf = $request->validate([
            'proposal' => 'required|max:10000|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp,pdf',
        ]);

        $pdfName = $pdf['proposal']->getClientOriginalName().'-'.time().'.'.$pdf['proposal']->extension();
        $pdf['proposal']->move(public_path('/files/proposal'), $pdfName);

        $dataProposal = array(
            'proposal' => $pdfName,
            'status' => '0',
            'program' => $request->selected_program,
        );

        Proposal::create($dataProposal);
        return redirect(route('coordinator.proposal.show', $request->selected_program));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $program = Program::findOrFail($id);
        $proposals = Proposal::where('program', $id)->get();

        $lastProposal = $proposals->last();
        $addAvailability = true;
        if ($lastProposal != null){
            if ($lastProposal->status == '0' || $lastProposal->status == '1'){
                $addAvailability = false;
            }
        }

        return view('1stRoleBlades.listProposalProgram', compact('proposals', 'program','addAvailability'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposal $proposal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proposal $proposal)
    {
        $pdf = $request->validate([
            'proposal' => 'required|max:10000|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp,pdf',
        ]);

        $pdfName = $pdf['proposal']->getClientOriginalName().'-'.time().'.'.$pdf['proposal']->extension();
        $pdf['proposal']->move(public_path('/files/proposal'), $pdfName);

        $dataProposal = array(
            'proposal' => $pdfName,
            'status' => '0',
            'program' => $request->selected_program,
        );

        $proposal->update([
            'proposal' => $dataProposal['proposal']
        ]);
        return redirect(route('coordinator.proposal.show', $request->selected_program));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposal $proposal)
    {
        $proposal->delete();
        return empty($proposal) ? redirect()->back()->with('Fail', "Failed to delete")
            : redirect()->back()->with('Success', 'Success delete proposal');
    }

    public function approve($id){
        $proposal = Proposal::findOrFail($id);
        $proposal->update([
            'status' => '1',
        ]);

        return empty($program) ? redirect()->back()->with('Fail', "Failed to approve")
            : redirect()->back()->with('Success', 'Success program proposal: #('.$proposal->program->name.') approved');
    }
    public function reject($id, Request $request){
        $proposal = Proposal::findOrFail($id);
        $proposal->update([
            'status' => '2',
            'note' => $request->note,
        ]);

        return empty($program) ? redirect()->back()->with('Fail', "Failed to reject")
            : redirect()->back()->with('Success', 'Success program proposal: #('.$proposal->program->name.') Rejected');
    }
}
