<!doctype html>
<html lang="en">

<head>
    <title>Tambah Kepala Divisi</title>
    @include('layout.head')
</head>

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    @include('layout.left-side')
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
        <!-- Navbar -->
        @include('layout.navbar')
        <!--End Navbar-->
        <div class="p-6 mx-auto w-full">
            <div class="border-black/12.5 shadow-soft-xl z-20 grid grid-cols-1 break-words border-solid bg-white bg-clip-border rounded-3xl">
                <div class="border-black/12.5 border-solid bg-white p-6 rounded-3xl space-y-16">
                    <div>
                    <h1 class="text-2xl font-bold text-center">Tambah Kepala Divisi</h1>
                    </div>
                    <form method="post" action="{{ route('storevip') }}">
                        @csrf
                        @method('post')
                        <div class="grid gap-6 grid-cols-1 md:grid-cols-2 xl:grid-cols-2 max-w-3xl mx-auto">
                            <div class="space-y-2">
                                <label for="exampleFormControlInput1" class="block font-semibold text-black">Nama
                                    :</label>
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    id="nama" name="nama" placeholder="nama pegawai"
                                    required>
                            </div>
                            <div class="space-y-2">
                                <label for="exampleFormControlInput1" class="block font-semibold text-black">NIP
                                    :</label>
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    id="nip" name="nip" placeholder="nip" required>
                            </div>
                            <div class="space-y-2">
                                <label for="exampleFormControlInput1"
                                    class="block font-semibold text-black">Jabatan :</label>
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    id="jabatan" name="jabatan" placeholder="jabatan"
                                    required>
                            </div>
                            <div class="space-y-2">
                                <label for="exampleFormControlInput1" class="block font-semibold text-black">NPWP
                                    :</label>
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    id="npwp" name="npwp" placeholder="NPWP" required>
                            </div>
                            <div class="space-y-2">
                                <label for="exampleFormControlInput1" class="block font-semibold text-black">Nama
                                    Bank :</label>
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    id="nama_bank" name="nama_bank" placeholder="Nama Bank"
                                    required>
                            </div>
                            <div class="space-y-2">
                                <label for="exampleFormControlInput1"
                                    class="block font-semibold text-black">No.Rekening :</label>
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    id="no_rek" name="no_rek" placeholder="No.Rekening"
                                    required>
                            </div>
                        <div class="col-span-1 md:col-span-2 xl:col-span-2">
                            <input type="submit"
                                class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br font-semibold rounded-lg  w-full p-3 text-center"
                                value="Simpan">
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
@include('layout.script')

</html>
