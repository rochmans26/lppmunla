<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proposals;
use App\Models\Publikasi;
use App\Models\LaporanHasil;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('dashboard.index', [
            'proposals' => Proposals::all(),
            'laporan_pkm' => LaporanHasil::all(),
            'admin' => User::where('level', 'Admin')->get(),
            'publikasi' => Publikasi::all()
        ]);
    }
}
