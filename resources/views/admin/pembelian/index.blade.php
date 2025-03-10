<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Daftar Penjualan') }}
    </h2>
</x-slot>

<div class="max-w-6xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
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

    <div class="mb-4">
        <a href="{{ route('admin.pembelian.export') }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition">
            Export Penjualan (.xlsx)
        </a>
    </div>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">Nama Pelanggan</th>
                <th class="border border-gray-300 px-4 py-2">Tanggal Penjualan</th>
                <th class="border border-gray-300 px-4 py-2">Total Harga</th>
                <th class="border border-gray-300 px-4 py-2">Dibuat Oleh</th>
                <th class="border border-gray-300 px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $purchase->name }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $purchase->created_at->format('d-m-Y') }}</td>
                <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($purchase->total_price, 0, ',', '.') }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $purchase->made_by }}</td>
                <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                        data-bs-target="#detailPenjualanModal" 
                        data-id="{{ $purchase->id }}" 
                        data-name="{{ $purchase->name }}" 
                        data-stock="{{ $purchase->quantity }}">
                        Lihat
                    </button>
                    <a href="#" class="btn btn-warning">Unduh Bukti</a>
                </td>
            </tr>
            @endforeach
        </tbody>    
    </table>

    {{ $purchases->links() }}
</div>  

<!-- Modal Bootstrap -->
<div class="modal fade" id="detailPenjualanModal" tabindex="-1" aria-labelledby="detailPenjualanLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 40%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailPenjualanLabel">Detail Penjualan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="d-flex justify-content-between">
                <p><strong>Poin Member:</strong> 32000</p>
                <p><strong>Bergabung Sejak:</strong> 21 Februari 2025</p>
            </div>

                <p><strong>No. HP:</strong> 0812345678903</p>
                <p><strong>Poin Member:</strong> 32000</p>

                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Anjing Peliharaan</td>
                            <td>1</td>
                            <td>Rp. 3.200.000</td>
                            <td>Rp. 3.200.000</td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-end mt-3">
                    <strong>Total:</strong> <span>Rp. 3.200.000</span>
                </div>
                <div class="text-xs text-gray-500 mt-4 text-center">
                    <p>Dibuat pada: 2025-02-21 07:33:08</p>
                    <p>Oleh: Petugas</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var detailModal = document.getElementById('detailPenjualanModal');
    detailModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var customerName = button.getAttribute('data-name');

        document.getElementById('modal-customer-name').textContent = customerName;
    });
});
</script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</x-app-layout>
