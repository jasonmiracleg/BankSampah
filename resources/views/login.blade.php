@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center flex-cols h-screen px-4 md:px-0">
        <form class="w-full max-w-md mx-auto" method="POST" action="{{ route('login') }}">
            @csrf
            <h1 class="mb-8 font-bold text-2xl">Login</h1>
            <div class="mb-5">
                <label for="email" class="block mb-2 text-lg md:text-sm font-medium text-gray-900">Nama Lengkap</label>
                <input type="name" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukan Nama Lengkap" value="{{ old('name') }}" />
                @error('name')
                    <span class="mt-2 text-md md:text-xs text-red-600" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-5">
                <label for="email" class="block mb-2 text-lg md:text-sm font-medium text-gray-900">RT/RW</label>
                <input type="rt" name="rt"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Contoh : 007/008" value="{{ old('rt') }}" />
                @error('rt')
                    <span class="mt-2 text-md md:text-xs text-red-600" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-5">
                <label for="telephone" class="block mb-2 text-lg md:text-sm font-medium text-gray-900">No. Telepon</label>
                <input type="telephone" name="telephone"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukan Nomor Telepon" value="{{ old('telephone') }}" />
                @error('telephone')
                    <span class="mt-2 text-md md:text-xs text-red-600" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="flex flex-col items-center md:flex-row md:justify-between md:items-center w-full">
                <button type="submit"
                    class="text-white bg-green-300 focus:ring-2 focus:outline-none focus:ring-green-400 hover:bg-green-500 font-medium rounded-lg text-sm w-full md:w-auto px-5 py-2.5 text-center">Login</button>
            </div>            
        </form>
    </div>
@endsection
