@extends('layouts.app')

@section('content')
    <div class="max-w-screen-xl mx-auto p-4 lg:p-2 mt-2">
        <div class="md:pt-16 pt-20 flex md:flex-row flex-col w-full">
            @if (auth()->user()->is_admin == '1')
                <div class="w-full p-2">
                    <a class="block bg-blue-500 text-white rounded-lg shadow mb-4 no-underline">
                        <div class="p-4">
                            <h2 class="font-bold">Saldo Bank Sampah</h2>
                            <hr class="border-t-2 my-1">
                            <h3 class="font-semibold">{{ 'Rp ' . number_format($totalIncome - $totalOutcome, 2, '.', ',') }}
                            </h3>
                        </div>
                    </a>
                </div>
                <div class="w-full p-2">
                    <a class="block bg-blue-500 text-white rounded-lg shadow mb-4 no-underline">
                        <div class="p-4">
                            <h2 class="font-bold">Pemasukan</h2>
                            <hr class="border-t-2 my-1">
                            <h3 class="font-semibold">{{ 'Rp ' . number_format($totalIncome, 2, '.', ',') }}
                            </h3>
                        </div>
                    </a>
                </div>
                <div class="w-full p-2">
                    <a class="block bg-blue-500 text-white rounded-lg shadow mb-4 no-underline">
                        <div class="p-4">
                            <h2 class="font-bold">Pengeluaran</h2>
                            <hr class="border-t-2 my-1">
                            <h3 class="font-semibold">
                                {{ 'Rp ' . number_format($totalOutcome, 2, '.', ',') }}
                            </h3>
                        </div>
                    </a>
                </div>
                <div class="w-full p-2">
                    <a class="block bg-blue-500 text-white rounded-lg shadow mb-4 no-underline">
                        <div class="p-4">
                            <h2 class="font-bold">Jumlah Sampah</h2>
                            <hr class="border-t-2 my-1">
                            <h3 class="font-semibold">
                                {{ $totalGarbage }} Kg
                            </h3>
                        </div>
                    </a>
                </div>
            @else
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
                            <h3 class="font-semibold">
                                {{ 'Rp ' . number_format(auth()->user()->total_outcome, 2, '.', ',') }}
                            </h3>
                        </div>
                    </a>
                </div>
            @endif
        </div>
        <div class="px-2">
            @if (auth()->user()->is_admin == '1')
                <div class="flex flex-row w-full">
                    <div>
                        <a href="{{ route('jual.sampah') }}">
                            <button type="button"
                                class="focus:outline-none text-white bg-green-500 hover:bg-green-700 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Menjual
                                Sampah</button>
                        </a>
                    </div>
                </div>
            @endif
            <h1 class="md:mt-0 mt-4 font-semibold md:text-2xl text-xl">Penyetoran Terakhir</h1>
            <hr class="mb-4 border-t border-black">
            @if (!$latestSetors->isEmpty())
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-700 border border-1">
                        <colgroup>
                            <col style="width: 20%;">
                            <col style="width: 20%;">
                            <col style="width: 20%;">
                            <col style="width: 20%;">
                            <col style="width: 20%;">
                        </colgroup>
                        <thead class="text-xs text-gray-800 uppercase bg-green-300">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Nama Nasabah
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Nama Barang
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Jumlah
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Nominal
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
                                        {{ $setor->sender->name }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $setor->detailGarbage->garbage_type }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($setor->detailGarbage->categorized->category_name === 'Karung')
                                            {{ $setor->weight }} Biji
                                        @else
                                            {{ $setor->weight }} Kg
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ 'Rp ' . number_format($setor->detailGarbage->price * $setor->weight, 2, '.', ',') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <h1 class="text-xl md:text-2xl w-full text-center">Belum Ada Penyetoran</h1>
            @endif
            <h1 class="font-semibold md:text-2xl text-xl mt-8">Transaksi Terakhir</h1>
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
                                            Pemasukan @if ($transaction->transactor->is_admin == 0)
                                                Nasabah
                                            @endif
                                        @else
                                            Pengeluaran @if ($transaction->transactor->is_admin == 0)
                                                Nasabah
                                            @endif
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
                <h1 class="text-xl md:text-2xl w-full text-center">Belum Ada Transaksi</h1>
            @endif
        </div>
    </div>
@endsection
