<!DOCTYPE html>
<html lang="en">
<title>Profil</title>
@include('layout.head')
</head>

<body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
    @include('layout.left-side')
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-3xl transition-all duration-200">
        <!-- Navbar -->
        @include('layout.navbar')
        <div class="w-full h-full px-6 mx-auto">
            <div class="relative flex items-center p-0 mt-1 overflow-hidden bg-center bg-cover min-h-75 rounded-3xl">
                <span
                    class="absolute inset-y-0 w-full bg-center bg-cover bg-gradient-to-tl from-red-200 to-red-700"></span>
            </div>
            <div
                class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 -mt-16 overflow-hidden break-words border-0 shadow-blur rounded-3xl bg-white/80 bg-clip-border backdrop-blur-3xl backdrop-saturate-100">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-none w-auto max-w-full px-3">
                        <div
                            class="text-base ease-soft-in-out h-18.5 w-18.5 relative inline-flex items-center justify-center rounded-3xl text-white transition-all duration-200">
                            <img src="{{ asset('assets/img/logo.jpg') }}" alt="profile_image"
                                class="w-full shadow-soft-sm rounded-xl" />
                        </div>
                    </div>
                    <div class="flex-none w-auto max-w-full px-3 my-auto">
                        <div class="h-full">
                            <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full max-w-full px-3 p-6 mx-auto">
            <div
                class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-3xl bg-clip-border">
                <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-3xl">
                    <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                        <h6 class="mb-0">Profile Information</h6>
                    </div>
                </div>
                <div class="flex-auto p-4">
                    <hr class="h-px bg-transparent bg-gradient-to-r from-transparent via-white to-transparent" />
                    <ul class="flex flex-col pl-0 mb-0 rounded-3xl">
                        <li
                            class="relative block px-4 py-2 pt-0 pl-0 leading-normal bg-white border-0 rounded-3xl text-sm text-inherit">
                            <strong class="text-slate-700">Name:</strong> &nbsp; {{ auth()->user()->name }}</li>
                        <li
                            class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                            <strong class="text-slate-700">Email:</strong> &nbsp; {{ auth()->user()->email }}</li>
                        <li
                            class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                            <strong class="text-slate-700">Level:</strong> &nbsp; {{ auth()->user()->level }}</li>
                        <li
                            class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                            <strong class="text-slate-700">Location:</strong> &nbsp; Kota Semarang,Jawa Tengah,Indonesia
                        </li>
                        <li
                            class="relative block px-4 py-2 pb-0 pl-0 bg-white border-0 border-t-0 rounded-3xl text-inherit">
                            <strong class="leading-normal text-sm text-slate-700">Social:</strong> &nbsp;
                            <a class="inline-block py-0 pl-1 pr-2 mb-0 font-bold text-center text-blue-800 align-middle transition-all bg-transparent border-0 rounded-3xl shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-none"
                                href="https://www.facebook.com/dinkeskotasemarang/">
                                <i class="fab fa-facebook fa-lg"></i>
                            </a>
                            <a class="inline-block py-0 pl-1 pr-2 mb-0 font-bold text-center align-middle transition-all bg-transparent border-0 rounded-3xl shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-none text-sky-600"
                                href="https://twitter.com/dkksemarang">
                                <i class="fab fa-twitter fa-lg"></i>
                            </a>
                            <a class="inline-block py-0 pl-1 pr-2 mb-0 font-bold text-center align-middle transition-all bg-transparent border-0 rounded-3xl shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-none text-sky-900"
                                href="https://www.instagram.com/dkksemarang/">
                                <i class="fab fa-instagram fa-lg"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 p-6 mx-auto">
            <div
                class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-3xl bg-clip-border">
                <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-3xl">
                    <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                        <h6 class="mb-0">Kami segenap jajaran Dinas Kesehatan Kota Semarang, menyatakan :</h6>
                    </div>
                </div>
                <div class="flex-auto p-4">
                    <hr class="h-px bg-transparent bg-gradient-to-r from-transparent via-white to-transparent" />
                    <ul class="flex flex-col pl-0 mb-0 rounded-3xl">
                        <li
                            class="relative block px-4 py-2 pt-0 pl-0 leading-normal bg-white border-0 rounded-3xl text-sm text-inherit">
                            <strong class="text-slate-700">1. Siap bekerja dengan sungguh-sungguh untuk melayani masyarakat dengan hati yang tulus</strong></li>
                        <li
                            class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                            <strong class="text-slate-700">2. Sanggup untuk melaksanakan pelayanan sesuai dengan standar pelayanan berdasarkan Permenpan-RB No. 15 Tahun 2014</strong></li>
                        <li
                            class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                            <strong class="text-slate-700">3. Siap memberikan pelayanan sesuai dengan kewajiban dan akan melakukan perbaikan secara terus-menerus</strong></li>
                        <li
                            class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                            <strong class="text-slate-700">4. Bersedia untuk menerima sanksi, dan/atau memberikan kompensasi apabila pelayanan yang diberikan tidak sesuai standar</strong></li>
                    
                    
                    </ul>
                </div>
            </div>
        </div>
    </main>
</body>
@include('layout.script')
</html>
