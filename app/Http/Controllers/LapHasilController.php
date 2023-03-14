<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LapHasilController extends Controller
{
    //
    public function show($id)
    {

        // $proposal = Proposals::where('id_proposal', $id)->first();
        $laphasil = DB::table('laporan_hasils')
        ->leftJoin('bidangs', 'bidangs.id_bidang', 'laporan_hasils.id_bidang')
        ->leftJoin('skims', 'skims.id_skim', 'laporan_hasils.id_skim')
        ->orderBy('id_laphasil','desc')
        ->where('id_laphasil', $id)->first();
        $proposal = DB::table('proposals')
        ->leftJoin('bidangs', 'bidangs.id_bidang', 'proposals.id_bidang')
        ->leftJoin('skims', 'skims.id_skim', 'proposals.id_skim')
        ->orderBy('id_proposal','desc')
        ->where('id_proposal', $laphasil->id_proposal)->first();
        $dikti = 0;
        $unla = 0;
        $lainnya = 0;
        $total = 0;
        $dikti = $laphasil->dana_dikti;
        $unla = $laphasil->dana_unla;
        $lainnya = $laphasil->dana_lainnya;
        $total = $dikti + $unla + $lainnya;
        
        return view('laphasil.detail_laphasil', [
            'data' => $laphasil,
            'proposal' => $proposal,
            'total' => $total
        ]);
    }
}
