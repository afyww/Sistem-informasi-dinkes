<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Exports\SuratsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index()
    {
        $surat = Surat::all();
        
        return view('history', ['surat' => $surat]);
    }
    public function filter(Request $request){
        $surat = Surat::all();

        $pd_tgl = $request->pd_tgl;
        $end_date = $request->end_date;

        $have = Surat::whereDate('pd_tgl', '>=', $pd_tgl)
                        ->whereDate('pd_tgl', '<=', $end_date)
                        ->get();

        return view('history', ['surat' => $have]);

    }
    public function export() 
    {
        
        return Excel::download(new SuratsExport, 'surats.xlsx');

    }
}
