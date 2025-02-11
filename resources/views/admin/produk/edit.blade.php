<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Produk') }}
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

        <form action="{{ route('admin.product.update', $products->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ $products->name }}" required 
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" values="{{ $products->name }}">
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                <div class="relative">
                    <span class="absolute left-3 top-2 text-gray-700">Rp</span>
                    <!-- Input tampilan (format Rupiah) -->
                    <input type="text" id="price_display" value="{{ number_format($products->price, 0, ',', '.') }}" 
                        class="mt-1 block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                    
                    <!-- Input tersembunyi (angka asli tanpa format) -->
                    <input type="hidden" name="price" id="price" value="{{ $products->price }}">
                </div>
                
                @error('price') 
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                <input type="number" name="stock" value="{{ $products->stock }}" required min="1" readonly
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                @error('stock') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                <input type="file" name="image" accept="image/*" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition">Submit</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('price_display').addEventListener('input', function (e) {
            let value = this.value.replace(/\D/g, ""); // Hapus semua karakter non-angka
            let formatted = new Intl.NumberFormat('id-ID').format(value); // Format angka (Indonesia)
            
            this.value = formatted; // Update tampilan dengan format
            document.getElementById('price').value = value; // Simpan angka murni di input hidden
        });
    </script>

</x-app-layout>