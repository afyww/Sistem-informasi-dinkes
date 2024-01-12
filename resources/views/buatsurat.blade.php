<!DOCTYPE html>
<html lang="en">

<head>
    <title>Surat Individu</title>
    @include('layout.head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    @include('layout.left-side')
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-full rounded-xl transition-all duration-200">
        <!-- Navbar -->
        @include('layout.navbar')
        <!--End Navbar-->

        <div class="p-6 mx-auto text-center my-auto grid grid-cols-1">
            <div class="border-black/12.5 shadow-soft-xl z-20 min-w-0 break-words rounded-3xl border-solid bg-white bg-clip-border">
                <div class="border-black/12.5 rounded-3xl border-solid bg-white p-6 space-y-20">
                    <h1 class="mt-5 text-2xl font-bold">Pilih Type Surat</h1>
                    <div class="inline-block space-x-4 w-fit md:w-full xl:w-full">

                        <a href="{{ route('suratindividu') }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-full text-sm px-5 py-3">Surat
                            Individu</a>

                        <a href="{{ route('suratkolektif') }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-full text-sm px-5 py-3">Surat
                            Kolektif</a>

                    </div>

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
