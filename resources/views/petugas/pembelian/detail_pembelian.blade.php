<x-app-layout>
    <table class="table table-bordered mt-4">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody id="cart-items">
        <!-- Data akan diisi di sini dengan JavaScript -->
    </tbody>
</table>

<p class="fw-bold">Total Bayar: Rp. <span id="total-bayar">0</span></p>

<script>

    document.addEventListener("DOMContentLoaded", function() {
        let cart = JSON.parse(localStorage.getItem("cart")) || {};
        let cartItemsContainer = document.getElementById("cart-items");
        let totalBayarSpan = document.getElementById("total-bayar");
        let totalBayar = 0;

        // Jika tidak ada data
        if (Object.keys(cart).length === 0) {
            cartItemsContainer.innerHTML = "<tr><td colspan='3' class='text-center'>Tidak ada produk yang dipilih</td></tr>";
            return;
        }

        // Loop data dalam `cart` dan tambahkan ke tabel
        Object.values(cart).forEach(item => {
            let row = `
                <tr>
                    <td>${item.nama}</td>  <!-- Menampilkan Nama Produk -->
                    <td>${item.jumlah}</td>
                    <td>Rp. ${item.subtotal.toLocaleString("id-ID")}</td>
                </tr>
            `;
            cartItemsContainer.innerHTML += row;
            totalBayar += item.subtotal;
        });

        // Tampilkan total harga
        totalBayarSpan.textContent = totalBayar.toLocaleString("id-ID");
    });


</script>

</x-app-layout>