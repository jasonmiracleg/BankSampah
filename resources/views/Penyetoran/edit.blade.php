@extends('layouts.app')

@section('content')
    @if ($users->isEmpty())
        <div class="max-w-screen-xl mx-auto p-2 mt-4">
            <div class="mt-16 mx-2 text-center">
                <div class="text-left">
                    <a href="{{ route('penyetoran') }}">
                        <button type="button"
                            class="focus:outline-none text-white bg-red-500 hover:bg-red-700 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Kembali</button>
                    </a>
                </div>
                <h1 class="font-semibold text-2xl">Belum Ada Member yang Terdaftar</h1>
            </div>
        </div>
    @else
        <div class="flex items-center justify-center flex-cols h-screen px-8 md:px-0">
            <form class="w-full max-w-md mx-auto" method="POST" action="{{ route('penyetoran.update', $setorEdit) }}">
                @csrf
                <h1 class="mb-4 font-bold text-2xl">Penyetoran Bank Sampah</h1>
                <div class="mb-5">
                    <label for="garbage" class="block mb-2 text-lg md:text-sm font-medium text-gray-900">Nama Barang</label>
                    <select name="garbage" id="garbage"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required onchange="updatePlaceholderAndLabel()">
                        @foreach ($garbages as $garbage)
                            <option value="{{ $garbage->id }}" data-category="{{ $garbage->categorized->category_name }}"
                                {{ old('garbage', $setorEdit->garbage_id) == $garbage->id ? 'selected' : '' }}>
                                {{ $garbage->garbage_type }}
                            </option>
                        @endforeach
                    </select>
                    @error('garbage')
                        <span class="mt-2 text-md md:text-xs text-red-600" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="quantity" id="quantity-label" class="block mb-2 text-lg md:text-sm font-medium text-gray-900">Berat
                        Barang
                        (Kg)</label>
                    <input type="number" name="quantity" id="quantity-input"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Masukkan Berat Barang" value="{{ old('quantity', $setorEdit->weight) }}" />
                    @error('quantity')
                        <span class="mt-2 text-md md:text-xs text-red-600" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="sender" class="block mb-2 text-lg md:text-sm font-medium text-gray-900">Penerima</label>
                    <select name="sender" id="sender"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        @foreach ($users as $user)
                            @if ($user->is_admin == '0' && $user != auth()->user())
                                <option value="{{ $user->id }}" {{ old('sender', $setorEdit->sender_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @error('sender')
                        <span class="mt-2 text-md md:text-xs text-red-600" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <input type="hidden" name="category">
                <div class="flex flex-col items-center md:flex-row md:justify-between md:items-center w-full">
                    <button type="submit"
                        class="text-white bg-green-300 focus:ring-2 focus:outline-none focus:ring-green-400 hover:bg-green-500 font-medium rounded-lg text-sm w-full md:w-auto px-5 py-2.5 text-center">Setor</button>
                </div>
            </form>
        </div>
    @endif
    <script>
        function updatePlaceholderAndLabel() {
            const selectElement = document.getElementById('garbage');
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const category = selectedOption.getAttribute('data-category');
            const quantityInput = document.getElementById('quantity-input');
            const quantityLabel = document.getElementById('quantity-label');

            if (category === 'Karung') {
                quantityInput.placeholder = "Masukkan jumlah barang";
                quantityLabel.textContent = "Jumlah Barang";
            } else {
                quantityInput.placeholder = "Masukkan Berat Barang";
                quantityLabel.textContent = "Berat Barang (Kg)";
            }
        }

        // Call updatePlaceholderAndLabel once to set the correct placeholder and label on page load
        document.addEventListener('DOMContentLoaded', (event) => {
            updatePlaceholderAndLabel();
        });
    </script>
@endsection
