@extends('layouts.app')

@section('content')
    <div class="max-w-screen-xl mx-auto p-2 mt-2">
        <div class="md:pt-16 pt-20 flex md:flex-row flex-col w-full">
            <div class="w-full p-2">
                <a class="block bg-blue-500 text-white rounded-lg shadow mb-4 no-underline">
                    <div class="p-4">
                        <h2 class="font-bold">Saldo</h2>
                        <hr class="border-t-2 my-1">
                        <h3 class="font-semibold">Rp 17.000</h3>
                    </div>
                </a>
            </div>
            <div class="w-full p-2">
                <a class="block bg-blue-500 text-white rounded-lg shadow mb-4 no-underline">
                    <div class="p-4">
                        <h2 class="font-bold">Pemasukan</h2>
                        <hr class="border-t-2 my-1">
                        <h3 class="font-semibold">Rp 17.000</h3>
                    </div>
                </a>
            </div>
            <div class="w-full p-2">
                <a class="block bg-blue-500 text-white rounded-lg shadow mb-4 no-underline">
                    <div class="p-4">
                        <h2 class="font-bold">Pengeluaran</h2>
                        <hr class="border-t-2 my-1">
                        <h3 class="font-semibold">Rp 17.000</h3>
                    </div>
                </a>
            </div>
        </div>
        <div class="px-2">
            <h1 class="font-semibold text-2xl">Penyetoran</h1>
            <hr class="mb-4 border-t border-black">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-700">
                    <thead class="text-xs text-gray-800 uppercase bg-green-300">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Keterangan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tipe Transaksi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="odd:bg-white even:bg-gray-100 dark:odd:bg-gray-900 dark:even:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                12 Februari
                            </th>
                            <td class="px-6 py-4">
                                Botol Plastik
                            </td>
                            <td class="px-6 py-4">
                                Pemasukan
                            </td>
                            <td class="px-6 py-4">
                                Rp 10.000
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
