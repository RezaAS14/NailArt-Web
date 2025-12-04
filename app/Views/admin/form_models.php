<?= $this->extend('layout/admin_template') ?>
<?= $this->section('models_management') ?>

<div class="p-8">
    <header class="bg-white p-4 rounded-lg shadow-md mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-primary-dark">
            <i class="fa-solid fa-palette mr-2"></i> <?= ($action == 'add') ? 'Tambah Model Baru' : 'Edit Model' ?>
        </h2>
        <a href="<?= site_url('admin/models') ?>"
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

        <form action="<?= site_url('admin/models/save') ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <?= csrf_field() ?>
            
            <?php if ($action == 'edit'): ?>
                <input type="hidden" name="id_models" value="<?= esc($model['id_models']) ?>">
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kategori Models -->
                <div>
                    <label for="kategori_models" class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori Model <span class="text-red-500">*</span>
                    </label>
                    <select id="kategori_models" name="kategori_models" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-dark">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Easy" <?= ($action == 'edit' && $model['kategori_models'] == 'Easy') ? 'selected' : '' ?>>Easy</option>
                        <option value="Medium" <?= ($action == 'edit' && $model['kategori_models'] == 'Medium') ? 'selected' : '' ?>>Medium</option>
                        <option value="Hard" <?= ($action == 'edit' && $model['kategori_models'] == 'Hard') ? 'selected' : '' ?>>Hard</option>
                    </select>
                </div>

                <!-- Durasi -->
                <div>
                    <label for="durasi" class="block text-sm font-medium text-gray-700 mb-2">
                        Durasi (Jam) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="durasi" name="durasi" required min="0" step="0.01"
                        value="<?= ($action == 'edit') ? esc($model['durasi']) : old('durasi') ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-dark"
                        placeholder="1.5">
                </div>

                <!-- Harga Models -->
                <div>
                    <label for="harga_models" class="block text-sm font-medium text-gray-700 mb-2">
                        Harga Model (Rp) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="harga_models" name="harga_models" required min="0" step="0.01"
                        value="<?= ($action == 'edit') ? esc($model['harga_models']) : old('harga_models') ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-dark"
                        placeholder="150000">
                </div>
            </div>

            <!-- Gambar Models -->
            <div>
                <label for="gambar_models" class="block text-sm font-medium text-gray-700 mb-2">
                    Gambar Model <?= ($action == 'add') ? '<span class="text-red-500">*</span>' : '' ?>
                </label>
                <input type="file" id="gambar_models" name="gambar_models" accept="image/*"
                    <?= ($action == 'add') ? 'required' : '' ?>
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-nav-inactive file:text-primary-dark hover:file:bg-primary-dark hover:file:text-white">
                
                <?php if ($action == 'edit' && !empty($model['gambar_models'])): ?>
                    <div class="mt-3">
                        <p class="text-xs text-gray-500 mb-2">Gambar saat ini:</p>
                        <img src="<?= base_url('uploads/models/' . esc($model['gambar_models'])) ?>" 
                            alt="Current Image" 
                            class="w-32 h-32 object-cover rounded-md border border-gray-300">
                        <p class="text-xs text-red-500 mt-1">Kosongkan jika tidak ingin mengubah gambar.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end space-x-3 pt-4 border-t">
                <a href="<?= site_url('admin/models') ?>" 
                    class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-200">
                    Batal
                </a>
                <button type="submit" 
                    class="px-6 py-2 bg-primary-dark text-white rounded-lg hover:bg-nav-hover transition duration-200">
                    <i class="fa-solid fa-save mr-2"></i> <?= ($action == 'add') ? 'Simpan Model' : 'Update Model' ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
