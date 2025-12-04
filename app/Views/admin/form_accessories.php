<?= $this->extend('layout/admin_template') ?>
<?= $this->section('accessories_management') ?>

<div class="p-8">
    <header class="bg-white p-4 rounded-lg shadow-md mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-primary-dark">
            <i class="fa-solid fa-box mr-2"></i> <?= ($action == 'add') ? 'Tambah Produk Baru' : 'Edit Produk' ?>
        </h2>
        <a href="<?= site_url('admin/accessories') ?>"
                class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow-md hover:bg-gray-600 transition duration-200">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
        </a>
    </header>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Gagal!</strong>
                <span class="block sm:inline"><?= session()->getFlashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('admin/accessories/save') ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <?= csrf_field() ?>
            
            <?php if ($action == 'edit'): ?>
                <input type="hidden" name="id_produk" value="<?= esc($accessory['id_produk']) ?>">
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Produk -->
                <div>
                    <label for="nama_produk" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama_produk" name="nama_produk" required
                        value="<?= ($action == 'edit') ? esc($accessory['nama_produk']) : old('nama_produk') ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-dark"
                        placeholder="Contoh: Nail Brush Premium">
                </div>

                <!-- Harga Produk -->
                <div>
                    <label for="harga_produk" class="block text-sm font-medium text-gray-700 mb-2">
                        Harga Produk (Rp) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="harga_produk" name="harga_produk" required min="0" step="0.01"
                        value="<?= ($action == 'edit') ? esc($accessory['harga_produk']) : old('harga_produk') ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-dark"
                        placeholder="50000">
                </div>

                <!-- Diskon -->
                <div>
                    <label for="diskon" class="block text-sm font-medium text-gray-700 mb-2">
                        Diskon (%)
                    </label>
                    <input type="number" id="diskon" name="diskon" min="0" max="100" step="0.01"
                        value="<?= ($action == 'edit') ? esc($accessory['diskon']) : old('diskon', 0) ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-dark"
                        placeholder="0">
                </div>

                <!-- Stok Tersedia -->
                <div>
                    <label for="stok_tersedia" class="block text-sm font-medium text-gray-700 mb-2">
                        Stok Tersedia <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="stok_tersedia" name="stok_tersedia" required min="0"
                        value="<?= ($action == 'edit') ? esc($accessory['stok_tersedia']) : old('stok_tersedia', 0) ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-dark"
                        placeholder="100">
                </div>
            </div>

            <!-- Gambar Produk -->
            <div>
                <label for="gambar_produk" class="block text-sm font-medium text-gray-700 mb-2">
                    Gambar Produk <?= ($action == 'add') ? '<span class="text-red-500">*</span>' : '' ?>
                </label>
                <input type="file" id="gambar_produk" name="gambar_produk" accept="image/*"
                    <?= ($action == 'add') ? 'required' : '' ?>
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-nav-inactive file:text-primary-dark hover:file:bg-primary-dark hover:file:text-white">
                
                <?php if ($action == 'edit' && !empty($accessory['gambar_produk'])): ?>
                    <div class="mt-3">
                        <p class="text-xs text-gray-500 mb-2">Gambar saat ini:</p>
                        <img src="<?= base_url('uploads/accessories/' . esc($accessory['gambar_produk'])) ?>" 
                            alt="Current Image" 
                            class="w-32 h-32 object-cover rounded-md border border-gray-300">
                        <p class="text-xs text-red-500 mt-1">Kosongkan jika tidak ingin mengubah gambar.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Deskripsi Produk -->
            <div>
                <label for="deskripsi_produk" class="block text-sm font-medium text-gray-700 mb-2">
                    Deskripsi Produk
                </label>
                <textarea id="deskripsi_produk" name="deskripsi_produk" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-dark"
                    placeholder="Masukkan deskripsi produk..."><?= ($action == 'edit') ? esc($accessory['deskripsi_produk']) : old('deskripsi_produk') ?></textarea>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end space-x-3 pt-4 border-t">
                <a href="<?= site_url('admin/accessories') ?>" 
                    class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-200">
                    Batal
                </a>
                <button type="submit" 
                    class="px-6 py-2 bg-primary-dark text-white rounded-lg hover:bg-nav-hover transition duration-200">
                    <i class="fa-solid fa-save mr-2"></i> <?= ($action == 'add') ? 'Simpan Produk' : 'Update Produk' ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
