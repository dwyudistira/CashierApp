<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        @if(session('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        title: "Berhasil!",
                        text: "{{ session('success') }}",
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                });
            </script>
        @endif

        @if(session('error'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        title: "Gagal!",
                        text: "{{ session('error') }}",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                });
            </script>
        @endif

        <div class="mb-4">
            <a href="{{ route('admin.product.create') }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition">Tambah Produk</a>
        </div>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2"></th>
                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                    <th class="border border-gray-300 px-4 py-2">Harga</th>
                    <th class="border border-gray-300 px-4 py-2">Stok</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-30 h-16 object-cover">
                            @else
                                -
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $product->stock }}</td>
                        <td>
                            <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateStockModal" 
                                    data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-stock="{{ $product->stock }}">
                                Update Stok
                            </button>
                            <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger delete-button" data-name="{{ $product->name }}">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Modal Update Stok
        var updateStockModal = document.getElementById('updateStockModal');
        updateStockModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var productId = button.getAttribute('data-id');
            var productName = button.getAttribute('data-name');
            var productStock = button.getAttribute('data-stock');

            document.getElementById('product_id').value = productId;
            document.getElementById('product_name').value = productName;
            document.getElementById('product_stock').value = productStock;
        });

        // SweetAlert untuk konfirmasi hapus
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                var form = this.closest('form');
                var productName = this.getAttribute('data-name');

                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Anda akan menghapus produk: " + productName,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
    </script>

</x-app-layout>

<!-- Tambahkan SweetAlert dan Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal -->
<div class="modal fade" id="updateStockModal" tabindex="-1" aria-labelledby="updateStockLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateStockLabel">Update Stok Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('admin.product.updateStock') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <input type="hidden" id="product_id" name="id">
          <div class="mb-3">
            <label for="product_name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="product_name" name="name" readonly>
          </div>
          <div class="mb-3">
            <label for="product_stock" class="form-label">Stok</label>
            <input type="number" class="form-control" id="product_stock" name="stock" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
