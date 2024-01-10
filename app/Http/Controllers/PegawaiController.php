<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index(){
        $daftar = Pegawai::all();
        $title = 'Hapus Pegawai !';
        $text = "Yakin Hapus Pegawai ?";
        confirmDelete($title, $text);
        return view('draft.index', ['daftar' => $daftar]);
    }

    public function create(){
        return view('draft.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jabatan' => 'required',
            'npwp' => 'required',
            'nama_bank' => 'required',
            'no_rek' => 'required'

        ]);

        $newdata = Pegawai::create($data);
        return redirect(route('draft.index'))->with('success', 'Data Sukses Dibuat !');
    }

    public function edit(Pegawai $edits){
        return view('draft.edit', ['edits' => $edits]);
    }

    public function update(Pegawai $edits, Request $request){
        $data_update = $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jabatan' => 'required',
            'npwp' => 'required',
            'nama_bank' => 'required',
            'no_rek' => 'required'
        ]);

        $edits->update($data_update);

        return redirect(route('draft.index'))->with('success', 'Data Sukses Diupdate !');
    }

    public function destroy(Pegawai $edits){
        $edits->delete();
        return redirect(route('draft.index'))->with('success', 'Data Berhasil Dihapus !');
    }
}
