@extends('layouts.app')

@section('content')
    <div class="max-w-screen-xl mx-auto p-2 mt-2">
        <div class="mt-16 mx-2">
            <h1 class="font-semibold text-2xl">Riwayat Transaksi</h1>
            <hr class="mb-4 border-t border-black">
            <div>
                <button type="button"
                    class="focus:outline-none text-white bg-green-500 hover:bg-green-700 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Buat
                    Transaksi</button>
            </div>
        </div>
        <div class="mt-4 mx-2">
            <table class="w-full text-sm text-left rtl:text-right text-gray-700 border border-1">
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
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
@endsection
