<!DOCTYPE html>
<html lang="en">

<head>
    <title>Surat Individu</title>
    @include('layout.head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    @include('layout.left-side')
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
        <!-- Navbar -->
        @include('layout.navbar')
        <!--End Navbar-->

        <div class="p-6 mx-auto grid grid-cols-1">
            <div
                class="border-black/12.5 shadow-soft-xl z-20 min-w-0 break-words rounded-3xl border-solid bg-white bg-clip-border">
                <div class="border-black/12.5 rounded-3xl border-solid bg-white p-6 space-y-20">
                    <div class="">
                        <h1 class="text-2xl font-bold text-center">Input Surat Individu</h1>
                    </div>
                    <form target="_blank" class="max-w-3xl mx-auto space-y-6" action="{{ route('individu-pdf') }}" method="post">
                        @csrf
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-2">
                            <div class="space-y-2">
                                <label class="block font-semibold text-black">No Surat
                                    :</label>
                                <input type="text" name="no_surat"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5"
                                    required>
                            </div>
                            <div class="space-y-2">
                                <label class="block font-semibold text-black">Tahun Surat
                                    :</label>
                                <input type="text" name="tahun_surat"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5"
                                    required>
                            </div>    
                            <div class="space-y-2">
                                <label class="block font-semibold text-black">Nama Pemberi
                                    Tugas :</label>
                                <select id="pilih" name="pilih[]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5"
                                    required>
                                    <option>
                                    </option>
                                    @foreach ($pemberi as $namavip )
                                        <option>
                                            {{ $namavip->nama }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="block font-semibold text-black">Nama yang
                                    diberikan tugas :</label>
                                <select name="choose[]" name="pilih" id="choose"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5"
                                    required>
                                    <option>
                                    </option>
                                    @foreach ($nama as $namapg )
                                        <option value={{ $namapg->id }}>
                                            {{ $namapg->nama }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="block font-semibold text-black">Atas Dasar
                                    :</label>
                                <input type="text" name="dasar"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5"
                                    required>
                            </div>
                            <div class="space-y-2">
                                <label class="block font-semibold text-black">Dalam Rangka
                                    :</label>
                                <input type="text" name="rangka"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5"
                                    required>
                            </div>
                            <div class="space-y-2">
                                <label class="block font-semibold text-black">Tanggal Kegiatan
                                    :</label>
                                <input type="date" name="tanggal"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5"
                                    required>
                            </div>
                            <div class="space-y-2">
                                <label class="block font-semibold text-black">Tempat Tugas
                                    :</label>
                                <input type="text" name="tempat"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5"
                                    required>
                            </div>
                            <div class="space-y-2">
                                <label class="block font-semibold text-black">Dikeluarkan di
                                    :</label>
                                <input type="text" name="keluar"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5"
                                    required>
                            </div>
                            <div class="space-y-2">
                                <label class="block font-semibold text-black">Pada Tanggal
                                    :</label>
                                <input type="date" name="pdtgl"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5"
                                    required>
                            </div>
                            <div class="space-y-2">
                                <label class="block font-semibold text-black">Anggaran
                                    :</label>
                                <select id="anggaran" name="anggaran"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5"
                                    required>
                                    <option>
                                    <option value="APBN">APBN</option>
                                    <option value="APBD1">APBD1</option>
                                    <option value="APBD2">APBD2</option>
                                    <option value="Globalfund">Globalfund</option>
                                    <option value="BOK">BOK</option>
                                    <option value="USSAID">USAAID</option>
                                    <option value="Lain-lain">Lain-lain</option>
                                    <option value="-">-</option>
                                    </option>
                                </select>
                            </div>
                            <div class="mt-6">
                                <button type="submit" name="submit"
                                    class="text-white bg-blue-600 font-semibold rounded-full w-full p-3 text-center">CETAK</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    @include('sweetalert::alert')
</body>
@include('layout.script')

</html>
