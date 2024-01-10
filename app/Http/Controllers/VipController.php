<?php

namespace App\Http\Controllers;

use App\Models\Vip;
use Illuminate\Http\Request;

class VipController extends Controller
{
    public function index()
    {   $daftarvip = Vip::all();
        $title = 'Hapus Pegawai !';
        $text = "Yakin Hapus Pegawai ?";
        confirmDelete($title, $text);
        return view('draftvip.indexvip', ['daftarvip' => $daftarvip]);
        
    }

    public function create()
    {
        return view('draftvip.createvip');
    }

    public function store(Request $request)
    {
        $datavip = $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jabatan' => 'required',
            'npwp' => 'required',
            'nama_bank' => 'required',
            'no_rek' => 'required'

        ]);

        $newdata = Vip::create($datavip);
        return redirect(route('draftvip.indexvip'))->with('success', 'Data Sukses Dibuat !');
    }

    public function edit(Vip $edits)
    {
        return view('draftvip.editvip', ['edits' => $edits]);
    }

    public function update(Request $request, Vip $edits)
    {
        $data_updatevip = $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jabatan' => 'required',
            'npwp' => 'required',
            'nama_bank' => 'required',
            'no_rek' => 'required'
        ]);

        $edits->update($data_updatevip);

        return redirect(route('draftvip.indexvip'))->with('success', 'Data Sukses Diupdate !');

    }

    public function destroy(Vip $edits)
    {
        $edits->delete();
        return redirect(route('draftvip.indexvip'))->with('success', 'Data Berhasil Dihapus !');
    }
}
