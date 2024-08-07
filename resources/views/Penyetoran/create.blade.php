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
            <form class="w-full max-w-md mx-auto" method="POST" action="{{ route('penyetoran.store') }}">
                @csrf
                <h1 class="mb-4 font-bold text-2xl">Penyetoran Bank Sampah</h1>
                <div class="mb-5">
                    <label for="garbage" class="block mb-2 text-lg md:text-sm font-medium text-gray-900">Nama Barang</label>
                    <select name="garbage" id="garbage" class="w-full">
                        <option></option>
                        @foreach ($garbages as $garbage)
                            <option value="{{ $garbage->id }}" data-category="{{ $garbage->categorized->category_name }}"
                                data-price="{{ $garbage->price }}">
                                {{ $garbage->garbage_type }}</option>
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
                        Barang (Kg)</label>
                    <input type="number" name="quantity" id="quantity-input" step="0.0001"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Masukkan Berat Barang" />
                    @error('quantity')
                        <span class="mt-2 text-md md:text-xs text-red-600" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-5 flex justify-between items-center">
                    <label for="price" class="block mb-2 text-lg md:text-sm font-medium text-gray-900">Total Uang</label>
                    <p id="price-display" class="text-lg md:text-sm">Rp 0</p>
                </div>
                <input type="hidden" name="total_price" id="total-price-input"> <!-- Hidden input for total price -->
                <div class="mb-5">
                    <label for="sender" class="block mb-2 text-lg md:text-sm font-medium text-gray-900">Nama Nasabah Penyetor</label>
                    <select name="sender" id="sender"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        >
                        <option></option>
                        @foreach ($users as $user)
                            @if ($user->is_admin == '0' && $user != auth()->user())
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('sender')
                        <span class="mt-2 text-md md:text-xs text-red-600" role="alert">
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
    @endif
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#garbage").select2({
                placeholder: 'Pilih Jenis Sampah',
                allowClear: true
            });
            $("#sender").select2({
                placeholder: 'Pilih Nama Nasabah',
                allowClear: true
            });

            // Function to update total price based on garbage selection and quantity
            function updatePrice() {
                const garbageSelect = document.getElementById('garbage');
                const quantityInput = document.getElementById('quantity-input');
                const priceDisplay = document.getElementById('price-display');
                const totalPriceInput = document.getElementById('total-price-input'); // Hidden input for total price

                const selectedGarbageOption = garbageSelect.options[garbageSelect.selectedIndex];
                const pricePerKg = parseFloat(selectedGarbageOption.getAttribute('data-price'));
                const quantity = parseFloat(quantityInput.value);

                if (!isNaN(pricePerKg) && !isNaN(quantity)) {
                    const totalPrice = pricePerKg * quantity;
                    priceDisplay.textContent = `Rp ${totalPrice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}`;
                    totalPriceInput.value = totalPrice; // Update hidden input with total price
                } else {
                    priceDisplay.textContent = `Rp 0`;
                    totalPriceInput.value = ''; // Clear hidden input if invalid value
                }
            }

            // Call updatePrice once to set the initial price display
            updatePrice();

            // Add event listener to update total price when garbage type changes (using Select2 change event)
            $('#garbage').on('select2:select', function() {
                updatePrice();
            });

            // Add event listener to update total price when quantity changes
            document.getElementById('quantity-input').addEventListener('input', function() {
                // Validate input value
                if (this.value !== '' && (isNaN(this.value) || parseFloat(this.value) < 0)) {
                    this.value = ''; // Clear input if invalid value
                }
                updatePrice(); // Update price after validating input
            });
        });
    </script>
@endsection
