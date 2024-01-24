<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Pegawai;
use App\Models\Vip;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PdfController extends Controller
{

    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }

    public function KolektifPdf(Request $request)
    {
        // Ambil data yang dipilih dari Form
        $selectedProducts = $request->input('choose');
        if (is_array($selectedProducts)) {
            $count = count($selectedProducts);
        } else {
            $selectedProducts = [];
        }

        $datapgid = Pegawai::select('nama', 'nip', 'jabatan')
        ->whereIn('id', $selectedProducts)
        ->get();

        $nippg = Pegawai::whereIn('id', $selectedProducts)
        ->pluck('nip')
        ->implode(', ');

        $namapg = Pegawai::whereIn('id', $selectedProducts)
        ->pluck('nama')
        ->implode(', ');

        $jbtpg = Pegawai::whereIn('id', $selectedProducts)
        ->pluck('jabatan')
        ->implode(', ');



        // Ambil data dari formulir
        $nama = $request->input('pilih');
        $peg = null;
        $nip = null;
        $jbtvip = null;
        $duplicateSurat = Surat::where('no_surat', $request->no_surat)
            ->where('tahun_surat', $request->tahun_surat)
            ->first();
        if ($duplicateSurat) {
            alert()->info('Nomor Surat Sudah Ada !');
            return redirect()->back();
        }
        if (is_array($nama)) {
            foreach ($nama as $peg) {
                $data = Vip::where('nama', $peg)->first();
                if (is_object($data)) {
                    $jbtvip = $data->jabatan;
                    $nip = $data->nip;
                }
                $duplicateData = Surat::where('nama', $namapg)
                    ->where('tgl_kegiatan', $request->input('tanggal'))
                    ->exists();
                if ($duplicateData) {
                    alert()->question('Data Sudah Ada !', 'Tetap Bikin Surat ?')
                        ->showCancelButton('<a href="suratkolektif">Cancel</a>')
                        ->showConfirmButton('<a href="suratduplikatkolektif">Tetap Buat</a>')
                        ->focusConfirm(true);
                    return redirect()->back();
                }
            }
            


            $no_surat = $request->input('no_surat');
            $tahun_surat = $request->input('tahun_surat');
            $dasar = $request->input('dasar');
            $rangka = $request->input('rangka');
            $tanggal = $request->input('tanggal');
            $tempat = $request->input('tempat');
            $keluar = $request->input('keluar');
            $pdtgl = $request->input('pdtgl');
            $anggaran = $request->input('anggaran');
            $typesurat = ('kolektif');


            $this->fpdf->SetFont('Arial', 'B', 12);
            $this->fpdf->AddPage();
            $this->fpdf->Image(public_path('assets/img/Logo.jpg'), 10, 6, 34, 22);

            $this->fpdf->SetFont('Arial', 'B', 18);
            $this->fpdf->SetY(13);
            $this->fpdf->MultiCell(210, 1, 'DINAS KESEHATAN KOTA SEMARANG', 0, 'C');
            $this->fpdf->Ln(3);

            $this->fpdf->SetFont('Arial', 'B', 9);
            $this->fpdf->Ln(3);
            $this->fpdf->MultiCell(210, 1, 'Jl. Pandanaran No.79, Mugassari, Kec. Semarang Selatan, Kota Semarang, Jawa Tengah 50249', 0, 'C');

            $this->fpdf->Ln(3);
            $this->fpdf->MultiCell(210, 1, 'website : https://dinkes.semarangkota.go.id/ email : dinkes@semarangkota.go.id.', 0, 'C');

            $this->fpdf->Line(8, 28, 200, 28);
            $this->fpdf->SetLineWidth(0);
            $this->fpdf->Line(8, 29, 200, 29);
            

            $this->fpdf->SetFont('Arial', 'B', 15);
            $this->fpdf->SetY(39);
            $this->fpdf->MultiCell(0, 3, 'SURAT PERINTAH TUGAS', 0, 'C');
            $this->fpdf->Line(70, 43, 140, 43);
            $this->fpdf->Ln(3);
            $this->fpdf->SetFont('Arial', '', 13);
            $this->fpdf->MultiCell(0, 3, "NOMOR : 800 / $no_surat / $tahun_surat", 0, 'C');

            $this->fpdf->SetFont('Arial', '', 12);
            $this->fpdf->SetY(60);
            $this->fpdf->MultiCell(0, 0.5, 'Yang bertanda tangan dibawah ini :', 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "Nama                          : $peg", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "NIP                              : $nip", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "Jabatan                       : $jbtvip", 0, 'L');
            $this->fpdf->Ln(17);

            $this->fpdf->MultiCell(0, 0.5, 'Menugaskan kepada   :', 0, 'L');
            $this->fpdf->Ln();

            // Menghitung lebar halaman
            $pageWidth = $this->fpdf->GetPageWidth();

            // Menghitung lebar tabel (jumlah kolom x lebar masing-masing kolom)
            $columnNames = ['nama', 'nip', 'jabatan'];
            $columnWidth = 65; // Ganti dengan lebar masing-masing kolom Anda (dalam satuan yang Anda gunakan)
            $tableWidth = count($columnNames) * $columnWidth;

            // Menghitung margin kiri (kiri)
            $leftMargin = ($pageWidth - $tableWidth) / 2;

            // Menghitung margin atas (atas)
            $tableHeight = 10; // Ganti dengan tinggi tabel Anda (jumlah baris x tinggi baris)
            $pageHeight = $this->fpdf->GetPageHeight();
            $topMargin = ($pageHeight - $tableHeight) / 2;

            // Set batas margin
            $this->fpdf->SetMargins($leftMargin, $topMargin, $leftMargin, $topMargin);

            // Set posisi horizontal awal tabel
            $this->fpdf->SetX($leftMargin);

            $this->fpdf->SetY(108);
            $this->fpdf->Cell(0, 0, '', 0, 1);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Cell(65, 10, 'NAMA PEGAWAI', 1, 0, 'C');
            $this->fpdf->Cell(65, 10, 'NIP', 1, 0, 'C');
            $this->fpdf->Cell(65, 10, 'JABATAN', 1, 0, 'C');
            $this->fpdf->Cell(6, 1, '', 0, 1);
            $this->fpdf->Ln(8);

            $this->fpdf->SetFont('Arial', '', 10);
            // Tampilkan data produk dalam PDF
            foreach ($datapgid as $row) {
                $this->fpdf->Ln();
                $this->fpdf->Cell($columnWidth, 10, $row->nama, 1);
                $this->fpdf->Cell($columnWidth, 10, $row->nip, 1, 0, 'C');
                $this->fpdf->Cell($columnWidth, 10, $row->jabatan, 1, 0, 'C');
            }

            $this->fpdf->SetFont('Arial', '', 12);
            $this->fpdf->Ln(18);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 0.5, "Atas Dasar                          : $dasar", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 0.5, "Dalam rangka                     : $rangka", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 1, "Tanggal                              : $tanggal", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 1, "Tempat                               : $tempat", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 1, "Anggaran                              : $anggaran", 0, 'L');
            $this->fpdf->Ln(10);
            $this->fpdf->SetX(10);

            $this->fpdf->MultiCell(0, 0.5, 'Demikian surat tugas ini dibuat untuk dapat dilaksanakan sebagaimana mestinya.', 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(150, 1, "Dikeluarkan di                     : $keluar", 0, 'R');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(150, 1, "Pada Tanggal                     : $pdtgl", 0, 'R');
            $this->fpdf->Ln(47);
            $this->fpdf->SetX(10);

            // Menggunakan MultiCell dengan teks berformat
            $this->fpdf->SetFont('Arial', '', 12);
              
            $this->fpdf->MultiCell(175, 0.5, ($jbtvip), 0, 'R', false);
            $this->fpdf->Ln(17); // Menambah spasi 5 unit setelah MultiCell pertama
            $this->fpdf->SetX(10);

            $this->fpdf->MultiCell(175, 0.5, ($peg), 0, 'R', false);
            $this->fpdf->Ln(5); // Menambah spasi 5 unit setelah MultiCell kedua
            $this->fpdf->SetX(10);

            $this->fpdf->MultiCell(175, 0.5, "($nip)", 0, 'R', false);
            $this->fpdf->Ln(0); // Menambah spasi 5 unit setelah MultiCell ketiga
            $this->fpdf->SetX(10);
            
            $this->fpdf->Ln(2); // Spasi tambahan di antara blok-blok teks

            // Simpan data surat ke dalam database
            $surat = new Surat();
            $surat->no_surat = $no_surat;
            $surat->tahun_surat = $tahun_surat;
            $surat->namavip = $peg;
            $surat->nipvip = $nip;
            $surat->jbtvip = $jbtvip;
            $surat->nip = $nippg;
            $surat->nama = $namapg;
            $surat->jabatan = $jbtpg;
            $surat->atas_dasar = $dasar;
            $surat->dalam_rangka = $rangka;
            $surat->tgl_kegiatan = $tanggal;
            $surat->tempat_tgs = $tempat;
            $surat->dikeluarkan = $keluar;
            $surat->pd_tgl = $pdtgl;
            $surat->anggaran = $anggaran;
            $surat->typesurat = $typesurat;
            $surat->save();

            $this->fpdf->Output();
        }
    }

    public function IndividuPdf(Request $request)
    {
        // Ambil data yang dipilih dari Form
        $selectedProducts = $request->input('choose');
        if (is_array($selectedProducts)) {
            $count = count($selectedProducts);
        } else {
            $selectedProducts = [];
        }

        $datapg = Pegawai::select('nama', 'nip', 'jabatan')
            ->whereIn('id', $selectedProducts)
            ->first();

        $nama = $request->input('pilih');
        $peg = null;
        $nip = null;
        $jbtvip = null;

        $duplicateSurat = Surat::where('no_surat', $request->no_surat)
        ->where('tahun_surat', $request->tahun_surat)
        ->first();
    if ($duplicateSurat) {
        alert()->info('Nomor Surat Sudah Ada !');
        return redirect()->back();
    }
        if (is_array($nama)) {
            foreach ($nama as $peg) {
                $data = Vip::where('nama', $peg)->first();
                if (is_object($data)) {
                    $jbtvip = $data->jabatan;
                    $nip = $data->nip;
                }

                $duplicateData = Surat::where('nama', $datapg->nama)
                    ->where('tgl_kegiatan', $request->tanggal)
                    ->first();
                if ($duplicateData) {
                    alert()->question('Data Sudah Ada !', 'Tetap Bikin Surat ?')
                        ->showCancelButton('<a href="suratindividu">Cancel</a>')
                        ->showConfirmButton('<a href="suratduplikatindividu">Tetap Buat</a>')
                        ->focusConfirm(true);
                    return redirect()->back();
                }
            }

            $no_surat = $request->input('no_surat');
            $tahun_surat = $request->input('tahun_surat');
            $dasar = $request->input('dasar');
            $rangka = $request->input('rangka');
            $tanggal = $request->input('tanggal');
            $tempat = $request->input('tempat');
            $keluar = $request->input('keluar');
            $pdtgl = $request->input('pdtgl');
            $anggaran = $request->input('anggaran');
            $typesurat = ('individu');

            $this->fpdf->SetFont('Arial', 'B', 12);
            $this->fpdf->AddPage();
            $this->fpdf->Image(public_path('assets/img/logo.jpg'), 10, 6, 34, 22);

            $this->fpdf->SetFont('Arial', 'B', 18);
            $this->fpdf->SetY(13);
            $this->fpdf->MultiCell(210, 1, 'DINAS KESEHATAN KOTA SEMARANG', 0, 'C');
            $this->fpdf->Ln(3);

            $this->fpdf->SetFont('Arial', 'B', 9);
            $this->fpdf->Ln(3);
            $this->fpdf->MultiCell(210, 1, 'Jl. Pandanaran No.79, Mugassari, Kec. Semarang Selatan, Kota Semarang, Jawa Tengah 50249', 0, 'C');

            $this->fpdf->Ln(3);
            $this->fpdf->MultiCell(210, 1, 'website : https://dinkes.semarangkota.go.id/ email : dinkes@semarangkota.go.id.', 0, 'C');

            $this->fpdf->Line(8, 28, 200, 28);
            $this->fpdf->SetLineWidth(0);
            $this->fpdf->Line(8, 29, 200, 29);

            $this->fpdf->SetFont('Arial', 'B', 15);
            $this->fpdf->SetY(39);
            $this->fpdf->MultiCell(0, 3, 'SURAT PERINTAH TUGAS', 0, 'C');
            $this->fpdf->Line(70, 43, 140, 43);
            $this->fpdf->Ln(3);
            $this->fpdf->SetFont('Arial', '', 13);
            $this->fpdf->MultiCell(0, 3, "NOMOR : 800 / $no_surat / $tahun_surat", 0, 'C');

            $this->fpdf->SetFont('Arial', '', 12);
            $this->fpdf->SetY(60);
            $this->fpdf->MultiCell(0, 0.5, 'Yang bertanda tangan dibawah ini :', 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "Nama                          : $peg", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "NIP                              : $nip", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "Jabatan                       : $jbtvip", 0, 'L');
            $this->fpdf->Ln(17);

            $this->fpdf->MultiCell(0, 0.5, 'Memberikan tugas kepada :', 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "Nama                          : $datapg->nama", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "NIP                              : $datapg->nip", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "Jabatan                       : $datapg->jabatan", 0, 'L');
            $this->fpdf->Ln(17);

            $this->fpdf->SetFont('Arial', '', 12);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 0.5, "Atas Dasar                          : $dasar", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 0.5, "Dalam rangka                     : $rangka", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 1, "Tanggal                              : $tanggal", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 1, "Tempat                               : $tempat", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 1, "Anggaran                            : $anggaran", 0, 'L');
            $this->fpdf->Ln(10);
            $this->fpdf->SetX(10);

            $this->fpdf->MultiCell(0, 0.5, 'Demikian surat tugas ini dibuat untuk dapat dilaksanakan sebagaimana mestinya.', 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(150, 1, "Dikeluarkan di                     : $keluar", 0, 'R');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(16);
            $this->fpdf->MultiCell(150, 1, "Pada Tanggal                     : $pdtgl", 0, 'R');
            $this->fpdf->Ln(45);
            $this->fpdf->SetX(10);

            // Menggunakan MultiCell dengan teks berformat
            $this->fpdf->SetFont('Arial', '', 12);

            $this->fpdf->MultiCell(175, 0.5, ($jbtvip), 0, 'R', false);
            $this->fpdf->Ln(17); // Menambah spasi 5 unit setelah MultiCell pertama
            $this->fpdf->SetX(10);

            $this->fpdf->MultiCell(175, 0.5, ($peg), 0, 'R', false);
            $this->fpdf->Ln(5); // Menambah spasi 5 unit setelah MultiCell kedua
            $this->fpdf->SetX(10);

            $this->fpdf->MultiCell(175, 0.5, "($nip)", 0, 'R', false);
            $this->fpdf->Ln(0); // Menambah spasi 5 unit setelah MultiCell ketiga
            $this->fpdf->SetX(10);
            
            $this->fpdf->Ln(2); // Spasi tambahan di antara blok-blok teks
            
            // Simpan data surat ke dalam database
            $surat = new Surat();
            $surat->no_surat = $no_surat;
            $surat->tahun_surat = $tahun_surat;
            $surat->namavip = $peg;
            $surat->nipvip = $nip;
            $surat->jbtvip = $jbtvip;
            $surat->nip = $datapg->nip;
            $surat->nama = $datapg->nama;
            $surat->jabatan = $datapg->jabatan;
            $surat->atas_dasar = $dasar;
            $surat->dalam_rangka = $rangka;
            $surat->tgl_kegiatan = $tanggal;
            $surat->tempat_tgs = $tempat;
            $surat->dikeluarkan = $keluar;
            $surat->pd_tgl = $pdtgl;
            $surat->anggaran = $anggaran;
            $surat->typesurat = $typesurat;
            $surat->save();

            $this->fpdf->Output();
        }
    }

    public function DuplicatePdfIndividu(Request $request)
    {
        // Ambil data yang dipilih dari Form
        $selectedProducts = $request->input('choose');
        if (is_array($selectedProducts)) {
            $count = count($selectedProducts);
        } else {
            $selectedProducts = [];
        }

        // Menggunakan Eloquent untuk mengambil data
        $datapg = Pegawai::select('nama', 'nip', 'jabatan')
            ->whereIn('id', $selectedProducts)
            ->first();

        $nama = $request->input('pilih');
        $peg = null;
        $nip = null;
        $jbtvip = null;

        $duplicateSurat = Surat::where('no_surat', $request->no_surat)
        ->where('tahun_surat', $request->tahun_surat)
        ->first();
    if ($duplicateSurat) {
        alert()->info('Nomor Surat Sudah Ada !');
        return redirect()->back();
    }

        if (is_array($nama)) {
            foreach ($nama as $peg) {
                $data = Vip::where('nama', $peg)->first();
                if (is_object($data)) {
                    $jbtvip = $data->jabatan;
                    $nip = $data->nip;
                }
            }

            $no_surat = $request->input('no_surat');
            $tahun_surat = $request->input('tahun_surat');
            $dasar = $request->input('dasar');
            $rangka = $request->input('rangka');
            $tanggal = $request->input('tanggal');
            $tempat = $request->input('tempat');
            $keluar = $request->input('keluar');
            $pdtgl = $request->input('pdtgl');
            $anggaran = $request->input('anggaran');
            $typesurat = ('individu');

            $this->fpdf->SetFont('Arial', 'B', 12);
            $this->fpdf->AddPage();
            $this->fpdf->Image(public_path('assets/img/logo.jpg'), 10, 6, 34, 22);

            $this->fpdf->SetFont('Arial', 'B', 18);
            $this->fpdf->SetY(13);
            $this->fpdf->MultiCell(210, 1, 'DINAS KESEHATAN KOTA SEMARANG', 0, 'C');
            $this->fpdf->Ln(3);

            $this->fpdf->SetFont('Arial', 'B', 9);
            $this->fpdf->Ln(3);
            $this->fpdf->MultiCell(210, 1, 'Jl. Pandanaran No.79, Mugassari, Kec. Semarang Selatan, Kota Semarang, Jawa Tengah 50249', 0, 'C');

            $this->fpdf->Ln(3);
            $this->fpdf->MultiCell(210, 1, 'website : https://dinkes.semarangkota.go.id/ email : dinkes@semarangkota.go.id.', 0, 'C');

            $this->fpdf->Line(8, 28, 200, 28);
            $this->fpdf->SetLineWidth(0);
            $this->fpdf->Line(8, 29, 200, 29);

            $this->fpdf->SetFont('Arial', 'B', 15);
            $this->fpdf->SetY(39);
            $this->fpdf->MultiCell(0, 3, 'SURAT PERINTAH TUGAS', 0, 'C');
            $this->fpdf->Line(70, 43, 140, 43);
            $this->fpdf->Ln(3);
            $this->fpdf->SetFont('Arial', '', 13);
            $this->fpdf->MultiCell(0, 3, "NOMOR : 800 / $no_surat / $tahun_surat", 0, 'C');

            $this->fpdf->SetFont('Arial', '', 12);
            $this->fpdf->SetY(60);
            $this->fpdf->MultiCell(0, 0.5, 'Yang bertanda tangan dibawah ini :', 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "Nama                          : $peg", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "NIP                              : $nip", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "Jabatan                       : $jbtvip", 0, 'L');
            $this->fpdf->Ln(17);

            $this->fpdf->MultiCell(0, 0.5, 'Memberikan tugas kepada :', 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "Nama                          : $datapg->nama", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "NIP                              : $datapg->nip", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "Jabatan                       : $datapg->jabatan", 0, 'L');
            $this->fpdf->Ln(17);

            $this->fpdf->SetFont('Arial', '', 12);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 0.5, "Atas Dasar                          : $dasar", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 0.5, "Dalam rangka                     : $rangka", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 1, "Tanggal                              : $tanggal", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 1, "Tempat                               : $tempat", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 1, "Anggaran                            : $anggaran", 0, 'L');
            $this->fpdf->Ln(10);
            $this->fpdf->SetX(10);

           
            $this->fpdf->MultiCell(0, 0.5, 'Demikian surat tugas ini dibuat untuk dapat dilaksanakan sebagaimana mestinya.', 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(150, 1, "Dikeluarkan di                     : $keluar", 0, 'R');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(16);
            $this->fpdf->MultiCell(150, 1, "Pada Tanggal                     : $pdtgl", 0, 'R');
            $this->fpdf->Ln(45);
            $this->fpdf->SetX(10);

            // Menggunakan MultiCell dengan teks berformat
            $this->fpdf->SetFont('Arial', '', 12);

            $this->fpdf->MultiCell(175, 0.5, ($jbtvip), 0, 'R', false);
            $this->fpdf->Ln(17); // Menambah spasi 5 unit setelah MultiCell pertama
            $this->fpdf->SetX(10);

            $this->fpdf->MultiCell(175, 0.5, ($peg), 0, 'R', false);
            $this->fpdf->Ln(5); // Menambah spasi 5 unit setelah MultiCell kedua
            $this->fpdf->SetX(10);

            $this->fpdf->MultiCell(175, 0.5, "($nip)", 0, 'R', false);
            $this->fpdf->Ln(0); // Menambah spasi 5 unit setelah MultiCell ketiga
            $this->fpdf->SetX(10);
            
            $this->fpdf->Ln(2); // Spasi tambahan di antara blok-blok teks


            // Simpan data surat ke dalam database
            $surat = new Surat();
            $surat->no_surat = $no_surat;
            $surat->tahun_surat = $tahun_surat;
            $surat->namavip = $peg;
            $surat->nipvip = $nip;
            $surat->jbtvip = $jbtvip;
            $surat->nip = $datapg->nip;
            $surat->nama = $datapg->nama;
            $surat->jabatan = $datapg->jabatan;
            $surat->atas_dasar = $dasar;
            $surat->dalam_rangka = $rangka;
            $surat->tgl_kegiatan = $tanggal;
            $surat->tempat_tgs = $tempat;
            $surat->dikeluarkan = $keluar;
            $surat->pd_tgl = $pdtgl;
            $surat->anggaran = $anggaran;
            $surat->typesurat = $typesurat;
            $surat->save();

            $this->fpdf->Output();
        }
    }


    public function DuplicatePdfKolektif(Request $request)
    {
        // Ambil data yang dipilih dari Form
        $selectedProducts = $request->input('choose');
        if (is_array($selectedProducts)) {
            $count = count($selectedProducts);
        } else {
            $selectedProducts = [];
        }

        // Menggunakan Eloquent untuk mengambil data
        $datapg = Pegawai::select('nama', 'nip', 'jabatan')
            ->whereIn('id', $selectedProducts)
            ->get();

        $datapgid = Pegawai::select('nama', 'nip', 'jabatan')
            ->whereIn('id', $selectedProducts)
            ->first();

        // Ambil data dari formulir
        $nama = $request->input('pilih');
        $peg = null;
        $nip = null;
        $jbtvip = null;
        $duplicateSurat = Surat::where('no_surat', $request->no_surat)
        ->where('tahun_surat', $request->tahun_surat)
        ->first();
    if ($duplicateSurat) {
        alert()->info('Nomor Surat Sudah Ada !');
        return redirect()->back();
    }

        if (is_array($nama)) {
            foreach ($nama as $peg) {
                $data = Vip::where('nama', $peg)->first();
                if (is_object($data)) {
                    $jbtvip = $data->jabatan;
                    $nip = $data->nip;
                }
            }

            $no_surat = $request->input('no_surat');
            $tahun_surat = $request->input('tahun_surat');
            $dasar = $request->input('dasar');
            $rangka = $request->input('rangka');
            $tanggal = $request->input('tanggal');
            $tempat = $request->input('tempat');
            $keluar = $request->input('keluar');
            $pdtgl = $request->input('pdtgl');
            $anggaran = $request->input('anggaran');
            $typesurat = ('kolektif');


            $this->fpdf->SetFont('Arial', 'B', 12);
            $this->fpdf->AddPage();
            $this->fpdf->Image(public_path('assets/img/Logo.jpg'), 10, 6, 34, 22);

            $this->fpdf->SetFont('Arial', 'B', 18);
            $this->fpdf->SetY(13);
            $this->fpdf->MultiCell(210, 1, 'DINAS KESEHATAN KOTA SEMARANG', 0, 'C');
            $this->fpdf->Ln(3);

            $this->fpdf->SetFont('Arial', 'B', 9);
            $this->fpdf->Ln(3);
            $this->fpdf->MultiCell(210, 1, 'Jl. Pandanaran No.79, Mugassari, Kec. Semarang Selatan, Kota Semarang, Jawa Tengah 50249', 0, 'C');

            $this->fpdf->Ln(3);
            $this->fpdf->MultiCell(210, 1, 'website : https://dinkes.semarangkota.go.id/ email : dinkes@semarangkota.go.id.', 0, 'C');

            $this->fpdf->Line(8, 28, 200, 28);
            $this->fpdf->SetLineWidth(0);
            $this->fpdf->Line(8, 29, 200, 29);

            $this->fpdf->SetFont('Arial', 'B', 15);
            $this->fpdf->SetY(39);
            $this->fpdf->MultiCell(0, 3, 'SURAT PERINTAH TUGAS', 0, 'C');
            $this->fpdf->Line(70, 43, 140, 43);
            $this->fpdf->Ln(3);
            $this->fpdf->SetFont('Arial', '', 13);
            $this->fpdf->MultiCell(0, 3, "NOMOR : 800 / $no_surat / $tahun_surat", 0, 'C');

            $this->fpdf->SetFont('Arial', '', 12);
            $this->fpdf->SetY(60);
            $this->fpdf->MultiCell(0, 0.5, 'Yang bertanda tangan dibawah ini :', 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "Nama                          : $peg", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "NIP                              : $nip", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "Jabatan                       : $jbtvip", 0, 'L');
            $this->fpdf->Ln(17);

            $this->fpdf->MultiCell(0, 0.5, 'Menugaskan kepada   :', 0, 'L');
            $this->fpdf->Ln();

            // Menghitung lebar halaman
            $pageWidth = $this->fpdf->GetPageWidth();

            // Menghitung lebar tabel (jumlah kolom x lebar masing-masing kolom)
            $columnNames = ['nama', 'nip', 'jabatan'];
            $columnWidth = 65; // Ganti dengan lebar masing-masing kolom Anda (dalam satuan yang Anda gunakan)
            $tableWidth = count($columnNames) * $columnWidth;

            // Menghitung margin kiri (kiri)
            $leftMargin = ($pageWidth - $tableWidth) / 2;

            // Menghitung margin atas (atas)
            $tableHeight = 10; // Ganti dengan tinggi tabel Anda (jumlah baris x tinggi baris)
            $pageHeight = $this->fpdf->GetPageHeight();
            $topMargin = ($pageHeight - $tableHeight) / 2;

            // Set batas margin
            $this->fpdf->SetMargins($leftMargin, $topMargin, $leftMargin, $topMargin);

            // Set posisi horizontal awal tabel
            $this->fpdf->SetX($leftMargin);

            $this->fpdf->SetY(108);
            $this->fpdf->Cell(0, 0, '', 0, 1);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Cell(65, 10, 'NAMA PEGAWAI', 1, 0, 'C');
            $this->fpdf->Cell(65, 10, 'NIP', 1, 0, 'C');
            $this->fpdf->Cell(65, 10, 'JABATAN', 1, 0, 'C');
            $this->fpdf->Cell(6, 1, '', 0, 1);
            $this->fpdf->Ln(8);

            $this->fpdf->SetFont('Arial', '', 10);
            // Tampilkan data produk dalam PDF
            foreach ($datapg as $row) {
                $this->fpdf->Ln();
                $this->fpdf->Cell($columnWidth, 10, $row->nama, 1);
                $this->fpdf->Cell($columnWidth, 10, $row->nip, 1, 0, 'C');
                $this->fpdf->Cell($columnWidth, 10, $row->jabatan, 1, 0, 'C');
            }

            $this->fpdf->SetFont('Arial', '', 12);
            $this->fpdf->Ln(18);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 0.5, "Atas Dasar                          : $dasar", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 0.5, "Dalam rangka                     : $rangka", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 1, "Tanggal                              : $tanggal", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 1, "Tempat                               : $tempat", 0, 'L');
            $this->fpdf->Ln(17);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 1, "Anggaran                              : $anggaran", 0, 'L');
            $this->fpdf->Ln(17);
            $this->fpdf->SetX(10);

           
            $this->fpdf->MultiCell(0, 0.5, 'Demikian surat tugas ini dibuat untuk dapat dilaksanakan sebagaimana mestinya.', 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(150, 1, "Dikeluarkan di                     : $keluar", 0, 'R');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(16);
            $this->fpdf->MultiCell(150, 1, "Pada Tanggal                     : $pdtgl", 0, 'R');
            $this->fpdf->Ln(45);
            $this->fpdf->SetX(10);

            // Menggunakan MultiCell dengan teks berformat
            $this->fpdf->SetFont('Arial', '', 12);

            $this->fpdf->MultiCell(175, 0.5, ($jbtvip), 0, 'R', false);
            $this->fpdf->Ln(17); // Menambah spasi 5 unit setelah MultiCell pertama
            $this->fpdf->SetX(10);

            $this->fpdf->MultiCell(175, 0.5, ($peg), 0, 'R', false);
            $this->fpdf->Ln(5); // Menambah spasi 5 unit setelah MultiCell kedua
            $this->fpdf->SetX(10);

            $this->fpdf->MultiCell(175, 0.5, "($nip)", 0, 'R', false);
            $this->fpdf->Ln(0); // Menambah spasi 5 unit setelah MultiCell ketiga
            $this->fpdf->SetX(10);
            
            $this->fpdf->Ln(2); // Spasi tambahan di antara blok-blok teks


            // Simpan data surat ke dalam database
            $surat = new Surat();
            $surat->no_surat = $no_surat;
            $surat->tahun_surat = $tahun_surat;
            $surat->namavip = $peg;
            $surat->nipvip = $nip;
            $surat->jbtvip = $jbtvip;
            $surat->nip = $datapgid->nip;
            $surat->nama = $datapgid->nama;
            $surat->jabatan = $datapgid->jabatan;
            $surat->atas_dasar = $dasar;
            $surat->dalam_rangka = $rangka;
            $surat->tgl_kegiatan = $tanggal;
            $surat->tempat_tgs = $tempat;
            $surat->dikeluarkan = $keluar;
            $surat->pd_tgl = $pdtgl;
            $surat->anggaran = $anggaran;
            $surat->typesurat = $typesurat;
            $surat->save();

            $this->fpdf->Output();
        }
    }

    public function download(Request $request)
    {
        $surat = Surat::where('id', $request->id)->first();
        $no_surat = $surat->no_surat;
        $tahun_surat = $surat->tahun_surat;
        $namavip = $surat->namavip;
        $nipvip = $surat->nipvip;
        $jbtvip = $surat->jbtvip;
        $nama = $surat->nama;
        $nip = $surat->nip;
        $jabatan = $surat->jabatan;
        $dasar = $surat->atas_dasar;
        $rangka = $surat->dalam_rangka;
        $tgl_kegiatan = $surat->tgl_kegiatan;
        $tempat = $surat->tempat_tgs;
        $keluar = $surat->dikeluarkan;
        $pd_tgl = $surat->pd_tgl;
        $anggaran = $surat->anggaran;
        $typesurat = $surat->typesurat;

        if ($typesurat == 'individu') {
            $this->fpdf->SetFont('Arial', 'B', 12);
            $this->fpdf->AddPage();
            $this->fpdf->Image(public_path('assets/img/logo.jpg'), 10, 6, 34, 22);

            $this->fpdf->SetFont('Arial', 'B', 18);
            $this->fpdf->SetY(13);
            $this->fpdf->MultiCell(210, 1, 'DINAS KESEHATAN KOTA SEMARANG', 0, 'C');
            $this->fpdf->Ln(3);

            $this->fpdf->SetFont('Arial', 'B', 9);
            $this->fpdf->Ln(3);
            $this->fpdf->MultiCell(210, 1, 'Jl. Pandanaran No.79, Mugassari, Kec. Semarang Selatan, Kota Semarang, Jawa Tengah 50249', 0, 'C');

            $this->fpdf->Ln(3);
            $this->fpdf->MultiCell(210, 1, 'website : https://dinkes.semarangkota.go.id/ email : dinkes@semarangkota.go.id.', 0, 'C');

            $this->fpdf->Line(8, 28, 200, 28);
            $this->fpdf->SetLineWidth(0);
            $this->fpdf->Line(8, 29, 200, 29);

            $this->fpdf->SetFont('Arial', 'B', 15);
            $this->fpdf->SetY(39);
            $this->fpdf->MultiCell(0, 3, 'SURAT PERINTAH TUGAS', 0, 'C');
            $this->fpdf->Line(70, 43, 140, 43);
            $this->fpdf->Ln(3);
            $this->fpdf->SetFont('Arial', '', 13);
            $this->fpdf->MultiCell(0, 3, "NOMOR : 800 / $no_surat / $tahun_surat", 0, 'C');

            $this->fpdf->SetFont('Arial', '', 12);
            $this->fpdf->SetY(60);
            $this->fpdf->MultiCell(0, 0.5, 'Yang bertanda tangan dibawah ini :', 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "Nama                          : $namavip", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "NIP                              : $nipvip", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "Jabatan                       : $jbtvip", 0, 'L');
            $this->fpdf->Ln(17);

            $this->fpdf->MultiCell(0, 0.5, 'Memberikan tugas kepada :', 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "Nama                          : $nama", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "NIP                              : $nip", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "Jabatan                       : $jabatan", 0, 'L');
            $this->fpdf->Ln(17);

            $this->fpdf->SetFont('Arial', '', 12);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 0.5, "Atas Dasar                          : $dasar", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 0.5, "Dalam rangka                     : $rangka", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 1, "Tanggal                              : $tgl_kegiatan", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 1, "Tempat                               : $tempat", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 1, "Anggaran                            : $anggaran", 0, 'L');
            $this->fpdf->Ln(10);
            $this->fpdf->SetX(10);

            
            $this->fpdf->MultiCell(0, 0.5, 'Demikian surat tugas ini dibuat untuk dapat dilaksanakan sebagaimana mestinya.', 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(150, 1, "Dikeluarkan di                     : $keluar", 0, 'R');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(16);
            $this->fpdf->MultiCell(150, 1, "Pada Tanggal                     : $pd_tgl", 0, 'R');
            $this->fpdf->Ln(45);
            $this->fpdf->SetX(10);

            // Menggunakan MultiCell dengan teks berformat
            $this->fpdf->SetFont('Arial', '', 12);

            $this->fpdf->MultiCell(175, 0.5, ($jbtvip), 0, 'R', false);
            $this->fpdf->Ln(17); // Menambah spasi 5 unit setelah MultiCell pertama
            $this->fpdf->SetX(10);

            $this->fpdf->MultiCell(175, 0.5, ($namavip), 0, 'R', false);
            $this->fpdf->Ln(5); // Menambah spasi 5 unit setelah MultiCell kedua
            $this->fpdf->SetX(10);

            $this->fpdf->MultiCell(175, 0.5, "($nipvip)", 0, 'R', false);
            $this->fpdf->Ln(0); // Menambah spasi 5 unit setelah MultiCell ketiga
            $this->fpdf->SetX(10);
            
            $this->fpdf->Ln(2); // Spasi tambahan di antara blok-blok teks

            $this->fpdf->Output();

            return response($this->fpdf->Output('download.pdf', 'I'))
                ->header('Content-Type', 'application/pdf');
        } 
        elseif ($typesurat == 'kolektif') {
            $this->fpdf->SetFont('Arial', 'B', 12);
            $this->fpdf->AddPage();
            $this->fpdf->Image(public_path('assets/img/Logo.jpg'), 10, 6, 34, 22);

            $this->fpdf->SetFont('Arial', 'B', 18);
            $this->fpdf->SetY(13);
            $this->fpdf->MultiCell(210, 1, 'DINAS KESEHATAN KOTA SEMARANG', 0, 'C');
            $this->fpdf->Ln(3);

            $this->fpdf->SetFont('Arial', 'B', 9);
            $this->fpdf->Ln(3);
            $this->fpdf->MultiCell(210, 1, 'Jl. Pandanaran No.79, Mugassari, Kec. Semarang Selatan, Kota Semarang, Jawa Tengah 50249', 0, 'C');

            $this->fpdf->Ln(3);
            $this->fpdf->MultiCell(210, 1, 'website : https://dinkes.semarangkota.go.id/ email : dinkes@semarangkota.go.id.', 0, 'C');

            $this->fpdf->Line(8, 28, 200, 28);
            $this->fpdf->SetLineWidth(0);
            $this->fpdf->Line(8, 29, 200, 29);

            $this->fpdf->SetFont('Arial', 'B', 15);
            $this->fpdf->SetY(39);
            $this->fpdf->MultiCell(0, 3, 'SURAT PERINTAH TUGAS', 0, 'C');
            $this->fpdf->Line(70, 43, 140, 43);
            $this->fpdf->Ln(3);
            $this->fpdf->SetFont('Arial', '', 13);
            $this->fpdf->MultiCell(0, 3, "NOMOR : 800 / $no_surat / $tahun_surat", 0, 'C');

            $this->fpdf->SetFont('Arial', '', 12);
            $this->fpdf->SetY(60);
            $this->fpdf->MultiCell(0, 0.5, 'Yang bertanda tangan dibawah ini :', 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "Nama                          : $namavip", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "NIP                              : $nipvip", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->MultiCell(0, 1, "Jabatan                       : $jbtvip", 0, 'L');
            $this->fpdf->Ln(17);

            $this->fpdf->MultiCell(0, 0.5, 'Menugaskan kepada   :', 0, 'L');
            $this->fpdf->Ln();

            // Menghitung lebar halaman
            $pageWidth = $this->fpdf->GetPageWidth();

            // Menghitung lebar tabel (jumlah kolom x lebar masing-masing kolom)
            $columnNames = ['nama', 'nip', 'jabatan'];
            $columnWidth = 65; // Ganti dengan lebar masing-masing kolom Anda (dalam satuan yang Anda gunakan)
            $tableWidth = count($columnNames) * $columnWidth;

            // Menghitung margin kiri (kiri)
            $leftMargin = ($pageWidth - $tableWidth) / 2;

            // Menghitung margin atas (atas)
            $tableHeight = 10; // Ganti dengan tinggi tabel Anda (jumlah baris x tinggi baris)
            $pageHeight = $this->fpdf->GetPageHeight();
            $topMargin = ($pageHeight - $tableHeight) / 2;

            // Set batas margin
            $this->fpdf->SetMargins($leftMargin, $topMargin, $leftMargin, $topMargin);

            // Set posisi horizontal awal tabel
            $this->fpdf->SetX($leftMargin);

            $this->fpdf->SetY(108);
            $this->fpdf->Cell(0, 0, '', 0, 1);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Cell(65, 10, 'NAMA PEGAWAI', 1, 0, 'C');
            $this->fpdf->Cell(65, 10, 'NIP', 1, 0, 'C');
            $this->fpdf->Cell(65, 10, 'JABATAN', 1, 0, 'C');
            $this->fpdf->Cell(6, 1, '', 0, 1);
            $this->fpdf->Ln(8);

            $this->fpdf->SetFont('Arial', '', 10);
            // Tampilkan data produk dalam PDF

            $this->fpdf->Ln();
            $this->fpdf->Cell($columnWidth, 10, $nama, 1);
            $this->fpdf->Cell($columnWidth, 10, $nip, 1, 0, 'C');
            $this->fpdf->Cell($columnWidth, 10, $jabatan, 1, 0, 'C');


            $this->fpdf->SetFont('Arial', '', 12);
            $this->fpdf->Ln(18);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 0.5, "Atas Dasar                          : $dasar", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 0.5, "Dalam rangka                     : $rangka", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 1, "Tanggal                              : $tgl_kegiatan", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 1, "Tempat                               : $tempat", 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(0, 1, "Anggaran                              : $anggaran", 0, 'L');
            $this->fpdf->Ln(10);
            $this->fpdf->SetX(10);

            $this->fpdf->MultiCell(0, 0.5, 'Demikian surat tugas ini dibuat untuk dapat dilaksanakan sebagaimana mestinya.', 0, 'L');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(10);
            $this->fpdf->MultiCell(150, 1, "Dikeluarkan di                     : $keluar", 0, 'R');
            $this->fpdf->Ln(7);
            $this->fpdf->SetX(16);
            $this->fpdf->MultiCell(150, 1, "Pada Tanggal                     : $pd_tgl", 0, 'R');
            $this->fpdf->Ln(47);
            $this->fpdf->SetX(10);

            // Menggunakan MultiCell dengan teks berformat
            $this->fpdf->SetFont('Arial', '', 12);
            
            $this->fpdf->MultiCell(175, 0.5, ($jbtvip), 0, 'R', false);
            $this->fpdf->Ln(17); // Menambah spasi 5 unit setelah MultiCell pertama
            $this->fpdf->SetX(10);

            $this->fpdf->MultiCell(175, 0.5, ($namavip), 0, 'R', false);
            $this->fpdf->Ln(5); // Menambah spasi 5 unit setelah MultiCell kedua
            $this->fpdf->SetX(10);

            $this->fpdf->MultiCell(175, 0.5, "($nipvip)", 0, 'R', false);
            $this->fpdf->Ln(0); // Menambah spasi 5 unit setelah MultiCell ketiga
            $this->fpdf->SetX(10);
            
            $this->fpdf->Ln(2); // Spasi tambahan di antara blok-blok teks

            $this->fpdf->Output();
            return response($this->fpdf->Output('download.pdf', 'I'))
                ->header('Content-Type', 'application/pdf');
        }
    }
}
