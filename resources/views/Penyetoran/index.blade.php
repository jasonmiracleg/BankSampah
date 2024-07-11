@extends('layouts.app')

@section('content')
    @if (session('error'))
        <script>
            alert('{{ session('error') }}');
        </script>
    @endif
    <div class="max-w-screen-xl mx-auto p-4 lg:p-2 mt-2">
        <div class="mt-16 mx-2">
            <h1 class="font-semibold text-2xl">Riwayat Penyetoran</h1>
            <hr class="mb-4 border-t border-black">
            @if (auth()->user()->is_admin == 1)
                <div>
                    <a href="{{ route('penyetoran.create') }}">
                        <button type="button"
                            class="focus:outline-none text-white bg-green-500 hover:bg-green-700 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Lakukan
                            Setor</button>
                    </a>
                </div>
            @endif
        </div>
        <div class="mt-4 mx-2">
            @if ($setors->isEmpty())
                <h1 class="md:text-2xl text-xl w-full text-center">Belum Ada Penyetoran</h1>
            @else
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                                    Jumlah
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nominal
                                </th>
                                @if (auth()->user()->is_admin == 1)
                                    <th scope="col" class="px-6 py-3">
                                        Aksi
                                    </th>
                                @endif
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
                                        {{ $setor->detailGarbage->garbage_type }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($setor->detailGarbage->categorized->category_name === 'Karung')
                                            {{ $setor->weight }} Biji
                                        @else
                                            {{ $setor->weight }} Kg
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ 'Rp ' . number_format($setor->detailGarbage->price * $setor->weight, 2, '.', ',') }}
                                    </td>
                                    @if (auth()->user()->is_admin == 1)
                                        <td>
                                            <div class="pt-2 md:flex-row">
                                                <a href="{{ route('penyetoran.edit', $setor) }}">
                                                    <button type="button"
                                                        class="focus:outline-none text-white bg-blue-500 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 w-32">
                                                        Edit</button>
                                                </a>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="mt-4 mx-2">
            {{ $setors->links() }} <!-- Pagination links -->
        </div>
    </div>
    <script>
        function checkSelling() {

        }
    </script>
@endsection
