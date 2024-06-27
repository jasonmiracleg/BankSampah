@extends('layouts.app')

@section('content')
    <div class="max-w-screen-xl mx-auto p-2 mt-2">
        <div class="mt-16 mx-2">
            <h1 class="font-semibold text-2xl">Riwayat Penyetoran</h1>
            <hr class="mb-4 border-t border-black">
            <div>
                <a href="{{ route('penyetoran.create') }}">
                    <button type="button"
                        class="focus:outline-none text-white bg-green-500 hover:bg-green-700 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Lakukan
                        Setor</button>
                </a>
            </div>
        </div>
        <div class="mt-4 mx-2">
            @if ($setors->isEmpty())
                <h1 class="text-2xl w-full text-center">Belum Ada Penyetoran</h1>
            @else
                <table class="w-full text-sm text-center text-gray-700 border border-1">
                    <thead class="text-xs text-gray-800 uppercase bg-green-300">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Barang
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Berat Barang
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($setors as $setor)
                            <tr
                                class="odd:bg-white even:bg-gray-100 dark:odd:bg-gray-900 dark:even:bg-gray-800 border-b dark:border-gray-700">
                                <td scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap">
                                    {{ $setor->created_at }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $setor->product_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $setor->weight }} Kg
                                </td>
                                <td class="px-6 py-4 flex flex-col">
                                    <input type="submit" class="focus:outline-none text-white bg-red-500 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2" value="Belum Terjual">
                                    <input type="submit" class="focus:outline-none text-white bg-green-500 font-medium rounded-lg text-sm py-2.5 me-2 mb-2" value="Sudah Ditarik">
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('transaksi.edit', $setor) }}">
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
