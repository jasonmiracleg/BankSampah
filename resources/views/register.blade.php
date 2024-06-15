@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center flex-cols h-screen">
        <form class="w-full max-w-md mx-auto" method="POST" action="{{ route('register') }}">
            @csrf
            <h1 class="mb-8 font-bold text-2xl">Register</h1>
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                <input type="name" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukan Nama" value="{{ old('name') }}" />
                @error('name')
                    <span class="mt-2 text-xs text-red-600" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                <input type="username" name="username"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukan Username" value="{{ old('username') }}" />
                @error('username')
                    <span class="mt-2 text-xs text-red-600" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                <input type="password" name="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukan Password" />
                @error('password')
                    <span class="mt-2 text-xs text-red-600" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            @if (!auth()->check())
                <input type="hidden" name="is_admin" value="0">
            @endif
            <div class="flex flex-col items-center md:flex-row md:justify-between md:items-center w-full">
                <button type="submit"
                    class="text-white bg-green-300 focus:ring-2 focus:outline-none focus:ring-green-400 hover:bg-green-500 font-medium rounded-lg text-sm w-full md:w-auto px-5 py-2.5 text-center">Daftar</button>
                <p class="mt-2 md:mt-0"><a href="{{ route('login.page') }}" class="text-blue-600 underline">Sudah Punya Akun?</a></p>
            </div>            
        </form>
    </div>
@endsection
