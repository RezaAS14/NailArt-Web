<?= $this->extend('layout/admin_template') ?>
<?= $this->section('checkout_management') ?>
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
            <i class="fa-solid fa-money-check-dollar mr-2"></i> Kelola Transaksi Pesanan
        </h2>
        </header>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold text-gray-700 mb-4 border-b pb-2">Daftar Pesanan</h3>
        <!-- Search & Filter -->
        <div class="flex flex-col md:flex-row gap-4 mb-4">
            <input type="text" id="searchInput" class="border rounded px-3 py-2 w-full md:w-1/2" placeholder="Cari nama pembeli, alamat, atau tanggal..." oninput="filterTable()">
            <select id="statusFilter" class="border rounded px-3 py-2 w-full md:w-1/3" onchange="filterTable()">
                <option value="">Semua Status</option>
                <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
                <option value="Diproses">Diproses</option>
                <option value="Dikemas">Dikemas</option>
                <option value="Dikirim">Dikirim</option>
                <option value="Selesai">Selesai</option>
                <option value="Dibatalkan">Dibatalkan</option>
            </select>
        </div>
        <div class="overflow-x-auto">
            <table id="checkoutTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-card-info">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">No.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Tanggal Checkout</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nama Pembeli</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Total Pesanan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Keterangan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status Pesanan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($checkout_data)) : ?>
                        <tr>
                            <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                Belum ada data transaksi checkout.
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php $no=1; foreach ($checkout_data as $checkout) : 
                            $keterangan = $checkout['keterangan_pembayaran'] ?? 'Belum Bayar';
                            $statusPesanan = $checkout['status_pesanan'] ?? 'Menunggu Pembayaran';
                        ?>
                            <tr class="hover:bg-bg-light-yellow transition duration-150" 
                                data-status="<?= esc($statusPesanan) ?>"
                                data-keterangan="<?= esc($keterangan) ?>"
                                data-search="<?= esc(strtolower(($checkout['nama_depan'] ?? '') . ' ' . ($checkout['nama_belakang'] ?? '') . ' ' . ($checkout['alamat'] ?? '') . ' ' . ($checkout['tanggal_checkout'] ?? ''))) ?>">
                                <td class="px-4 py-2 font-bold text-center"> <?= $no++; ?> </td>
                                <td class="px-4 py-2 text-sm"> <?= esc($checkout['tanggal_checkout'] ?? '-') ?> </td>
                                <td class="px-4 py-2"> <?= esc($checkout['nama_depan'] ?? '') ?> <?= esc($checkout['nama_belakang'] ?? '') ?> </td>
                                <td class="px-4 py-2 text-sm"> <?= esc($checkout['alamat'] ?? '-') ?> </td>
                                <td class="px-4 py-2 font-bold text-green-600"> Rp<?= number_format(esc($checkout['total_harga']), 0, ',', '.') ?> </td>
                                <td class="px-4 py-2">
                                    <select class="border rounded px-2 py-1 text-sm keterangan-select" 
                                            onchange="updatePesanan(this, <?= esc($checkout['id_checkout']) ?>)" 
                                            data-id="<?= esc($checkout['id_checkout']) ?>">
                                        <option value="Belum Bayar" <?= $keterangan === 'Belum Bayar' ? 'selected' : '' ?>>Belum Bayar</option>
                                        <option value="Menunggu Verifikasi" <?= $keterangan === 'Menunggu Verifikasi' ? 'selected' : '' ?>>Menunggu Verifikasi</option>
                                        <option value="Lunas" <?= $keterangan === 'Lunas' ? 'selected' : '' ?>>Lunas</option>
                                        <option value="Gagal" <?= $keterangan === 'Gagal' ? 'selected' : '' ?>>Gagal</option>
                                    </select>
                                </td>
                                <td class="px-4 py-2">
                                    <select class="border rounded px-2 py-1 text-sm status-select" 
                                            onchange="updatePesanan(this, <?= esc($checkout['id_checkout']) ?>)" 
                                            data-id="<?= esc($checkout['id_checkout']) ?>">
                                        <option value="Menunggu Pembayaran" <?= $statusPesanan === 'Menunggu Pembayaran' ? 'selected' : '' ?>>Menunggu Pembayaran</option>
                                        <option value="Diproses" <?= $statusPesanan === 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                                        <option value="Dikemas" <?= $statusPesanan === 'Dikemas' ? 'selected' : '' ?>>Dikemas</option>
                                        <option value="Dikirim" <?= $statusPesanan === 'Dikirim' ? 'selected' : '' ?>>Dikirim</option>
                                        <option value="Selesai" <?= $statusPesanan === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                        <option value="Dibatalkan" <?= $statusPesanan === 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail Checkout -->
