@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center flex-cols h-screen">
        <form class="w-full max-w-md mx-auto" method="POST">
            @csrf
            <h1 class="mb-4 font-bold text-2xl">Penyetoran Bank Sampah</h1>
            <div class="mb-5">
                <label for="product_name" class="block mb-2 text-sm font-medium text-gray-900">Nama Barang</label>
                <input type="text" name="product_name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukan Username" required />
                @error('product_name')
                    <span class="mt-2 text-xs text-red-600" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-5">
                <label for="weight" class="block mb-2 text-sm font-medium text-gray-900">Berat Barang (Kg)</label>
                <input type="number" name="weight"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukan Berat Barang" required />
                @error('weight')
                    <span class="mt-2 text-xs text-red-600" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-5">
                <label for="weight" class="block mb-2 text-sm font-medium text-gray-900">Penerima</label>
                <select name="recipient" id="recipient"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
                    <option value="" selected>Admin</option>
                    <option value="Jason">Jason</option>
                </select>
                @error('weight')
                    <span class="mt-2 text-xs text-red-600" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="flex flex-col items-center md:flex-row md:justify-between md:items-center w-full">
                <button type="submit"
                    class="text-white bg-green-300 focus:ring-2 focus:outline-none focus:ring-green-400 hover:bg-green-500 font-medium rounded-lg text-sm w-full md:w-auto px-5 py-2.5 text-center">Setor</button>
            </div>
        </form>
    </div>
@endsection
