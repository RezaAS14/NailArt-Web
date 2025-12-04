<?= $this->extend('layout/admin_template') ?>
<?= $this->section('models_management') ?>
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
            <i class="fa-solid fa-palette mr-2"></i> Kelola Models (Desain Kuku)
        </h2>
        <a href="<?= site_url('admin/models/add') ?>"
                class="px-4 py-2 bg-primary-dark text-white rounded-lg shadow-md hover:bg-nav-hover transition duration-200">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Model Baru
        </a>
    </header>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold text-gray-700 mb-4 border-b pb-2">Daftar Models</h3>
        
        <!-- Search & Filter -->
        <div class="flex flex-col md:flex-row gap-4 mb-4">
            <input type="text" id="searchInput" class="border rounded px-3 py-2 w-full md:w-1/3" placeholder="Cari kategori, durasi, harga..." oninput="filterTable()">
            <select id="filterKategori" class="border rounded px-3 py-2 w-full md:w-1/4" onchange="filterTable()">
                <option value="">Semua Kategori</option>
                <option value="Easy">Easy</option>
                <option value="Medium">Medium</option>
                <option value="Hard">Hard</option>
            </select>
        </div>
        
        <div class="overflow-x-auto">
            <table id="modelsTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-card-info">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Gambar
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Kategori
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Durasi (Jam)
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Harga
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($models)) : ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                Belum ada data Models.
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($models as $model) : ?>
                            <tr class="hover:bg-bg-light-yellow transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?= esc($model['id_models']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="<?= base_url('uploads/models/' . esc($model['gambar_models'])) ?>" alt="Model Image" class="w-16 h-16 object-cover rounded shadow-md border border-nav-inactive">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?php 
                                            if ($model['kategori_models'] == 'Hard') echo 'bg-red-100 text-red-800';
                                            elseif ($model['kategori_models'] == 'Medium') echo 'bg-yellow-100 text-yellow-800';
                                            else echo 'bg-green-100 text-green-800';
                                        ?>">
                                        <?= esc($model['kategori_models']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= esc($model['durasi']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-primary-dark">
                                    Rp. <?= number_format(esc($model['harga_models']), 0, ',', '.') ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="<?= site_url('admin/models/edit/' . esc($model['id_models'])) ?>" class="text-blue-600 hover:text-blue-900 mx-1" title="Edit">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <a href="<?= site_url('admin/models/delete/' . esc($model['id_models'])) ?>" onclick="return confirm('Anda yakin ingin menghapus model ini?')" class="text-red-600 hover:text-red-900 mx-1" title="Hapus">
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
    // Filter table logic
    function filterTable() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const kategori = document.getElementById('filterKategori').value;
        const table = document.getElementById('modelsTable');
        const rows = table.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            // Skip empty state row
            if (row.cells.length === 1) return;
            
            const text = row.innerText.toLowerCase();
            const kategoriText = row.querySelector('.px-2')?.innerText || '';
            
            let show = true;
            
            // Search filter
            if (search && !text.includes(search)) show = false;
            
            // Kategori filter
            if (kategori && kategoriText !== kategori) show = false;
            
            row.style.display = show ? '' : 'none';
        });
    }
</script>

<?php $this->endSection() ?>