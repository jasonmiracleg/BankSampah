<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bank Sampah</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body>
    <nav class="bg-green-500 border-gray-200 top-0 fixed z-50 w-full">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl text-white font-semibold whitespace-nowrap">Bank Sampah</span>
            </a>
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
                        <a href="#"
                            class="block py-2 px-3 md:text-white bg-blue-700 rounded font-semibold md:bg-transparent md:p-0 nav-link md:hover:text-gray-200">Beranda</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 md:text-white rounded hover:bg-gray-100 font-semibold md:hover:bg-transparent md:border-0 md:hover:text-gray-200 md:p-0 nav-link">Penyetoran</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 md:text-white rounded hover:bg-gray-100 font-semibold md:hover:bg-transparent md:border-0 md:hover:text-gray-200 md:p-0 nav-link">Transaksi</a>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                            class="flex items-center justify-between w-full py-2 px-3 md:text-white font-semibold rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-gray-200 md:p-0 md:w-auto">Nama Orang
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg></button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar"
                            class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-400"
                                aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100">Profil</a>
                                </li>
                            </ul>
                            <div class="py-1">
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700">Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
