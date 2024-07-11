<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="author" content="Kevin Christian, Jason Miracle Gunawan">
    <meta name="keywords" content="Bank Sampah, Bank, Sampah, Management, System, Management System">
    <meta name="description"
        content="Bank Sampah Management System | Sistem terintegrasi untuk memanage bank sampah. By Kevin Christian & Jason Miracle Gunawan">
    <meta name="application-name" content="Bank Sampah Management System">
    <title>Bank Sampah Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
</head>

<body>
    <nav class="bg-green-500 border-gray-200 top-0 fixed z-50 w-full">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center lg:text-2xl text-md text-white font-semibold whitespace-nowrap">Bank Sampah Management
                    System</span>
            </a>
            @auth
                <button data-collapse-toggle="navbar-default" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul
                        class="navbar-navfont-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-transparent">
                        <li>
                            <a href="{{ route('home') }}"
                                class="block py-2 px-3 md:text-white bg-blue-700 rounded font-semibold md:bg-transparent md:p-0 nav-link md:hover:text-gray-200">Beranda</a>
                        </li>
                        <li>
                            <a href="{{ route('penyetoran') }}"
                                class="block py-2 px-3 md:text-white rounded hover:bg-gray-100 font-semibold md:hover:bg-transparent md:border-0 md:hover:text-gray-200 md:p-0 nav-link">Penyetoran</a>
                        </li>
                        <li>
                            <a href="{{ route('transaksi') }}"
                                class="block py-2 px-3 md:text-white rounded hover:bg-gray-100 font-semibold md:hover:bg-transparent md:border-0 md:hover:text-gray-200 md:p-0 nav-link">Transaksi</a>
                        </li>
                        @if (auth()->user()->is_admin == 1)
                            <li>
                                <a href="{{ route('data.nasabah') }}"
                                    class="block py-2 px-3 md:text-white rounded hover:bg-gray-100 font-semibold md:hover:bg-transparent md:border-0 md:hover:text-gray-200 md:p-0 nav-link">Nasabah</a>
                            </li>
                        @endif
                        <li>
                            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                                class="flex items-center justify-between w-full py-2 px-3 md:text-white font-semibold rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-gray-200 md:p-0 md:w-auto">
                                {{ auth()->user()->name }}
                                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdownNavbar"
                                class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                {{-- <ul class="py-2 text-sm text-gray-700 dark:text-gray-400"
                                aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profil</a>
                                </li>
                            </ul> --}}
                                @if (auth()->user()->is_admin == 1)
                                    <div class="py-1">
                                        <a href="{{ route('register.page') }}"
                                            class="block px-4 py-2 text-sm text-gray-700">Daftarkan Anggota</a>
                                    </div>
                                @endif
                                <div class="py-1">
                                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700">Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </nav>
    <main style="min-height: 90vh">
        @yield('content')
    </main>


    <footer class="bg-green-400 rounded-lg shadow mt-4 dark:bg-gray-800">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-white sm:text-center dark:text-gray-400">© 2024 <a
                    href="https://bsms.kevinchr.com/" class="hover:underline">Bank Sampah Management System™</a>. <br>
                All Rights Reserved.</span>
            <br>
            <br>
            <span class="text-sm text-white sm:text-center dark:text-gray-400">Created by <a
                    href="https://kevinchr.com/" class="hover:underline">Kevin Christian</a> and <a href="#"
                    class="hover:underline">Jason Miracle Gunawan</a>. <br> Hosted by <a href="https://kevinchr.com/"
                    class="hover:underline">kevinchr.com</a></span>
            {{--        <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0"> --}}
            {{--            <li> --}}
            {{--                <a href="#" class="hover:underline me-4 md:me-6">About</a> --}}
            {{--            </li> --}}
            {{--            <li> --}}
            {{--                <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a> --}}
            {{--            </li> --}}
            {{--            <li> --}}
            {{--                <a href="#" class="hover:underline me-4 md:me-6">Licensing</a> --}}
            {{--            </li> --}}
            {{--            <li> --}}
            {{--                <a href="#" class="hover:underline">Contact</a> --}}
            {{--            </li> --}}
            {{--        </ul> --}}
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
