@extends('layouts.app')

@section('content')
    <div class="max-w-screen-xl mx-auto p-2 mt-2">
        <div class="mt-16 mx-2">
            <h1 class="font-semibold text-2xl">Riwayat Transaksi</h1>
            <hr class="mb-4 border-t border-black">
            <div>
                <a href="{{ route('transaksi.create') }}">
                    <button type="button"
                        class="focus:outline-none text-white bg-green-500 hover:bg-green-700 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                        Buat Transaksi</button>
                </a>
            </div>
        </div>
        <div class="mt-4 mx-2">
            @if ($transactions->isEmpty())
                <h1 class="text-2xl w-full text-center">Belum Ada Transaksi</h1>
            @else
                <table class="w-full text-sm text-left rtl:text-right text-gray-700 border border-1">
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
                            <th scope="col" class="px-6 py-3 text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
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
                                <td class="text-center">
                                    <a href="{{ route('transaksi.edit', $transaction) }}">
                                        <button type="button"
                                            class="focus:outline-none text-white bg-blue-500 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 w-20">
                                            Edit</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
