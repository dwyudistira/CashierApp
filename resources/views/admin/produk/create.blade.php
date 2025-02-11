<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Produk') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        @if(session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 text-red-600 font-medium">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Nama Produk -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" required 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Harga Produk -->
            <div>
                <label for="price_display" class="block text-sm font-medium text-gray-700">Harga</label>
                <div class="relative">
                    <span class="absolute left-3 top-2 text-gray-700">Rp</span>
                    <input type="text" id="price_display" value="{{ old('price') }}"
                        class="mt-1 block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                    <input type="hidden" name="price" id="price" value="{{ old('price') }}">
                </div>
                @error('price') 
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Stok Produk -->
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                <input type="number" name="stock" value="{{ old('stock') }}" required min="1"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                @error('stock') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Gambar Produk -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                <input type="file" name="image" accept="image/*" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Tombol Submit -->
            <div>
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition">Submit</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('price_display').addEventListener('input', function (e) {
            let value = this.value.replace(/\D/g, ""); // Hapus semua karakter non-numeric
            let formatted = new Intl.NumberFormat('id-ID').format(value); 
            
            this.value = formatted; // Format angka dengan ribuan (1.000.000)
            document.getElementById('price').value = value; // Simpan angka asli di input hidden
        });
    </script>
</x-app-layout>
