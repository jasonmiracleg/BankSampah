@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center flex-cols h-screen px-8 md:px-0">
        <form class="w-full max-w-md mx-auto" method="POST" action="{{ route('penyetoran.tarik') }}" id="penyetoranForm">
            @csrf
            <h1 class="mb-4 font-bold text-2xl">Pencairan Saldo Bank Sampah</h1>
            <div class="mb-5">
                <label for="name" class="block mb-2 text-lg md:text-sm font-medium text-gray-900">Nama Nasabah</label>
                <input type="name" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukan Nama" value="{{ $user->name }}" disabled/>
            </div>
            <div class="mb-5">
                <label for="price" class="block mb-2 text-lg md:text-sm font-medium text-gray-900">Nominal Uang</label>
                <div class="relative mt-1 rounded-md shadow-sm">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        Rp
                    </span>
                    <input type="text" id="price" name="price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        placeholder="Masukkan Nominal Uang" oninput="formatRupiah(this)" />
                </div>
                @error('price')
                    <span class="mt-2 text-md md:text-xs text-red-600" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <input type="hidden" name="saving" value="{{ $user->total_income }}">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="flex flex-col items-center md:flex-row md:justify-between md:items-center w-full">
                <button type="submit"
                    class="text-white bg-green-300 focus:ring-2 focus:outline-none focus:ring-green-400 hover:bg-green-500 font-medium rounded-lg text-sm w-full md:w-auto px-5 py-2.5 text-center">Cairkan
                    Saldo</button>
            </div>
        </form>
    </div>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $("#name").select2({
            placeholder: 'Pilih Nama Nasabah',
            allowClear: true
        });

        function formatRupiah(element) {
            let value = element.value.replace(/[^,\d]/g, "").toString();
            let split = value.split(",");
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
            element.value = rupiah;
        }

        document.getElementById('penyetoranForm').addEventListener('submit', function (event) {
            let priceInput = document.getElementById('price');
            let formattedValue = priceInput.value.replace(/[^,\d]/g, '').toString();
            priceInput.value = formattedValue;
        });
    </script>
@endsection
