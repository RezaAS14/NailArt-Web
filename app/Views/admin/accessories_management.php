<?= $this->extend('layout/admin_template') ?>
<?= $this->section('accessories_management') ?>
<div class="p-8">
    
    <!-- Pesan Flashdata -->
    <?php if (session()->getFlashdata('success')): ?>
        <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline"><?= session()->getFlashdata('success') ?></span>
        </div>
        <script>
            setTimeout(function() {
                const alert = document.getElementById('success-alert');
                if (alert) {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000);
        </script>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Gagal!</strong>
            <span class="block sm:inline"><?= session()->getFlashdata('error') ?></span>
        </div>
    <?php endif; ?>
    <!-- End Pesan Flashdata -->
    
    <header class="bg-white p-4 rounded-lg shadow-md mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-primary-dark">
              <i class="fa-solid fa-box mr-2"></i> Kelola Produk
        </h2>
        <a href="<?= site_url('admin/accessories/add') ?>"
                class="px-4 py-2 bg-primary-dark text-white rounded-lg shadow-md hover:bg-nav-hover transition duration-200">
              <i class="fa-solid fa-plus mr-2"></i> Tambah Produk
        </a>
    </header>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold text-gray-700 mb-4 border-b pb-2">Daftar Produk</h3>
        
        <!-- Search & Filter -->
        <div class="flex flex-col md:flex-row gap-4 mb-4">
            <input type="text" id="searchProductInput" class="border rounded px-3 py-2 w-full md:w-1/2" placeholder="Cari nama produk atau deskripsi..." oninput="filterProductTable()">
            <select id="filterStockStatus" class="border rounded px-3 py-2 w-full md:w-1/4" onchange="filterProductTable()">
                <option value="">Semua Stok</option>
                <option value="tersedia">Tersedia (> 25)</option>
                <option value="rendah">Stok Rendah (≤ 25)</option>
                <option value="habis">Habis (0)</option>
            </select>
        </div>
        
        <div class="overflow-x-auto">
            <table id="productsTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-card-info">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">No.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Gambar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nama Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Harga Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Diskon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Deskripsi Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Jumlah Stok</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($accessories)) : ?>
                        <tr>
                            <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                Belum ada data Produk.
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php $no = 1; foreach ($accessories as $product) : ?>
                            <tr class="hover:bg-bg-light-yellow transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <?= $no++ ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="<?= base_url('uploads/accessories/' . esc($product['gambar_produk'])) ?>" alt="Product Image" class="w-16 h-16 object-cover rounded shadow-md border border-nav-inactive">
                                </td>
                                <td class="px-6 py-4 max-w-xs overflow-hidden text-ellipsis text-sm font-semibold text-gray-900">
                                    <?= esc($product['nama_produk']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Rp<?= number_format(esc($product['harga_produk']), 0, ',', '.') ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 font-bold">
                                    <?= esc($product['diskon']) ?>%
                                </td>
                                <td class="px-6 py-4 max-w-xs overflow-hidden text-ellipsis text-sm text-gray-900">
                                    <?= esc($product['deskripsi_produk']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="font-bold <?= (esc($product['stok_tersedia']) < 5) ? 'text-red-500' : 'text-green-600' ?>">
                                        <?= esc($product['stok_tersedia']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="<?= site_url('admin/accessories/edit/' . esc($product['id_produk'])) ?>" class="text-blue-600 hover:text-blue-900 mx-1" title="Edit">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <a href="<?= site_url('admin/accessories/delete/' . esc($product['id_produk'])) ?>" onclick="return confirm('Anda yakin ingin menghapus produk ini?')" class="text-red-600 hover:text-red-900 mx-1" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function filterProductTable() {
    const search = document.getElementById('searchProductInput').value.toLowerCase();
    const stockFilter = document.getElementById('filterStockStatus').value;
    const table = document.getElementById('productsTable');
    const rows = table.querySelectorAll('tbody tr');
    let visibleRows = 0;
    
    rows.forEach(row => {
        // Skip empty state row
        if (row.cells.length === 1 || row.querySelector('td[colspan]')) {
            return;
        }
        
        // Get product name and description
        const nama = row.querySelector('td:nth-child(3)')?.innerText.toLowerCase() || '';
        const deskripsi = row.querySelector('td:nth-child(6)')?.innerText.toLowerCase() || '';
        const searchText = nama + ' ' + deskripsi;
        
        // Get stock value
        const stockCell = row.querySelector('td:nth-child(7) span');
        const stock = parseInt(stockCell?.innerText || 0);
        
        let show = true;
        
        // Search filter
        if (search && !searchText.includes(search)) {
            show = false;
        }
        
        // Stock filter
        if (stockFilter) {
            if (stockFilter === 'tersedia' && stock <= 25) show = false;
            if (stockFilter === 'rendah' && (stock > 25 || stock === 0)) show = false;
            if (stockFilter === 'habis' && stock !== 0) show = false;
        }
        
        row.style.display = show ? '' : 'none';
        if (show) visibleRows++;
    });
    
    // Show or hide empty state
    const emptyState = table.querySelector('tbody tr td[colspan]');
    if (emptyState && visibleRows === 0) {
        emptyState.parentElement.style.display = '';
    } else if (emptyState) {
        emptyState.parentElement.style.display = 'none';
    }
}
</script>

<?php $this->endSection() ?>