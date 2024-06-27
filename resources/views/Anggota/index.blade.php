@extends('layouts.app')

@section('content')
    <div class="max-w-screen-xl mx-auto p-2 mt-2">
        <div class="mt-16 mx-2">
            <h1 class="font-semibold text-2xl">Data Anggota</h1>
            <hr class="mb-4 border-t border-black">
        </div>
        <div class="mt-4 mx-2">
            <table class="w-full text-sm text-left rtl:text-right text-gray-700 border border-1">
                <thead class="text-xs text-gray-800 uppercase bg-green-300">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Nama Nasabah
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Saldo
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
                                {{ 'Rp ' . number_format($user->saldo, 2, '.', ',') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4 mx-2">
            {{ $users->links() }} <!-- Pagination links -->
        </div>
    </div>
@endsection
