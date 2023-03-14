<?php

namespace App\Http\Controllers;

use App\Models\Proposals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProposalController extends Controller
{
    //
    public function show($id)
    {
        // $proposal = Proposals::where('id_proposal', $id)->first();
        $proposal = DB::table('proposals')
        ->leftJoin('bidangs', 'bidangs.id_bidang', 'proposals.id_bidang')
        ->leftJoin('skims', 'skims.id_skim', 'proposals.id_skim')
        ->orderBy('id_proposal','desc')
        ->where('id_proposal', $id)->first();
        
        return view('proposal.detail_proposal', [
            'data' => $proposal
        ]);
    }
}
