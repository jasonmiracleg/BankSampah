@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center flex-cols h-screen px-8 md:px-0">
        <form class="w-full max-w-md mx-auto" method="POST" action="{{ route('transaksi.update', $transactionEdit) }}">
            @csrf
            <h1 class="mb-4 font-bold text-2xl">Pencatatan Transaksi</h1>
            <div class="mb-5">
                <label for="keterangan" class="block mb-2 text-lg md:text-sm font-medium text-gray-900">Keterangan</label>
                <input type="text" name="keterangan"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Contoh : Hasil Penjualan Bank Sampah" value=" {{ $transactionEdit->keterangan }}" />
                @error('keterangan')
                    <span class="mt-2 text-md md:text-xs text-red-600" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-5">
                <label for="transaction_type" class="block mb-2 text-lg md:text-sm font-medium text-gray-900">Tipe Transaksi</label>
                <select name="transaction_type" id="transaction_type"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
                    <option value="0" {{ $transactionEdit->transaction_type == 0 ? 'selected' : '' }}>Pemasukan</option>
                    <option value="1" {{ $transactionEdit->transaction_type == 1 ? 'selected' : '' }}>Pengeluaran</option>
                </select>
                @error('transaction_type')
                    <span class="mt-2 text-md md:text-xs text-red-600" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-5">
                <label for="total_nominal" class="block mb-2 text-lg md:text-sm font-medium text-gray-900">Total Nominal (Rp)</label>
                <input type="number" name="total_nominal"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="100000" value="{{ $transactionEdit->total_nominal }}"/> 
                @error('total_nominal')
                    <span class="mt-2 text-md md:text-xs text-red-600" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <div class="flex flex-col items-center md:flex-row md:justify-between md:items-center w-full">
                <button type="submit"
                    class="text-white bg-green-300 focus:ring-2 focus:outline-none focus:ring-green-400 hover:bg-green-500 font-medium rounded-lg text-sm w-full md:w-auto px-5 py-2.5 text-center">Simpan Transaksi</button>
            </div>
        </form>
    </div>
@endsection
