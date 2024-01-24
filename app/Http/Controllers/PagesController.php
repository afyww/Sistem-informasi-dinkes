<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Surat;
use App\Models\Vip;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function buatsurat()
    {
        return view('buatsurat');
    }

    public function history()
    {
        return view('history');
    }

    public function dashboard(Request $request)
    {
        $grafik = Surat::selectRaw("COUNT(*) as count, DATE_FORMAT(pd_tgl, '%M') as month_name, MONTH(pd_tgl) as month_number")
            ->whereYear('pd_tgl', date('Y'))
            ->groupBy('month_number', 'month_name')
            ->orderBy('month_number')
            ->pluck('count', 'month_name');

        $labels = $grafik->keys();
        $data = $grafik->values();

        //chart2
        $selectedYear2 = $request->input('year', date('Y'));
        $selectedMonth2 = $request->input('month', date('F'));


        $grafik2 = Surat::selectRaw("COUNT(*) as count, nama, DATE_FORMAT(tgl_kegiatan, '%M') as month_name, MONTH(tgl_kegiatan) as month_number")
            ->whereYear('tgl_kegiatan', $selectedYear2)
            ->groupBy('nama', 'month_name', 'month_number')
            ->orderBy('month_number')
            ->get();

        // Mengelompokkan data berdasarkan Nama untuk Chart.js
        $grafik2ByNama = $grafik2->groupBy('nama');

        $labels2 = $grafik2->pluck('month_name')->unique()->values();
        $data2 = [];

        // Mendapatkan data untuk setiap Nama
        foreach ($grafik2ByNama as $nama => $dataNama) {

            $data2[] = [
                'label' => '' . $nama,
                'data' => $dataNama->pluck('count', 'month_name')->toArray(),
                'backgroundColor' => 'rgba(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ', 0.2)',
                'borderColor' => 'rgba(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ', 1)',
                'borderWidth' => 1,
            ];
        }



        $selectedYear3 = $request->input('year', date('Y'));
        // Default to the current month if no specific month is provided
        $selectedMonth3 = $request->input('month', date('F'));

        $grafik3 = Surat::selectRaw("COUNT(*) as count, anggaran, DATE_FORMAT(pd_tgl, '%M') as month_name, MONTH(pd_tgl) as month_number")
            ->whereYear('pd_tgl', $selectedYear3)
            ->groupBy('anggaran', 'month_number', 'month_name')
            ->orderBy('month_number')
            ->get();


        $labels3 = $grafik3->pluck('month_name')->unique()->toArray();
        $dataSets = [];

        $anggaranTypes = $grafik3->pluck('anggaran')->unique();

        foreach ($anggaranTypes as $anggaranType) {
            $data3 = $grafik3->where('anggaran', $anggaranType)->pluck('count', 'month_name')->toArray();
            $dataSets[] = [
                'label' => $anggaranType,
                'data' => $data3,
            ];
        }

        $total_surat = Surat::count();
        $total_karyawan = Pegawai::count();
        $total_vip = Vip::count();

        $anggarantertinggi = Surat::select('anggaran')
            ->groupBy('anggaran')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(1)
            ->pluck('anggaran')
            ->first();

        return view('dashboard', compact('total_surat', 'total_vip', 'total_karyawan', 'labels', 'data', 'labels2', 'data2', 'labels3', 'dataSets', 'anggarantertinggi', 'selectedYear3', 'selectedMonth3', 'selectedYear3', 'selectedMonth2'));
    }

    public function suratindividu()
    {


        $pemberi = Vip::all();
        $namapg = Pegawai::all();

        return view('suratindividu', [
            'pemberi' => $pemberi, 'nama' => $namapg
        ]);
    }

    public function suratkolektif()
    {

        $pemberi = Vip::all();
        $namapg = Pegawai::all();

        return view('suratkolektif', [
            'pemberi' => $pemberi, 'nama' => $namapg
        ]);
    }

    public function suratduplikatindividu()
    {
        $pemberi = Vip::all();
        $namapg = Pegawai::all();
        return view('suratduplikat-individu', [
            'pemberi' => $pemberi, 'nama' => $namapg
        ]);
    }

    public function suratduplikatkolektif()
    {
        $pemberi = Vip::all();
        $namapg = Pegawai::all();
        return view('suratduplikat-kolektif', [
            'pemberi' => $pemberi, 'nama' => $namapg
        ]);
    }

    public function profil()
    {
        return view('profil');
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $surat = Surat::where('nama', 'LIKE', '%' . $request->search . '%')->get();
        } else {
            $surat = Surat::all();
        }
        return view('history', ['surat' => $surat]);
    }
}
