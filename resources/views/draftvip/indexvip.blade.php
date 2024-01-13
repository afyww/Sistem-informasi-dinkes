<!doctype html>
<html lang="en">

<head>
    <title>Daftar Kepala Divisi</title>
    @include('layout.head')
</head>

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    @include('layout.left-side')
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-3xl transition-all duration-200">
        <!-- Navbar -->
        @include('layout.navbar')
        <div class="p-6 mx-auto">
            <div class="relative grid grid-cols-1 break-words bg-white border-solid shadow-soft-xl rounded-3xl bg-clip-border">
                <div class="p-6 bg-white border-b-solid rounded-3xl">
                    <h6>Daftar Pemberi Tugas</h6>
                </div>
                <div class="space-y-2">
                    <div class="flex px-3">
                        <a href="{{ route('draftvip.createvip') }}"
                            class="text-white bg-gradient-to-r from-green-500 via-green-600 to-green-700 hover:bg-gradient-to-br font-medium rounded-3xl text-sm px-6 py-2 text-center">Tambah</a>
                    </div>
                    <div class="flex overflow-auto">
                        <table class="text-sm text-black w-full">
                            <thead class="text-xs text-black bg-gray-50">
                                <th scope="col" class="px-2 py-4">
                                    NO
                                </th>
                                <th scope="col" class="px-2 py-4">
                                    NIP
                                </th>
                                <th scope="col" class="px-2 py-4">
                                    NAMA
                                </th>
                                <th scope="col" class="px-2 py-4">
                                    JABATAN
                                </th>

                                <th scope="col" class="px-2 py-4">
                                    NPWP
                                </th>

                                <th scope="col" class="px-2 py-4">
                                    NAMA BANK
                                </th>

                                <th scope="col" class="px-2 py-4">
                                    NO.REKENING
                                </th>
                                <th scope="col" class="px-20 py-4">
                                    ACTION
                                </th>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($daftarvip as $item)
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4">
                                            {{ $no++ }}</td>
                                        <td class="px-6 py-4">
                                            {{ $item->nip }}</td>
                                        <td class="px-6 py-4">
                                            {{ $item->nama }}</td>
                                        <td class="px-6 py-4">
                                            {{ $item->jabatan }}</td>
                                        <td class="px-6 py-4">
                                            {{ $item->npwp }}</td>
                                        <td class="px-6 py-4">
                                            {{ $item->nama_bank }}</td>
                                        <td class="px-6 py-4">
                                            {{ $item->no_rek }}</td>
                                        <td class="inline-block px-6 py-4">
                                            <form method="post">
                                                <a href="{{ route('draftvip.editvip', ['edits' => $item]) }}"
                                                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br rounded-3xl text-sm px-5 py-2">Edit</a>
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('Destroyvip', ['edits' => $item]) }}"
                                                    class="btn btn-danger text-white bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br rounded-3xl text-sm px-5 py-2"
                                                    data-confirm-delete="true">Hapus</a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </main>
    @include('sweetalert::alert')
</body>
<!-- main script file  -->
<script src="{{ asset('assets/js/soft-ui-dashboard-tailwind.js') }}" async></script>

</html>