<div id="detail-modal-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white w-full max-w-3xl p-6 rounded-lg shadow-2xl relative max-h-[90vh] overflow-y-auto">
        <h3 class="text-2xl font-bold text-primary-dark mb-4 border-b pb-2">
            <i class="fa-solid fa-receipt mr-2"></i> Detail Transaksi
        </h3>
        
        <div id="detail-content" class="space-y-4">
            <!-- Content will be loaded here -->
        </div>
        
        <button onclick="closeDetailModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 transition">
            <i class="fa-solid fa-xmark text-2xl"></i>
        </button>
    </div>
</div>

<script>
        // Search & Filter logic
        function filterTable() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            const table = document.getElementById('checkoutTable');
            const rows = table.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status') || '';
                const rowKeterangan = row.getAttribute('data-keterangan') || '';
                const rowSearch = row.getAttribute('data-search') || '';
                const matchesSearch = search ? rowSearch.includes(search) : true;
                const matchesStatus = statusFilter ? rowStatus === statusFilter : true;
                row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            filterTable();
        });

        function updatePesanan(selectEl, idCheckout) {
            const row = selectEl.closest('tr');
            const keterangan = row.querySelector('.keterangan-select').value;
            const status = row.querySelector('.status-select').value;

            fetch('<?= site_url('admin/checkout/updateStatus') ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    id_checkout: idCheckout,
                    keterangan: keterangan,
                    status: status
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    row.setAttribute('data-status', status);
                    row.setAttribute('data-keterangan', keterangan);
                    Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Status pesanan tersimpan ke database', timer: 1500, showConfirmButton: false });
                    filterTable();
                } else {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Tidak dapat menyimpan status' });
                }
            })
            .catch(() => {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Terjadi kesalahan koneksi' });
            });
        }
    function viewCheckoutDetail(checkoutId) {
        // Show modal
        document.getElementById('detail-modal-overlay').classList.remove('hidden');
        
        // Fetch detail data
        fetch('<?= site_url('admin/checkout/detail/') ?>' + checkoutId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let html = `
                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">No. Transaksi</p>
                                    <p class="font-bold text-lg">#TRX-${String(data.checkout.id_checkout).padStart(5, '0')}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Tanggal</p>
                                    <p class="font-semibold">${new Date().toLocaleDateString('id-ID')}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Nama Pelanggan</p>
                                    <p class="font-semibold">${data.checkout.nama_depan || ''} ${data.checkout.nama_belakang || ''}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Email</p>
                                    <p class="font-semibold">${data.checkout.email || '-'}</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-sm text-gray-600">Alamat</p>
                                    <p class="font-semibold">${data.checkout.alamat || '-'}</p>
                                </div>
                            </div>
                        </div>
                        
                        <h4 class="font-bold text-lg mb-3 text-gray-700">Item Produk:</h4>
                        <div class="space-y-3">
                    `;
                    
                    if (data.items && data.items.length > 0) {
                        data.items.forEach(item => {
                            html += `
                                <div class="flex items-center gap-4 p-3 bg-white border border-gray-200 rounded-lg hover:shadow-md transition">
                                    <img src="<?= base_url('uploads/accessories/') ?>${item.gambar_produk}" 
                                         alt="${item.nama_produk}" 
                                         class="w-16 h-16 object-cover rounded border">
                                    <div class="flex-grow">
                                        <p class="font-semibold text-gray-800">${item.nama_produk}</p>
                                        <p class="text-sm text-gray-600">Qty: ${item.jumlah_checkout} × Rp${Number(item.harga_checkout / item.jumlah_checkout).toLocaleString('id-ID')}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-green-600">Rp${Number(item.harga_checkout).toLocaleString('id-ID')}</p>
                                    </div>
                                </div>
                            `;
                        });
                    } else {
                        html += '<p class="text-gray-500 text-center py-4">Tidak ada item dalam transaksi ini.</p>';
                    }
                    
                    html += `
                        </div>
                        <div class="mt-6 pt-4 border-t border-gray-300">
                            <div class="flex justify-between items-center">
                                <p class="text-xl font-bold text-gray-800">Total Harga:</p>
                                <p class="text-2xl font-bold text-green-600">Rp${Number(data.checkout.total_harga).toLocaleString('id-ID')}</p>
                            </div>
                        </div>
                    `;
                    
                    document.getElementById('detail-content').innerHTML = html;
                } else {
                    document.getElementById('detail-content').innerHTML = '<p class="text-red-600 text-center">Gagal memuat detail transaksi.</p>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('detail-content').innerHTML = '<p class="text-red-600 text-center">Terjadi kesalahan saat memuat data.</p>';
            });
    }
    
    function closeDetailModal() {
        document.getElementById('detail-modal-overlay').classList.add('hidden');
    }
    
    // Close modal when clicking outside
    document.getElementById('detail-modal-overlay')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeDetailModal();
        }
    });
</script>

<?php $this->endSection() ?>