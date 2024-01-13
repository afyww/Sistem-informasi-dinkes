<!DOCTYPE html>
<html lang="en">

<head>
    <title>History</title>
    @include('layout.head')
</head>

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    @include('layout.left-side')
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-3xl transition-all duration-200">
        <!-- Navbar -->
        @include('layout.navbar')
        <div class="p-6 mx-auto">
            <div class="bg-white border-solid shadow-soft-xl rounded-3xl bg-clip-border">
                <div class="p-6 bg-white border-b-solid rounded-3xl">
                <h6>Riwayat Surat</h6>
                </div>
                <form method="get" action="{{ route('filter') }}">
                    <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4 p-4 md:p-6">
                        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                            <div>
                                <label for="pd_tgl" class="text-stone-600">Dari Bulan</label>
                                <input type="date" id="pd_tgl" name="pd_tgl" required class="border-2 p-1 rounded-xl bg-gray-100" />
                            </div>
                            <div>
                                <label for="end_date" class="text-stone-600">Sampai Bulan</label>
                                <input type="date" id="end_date" name="end_date" required class="border-2 p-1 rounded-xl bg-gray-100" />
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row gap-2">
                            <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br rounded-3xl text-sm px-5 py-2 text-center">Filter</button>
                            <a href="{{ route('export') }}" class="text-white bg-gradient-to-r from-green-500 via-green-600 to-green-700 hover:bg-gradient-to-br font-medium rounded-3xl text-sm px-6 py-2 text-center">Export</a>
                        </div>
                    </div>
                </form>
                
                
                <div class="flex overflow-auto">
                    <table class="text-sm text-black w-full">
                        <thead class="text-xs text-black bg-gray-50">
                            <th scope="col" class="px-2 py-4">
                                No
                            </th>
                            <th scope="col" class="px-2 py-4">
                                NIP
                            </th>
                            </th>
                            <th scope="col" class="px-2 py-4">
                                Jabatan
                            </th>
                            <th scope="col" class="px-2 py-4">
                                Nama Pegawai
                            </th>
                            <th scope="col" class="px-2 py-4">
                                Atas Dasar
                            </th>
                            <th scope="col" class="px-2 py-4">
                                Dalam Rangka
                            </th>
                            <th scope="col" class="px-2 py-4">
                                Tanggal Kegiatan
                            </th>
                            <th scope="col" class="px-2 py-4">
                                Tempat Tugas
                            </th>
                            <th scope="col" class="px-2 py-4">
                                Dikeluarkan Di
                            </th>
                            <th scope="col" class="px-2 py-4">
                                Pada Tanggal
                            </th>
                            <th scope="col" class="px-2 py-4">
                                Anggaran
                            </th>
                            <th scope="col" class="px-2 py-4">
                                Download
                            </th>
                        </thead>
                        <tbody
                            @foreach ($surat as $item)
                                <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                                    {{ $item['id'] }}
                                </th>
                                <td class="px-6 py-6">
                                    {{ $item['nip'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item['jabatan'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item['nama'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item['atas_dasar'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item['dalam_rangka'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item['tgl_kegiatan'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item['tempat_tgs'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item['dikeluarkan'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item['pd_tgl'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item['anggaran'] }}
                                </td>
                                <td class="px-6 py-4">
                                   <form target="_blank" action="{{ url('download', $item['id']) }}" id="downloadButton" data-id="{{ $item['id']  }}">
                                        <button 
                                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 
                                            hover:bg-gradient-to-br font-medium rounded-3xl text-sm px-5 py-2 text-center">Download</button>
                                    </form>
                                </td>
                                </tr>
                            </tbody> @endforeach
                            </table>
                </div>
            </div>
        </div>
    </main>
</body>
@include('layout.script')

</html>
