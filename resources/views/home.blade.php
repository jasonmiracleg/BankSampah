@extends('layouts.app')

@section('content')
    <div class="max-w-screen-xl mx-auto p-2 mt-2">
        <div class="md:pt-16 pt-20 flex md:flex-row flex-col w-full">
            <div class="w-full p-2">
                <a class="block bg-blue-500 text-white rounded-lg shadow mb-4 no-underline">
                    <div class="p-4">
                        <h2 class="font-bold">Saldo Nasabah</h2>
                        <hr class="border-t-2 my-1">
                        <h3 class="font-semibold">{{ 'Rp ' . number_format(auth()->user()->saldo, 2, '.', ',') }}</h3>
                    </div>
                </a>
            </div>
            <div class="w-full p-2">
                <a class="block bg-blue-500 text-white rounded-lg shadow mb-4 no-underline">
                    <div class="p-4">
                        <h2 class="font-bold">Pemasukan</h2>
                        <hr class="border-t-2 my-1">
                        <h3 class="font-semibold">{{ 'Rp ' . number_format(auth()->user()->total_income, 2, '.', ',') }}
                        </h3>
                    </div>
                </a>
            </div>
            <div class="w-full p-2">
                <a class="block bg-blue-500 text-white rounded-lg shadow mb-4 no-underline">
                    <div class="p-4">
                        <h2 class="font-bold">Pengeluaran</h2>
                        <hr class="border-t-2 my-1">
                        <h3 class="font-semibold">{{ 'Rp ' . number_format(auth()->user()->total_outcome, 2, '.', ',') }}
                        </h3>
                    </div>
                </a>
            </div>
        </div>
        <div class="px-2">
            <h1 class="font-semibold text-2xl">Penyetoran Terakhir</h1>
            <hr class="mb-4 border-t border-black">
            @if (!$latestSetors->isEmpty())
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-700 border border-1">
                        <colgroup>
                            <col style="width: 25%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
                        </colgroup>
                        <thead class="text-xs text-gray-800 uppercase bg-green-300">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Penerima
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Nama Barang
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Berat Barang
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestSetors as $setor)
                                <tr
                                    class="odd:bg-white even:bg-gray-100 dark:odd:bg-gray-900 dark:even:bg-gray-800 border-b dark:border-gray-700">
                                    <td scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap text-center">
                                        {{ $setor->created_at }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $setor->recipient->name }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $setor->product_name }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $setor->weight }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <h1 class="text-2xl w-full text-center">Belum Ada Penyetoran</h1>
            @endif
            <h1 class="font-semibold text-2xl mt-8">Transaksi Terakhir</h1>
            <hr class="mb-4 border-t border-black">
            @if (!$latestTransactions->isEmpty())
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-700">
                        <colgroup>
                            <col style="width: 25%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
                        </colgroup>
                        <thead class="text-xs text-gray-800 uppercase bg-green-300">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Keterangan
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Tipe Transaksi
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestTransactions as $transaction)
                                <tr
                                    class="odd:bg-white even:bg-gray-100 dark:odd:bg-gray-900 dark:even:bg-gray-800 border-b dark:border-gray-700">
                                    <td scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap text-center">
                                        {{ $transaction->created_at }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $transaction->keterangan }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($transaction->transaction_type == 0)
                                            Pemasukan
                                        @else
                                            Pengeluaran
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ 'Rp ' . number_format($transaction->total_nominal, 2, '.', ',') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <h1 class="text-2xl w-full text-center">Belum Ada Transaksi</h1>
            @endif
        </div>
    </div>
@endsection
