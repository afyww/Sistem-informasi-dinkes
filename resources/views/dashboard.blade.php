<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    @include('layout.head')
</head>

<body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
    <!-- sidenav  -->
    @include('layout.left-side')
    <!-- end sidenav -->

    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
        <!-- Navbar -->
        @include('layout.navbar')
        <!-- end Navbar -->
        <div class="p-6 mx-auto space-y-5">
            <div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-4 -mx-3">
                <!-- card1 -->
                <div class="px-3 mb-6">
                    <div class="break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="p-4">
                            <div class="-mx-3">
                                <div class="px-3">
                                    <div>
                                        <p class="mb-0 font-sans font-semibold leading-normal text-sm">Surat Tugas </p>
                                        <h5 class="mb-0 font-bold">
                                            {{ $total_surat }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                                        <i
                                            class="ni leading-none ni-email-83 text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card2 -->
                <div class="px-3 mb-6">
                    <div class="break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="p-4">
                            <div class="-mx-3">
                                <div class="px-3">
                                    <div>
                                        <p class="mb-0 font-sans font-semibold leading-normal text-sm">Pegawai</p>
                                        <h5 class="mb-0 font-bold">
                                            {{ $total_karyawan }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                                        <i
                                            class="ni leading-none ni-single-02 text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-3 mb-6">
                    <div class="break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="p-4">
                            <div class="-mx-3">
                                <div class="px-3">
                                    <div>
                                        <p class="mb-0 font-sans font-semibold leading-normal text-sm">Kepala Divisi</p>
                                        <h5 class="mb-0 font-bold">
                                            {{ $total_vip }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                                        <i
                                            class="ni leading-none ni-hat-3 text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-3 mb-6">
                    <div class="break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="p-4">
                            <div class="-mx-3">
                                <div class="px-3">
                                    <div>
                                        <p class="mb-0 font-sans font-semibold leading-normal text-sm">Anggaran Tertinggi
                                        </p>
                                        <h5 class="mb-0 font-bold">
                                            {{ $anggarantertinggi }}

                                        </h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                                        <i
                                            class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-5">
                <div class="border-black/12.5 shadow-soft-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                        <h6>Jumlah Surat Tugas</h6>
                        <p class="leading-normal text-sm">
                            <i class="fa fa-arrow-up text-lime-500"></i>
                        </p>
                    </div>
                    <div class="p-4">
                        <div>
                            <canvas id="grafikSurat" width="100" height="50"></canvas>
                        </div>
                    </div>
                </div>
                <div class="border-black/12.5 shadow-soft-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                        <h6>Jumlah Pegawai Bertugas</h6>
                        <p class="leading-normal text-sm">
                            <i class="fa fa-arrow-up text-lime-500"></i>
                        </p>
                    </div>
                    <div class="p-4">
                        <div>
                            <canvas id="grafikPegawai" width="100" height="50"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1">
                <div class="border-black/12.5 shadow-soft-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                        <h6>Jumlah Pemakaian Anggaran</h6>
                        <p class="leading-normal text-sm">
                            <i class="fa fa-arrow-up text-lime-500"></i>
                        </p>
                    </div>
                    <div class="p-4">
                        <div>
                            <canvas id="grafikAnggaran" width="100" height="20"></canvas>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="text/javascript">
    var labels1 = {{ Js::from($labels) }};
    var data1 = {{ Js::from($data) }};

    var labels2 = {{ Js::from($labels2) }};
    var data2 = {{ Js::from($data2) }};

    var labels3 = {{ Js::from($labels3) }};
    var dataSets = {{ Js::from($dataSets) }};

    // Chart 1
    var data1 = {
        labels: labels1,
        datasets: [{
            label: 'Jumlah Surat Tugas',
            data: data1,
            borderColor: 'rgb(75, 192, 192)',
            fill: true,
        }]
    };

    var config1 = {
        type: 'line',
        data: data1,
        options: {
            animations: {
                tension: {
                    duration: 1000,
                    easing: 'linear',
                    from: 1,
                    to: 0,
                    loop: true
                }
            },
            scales: {
                y: {
                    min: 0,
                    max: 10,
                }
            }
        }
    };

    var chart1 = new Chart(
        document.getElementById('grafikSurat'),
        config1
    );

    // Chart 2
    var data2 = {
        labels: labels2,
        datasets: data2
    };

    var config2 = {
        type: 'bar',
        data: data2,
        options: {
            scales: {
                y: {
                    min: 0,
                    max: 10,
                }
            }
        }
    };

    var chart2 = new Chart(
        document.getElementById('grafikPegawai'),
        config2
    );

    // Chart 3
 
    var data3 = {
        labels3: labels3,
        datasets: dataSets
    };

    var config3 = {
        type: 'bar',
        data: data3,
        options: {
            scales: {
                y: {
                    min: 0,
                    max: 10,
                }
            }
        }
    };

    var chart3 = new Chart(
        document.getElementById('grafikAnggaran'),
        config3
    );

</script>

@include('sweetalert::alert')
@include('layout.script')

</html>