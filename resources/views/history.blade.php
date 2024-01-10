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
                <form method="get" action="/filter">
                    <div class="grid grid-cols-1 space-y-5 p-2 xl:space-y-0 md:space-y-0">
                        <div class="flex xl:mx-5 gap-2 ">
                            <div>
                                <label for="date" class=" text-stone-600">Dari
                                    Bulan
                                </label>
                                <input type="date" name="pd_tgl" required
                                    class="rounded-sm py-1 xl:px-4 border border-gray-100 bg-gray-100 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                <label for="date" class=" text-stone-600">Sampai
                                    Bulan
                                </label>
                                <input type="date" name="end_date" required
                                    class="rounded-sm py-1 xl:px-4 border border-gray-100 bg-gray-100 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                <button
                                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br rounded-3xl text-sm px-8 py-2"
                                    type="submit">Filter
                                </button>
                            </div>
                            <a href="{{ route('export') }}"
                                class="text-white bg-gradient-to-r from-green-500 via-green-600 to-green-700 hover:bg-gradient-to-br rounded-3xl text-sm px-8 py-2"
                                type="submit">Export
                            </a>
                            <div class="relative">
                                <button dropdown-trigger aria-expanded="false" type="button" class="inline-block px-6 py-2 mr-3 text-center rounded-3xl text-sm text-white align-middle transition-all cursor-pointer bg-black leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 active:opacity-85">Type Surat</button>
                                <p class="hidden transform-dropdown-show"></p>
                                <ul dropdown-menu class="z-10 text-sm lg:shadow-soft-3xl duration-250 before:duration-350 before:font-awesome before:ease-soft min-w-44 before:text-5.5 transform-dropdown pointer-events-none absolute left-auto top-1/2 m-0 -mr-4 mt-2 list-none rounded-lg border-0 border-solid border-transparent bg-black bg-clip-padding px-0 py-2 text-left text-slate-500 opacity-0 transition-all before:absolute before:right-7 before:left-auto before:top-0 before:z-40 before:text-white before:transition-all before:content-['\f0d8']">
                                  <li>
                                    <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap border-0 bg-transparent px-4 text-left font-normal text-slate-500 hover:bg-gray-200 hover:text-slate-700 dark:text-white dark:hover:bg-gray-200/80 dark:hover:text-slate-700 lg:transition-colors lg:duration-300" href="">Semua</a>
                                  </li>
                                  <li>
                                    <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap border-0 bg-transparent px-4 text-left font-normal text-slate-500 hover:bg-gray-200 hover:text-slate-700 dark:text-white dark:hover:bg-gray-200/80 dark:hover:text-slate-700 lg:transition-colors lg:duration-300" href="">Surat Individu</a>
                                  </li>
                                  <li>
                                    <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap border-0 bg-transparent px-4 text-left font-normal text-slate-500 hover:bg-gray-200 hover:text-slate-700 dark:text-white dark:hover:bg-gray-200/80 dark:hover:text-slate-700 lg:transition-colors lg:duration-300" href="">Surat Kolektif</a>
                                  </li>
                                </ul>
                              </div>
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
                                   <form action="{{ url('download', $item['id']) }}" id="downloadButton" data-id="{{ $item['id'] }}">
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
