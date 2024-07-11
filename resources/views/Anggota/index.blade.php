@extends('layouts.app')

@section('content')
    <div class="max-w-screen-xl mx-auto p-4 lg:p-2 mt-2">
        <div class="mt-16 mx-2">
            <h1 class="font-semibold text-2xl">Data Nasabah</h1>
            <hr class="mb-4 border-t border-black">
        </div>
        @if ($users->isEmpty())
            <h1 class="md:text-2xl text-xl w-full text-center">Belum Ada Anggota</h1>
        @else
            <div class="mt-4 mx-2">
                <div>
                    <form class="flex " role="search" action="{{ route('data.nasabah') }}" method="GET">
                        @csrf
                        <input
                            class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 block w-full rounded-md sm:text-sm border p-2"
                            type="search" placeholder="Search" aria-label="Search" name="search">
                        <button
                            class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-300 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400"
                            type="submit">Cari</button>
                    </form>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="mt-4 w-full text-sm text-left rtl:text-right text-gray-700 border border-1">
                        <thead class="text-xs text-gray-800 uppercase bg-green-300">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Nama Nasabah
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Tabungan Bulan Ini
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Jumlah Setor Bulan Ini
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr
                                    class="odd:bg-white even:bg-gray-100 dark:odd:bg-gray-900 dark:even:bg-gray-800 border-b dark:border-gray-700">
                                    <td class="px-6 py-4 text-center">
                                        {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                                    </td>
                                    <td scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap text-center">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ 'Rp ' . number_format($user->total_income - $user->total_outcome, 2, '.', ',') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $user->setor_count }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="pt-2 md:flex-row">
                                            <a href="{{ route('cair.saldo', $user) }}">
                                                <button type="button"
                                                    class="focus:outline-none text-white bg-blue-500 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 w-32">
                                                    Tarik Saldo</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4 mx-2">
                {{ $users->links() }} <!-- Pagination links -->
            </div>
        @endif
    </div>
@endsection
