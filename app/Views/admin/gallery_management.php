<?= $this->extend('layout/admin_template') ?>
<?= $this->section('gallery_management') ?>

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
            <i class="fa-solid fa-image mr-2"></i> Kelola Gallery
        </h2>
        <button id="btn-add-gallery" 
                class="px-4 py-2 bg-primary-dark text-white rounded-lg shadow-md hover:bg-nav-hover transition duration-200">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Foto Baru
        </button>
    </header>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold text-gray-700 mb-4 border-b pb-2">Daftar Foto Gallery</h3>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-card-info">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Gambar
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Deskripsi
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($gallery_items)): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                Belum ada data galeri yang ditambahkan.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($gallery_items as $item): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <?= esc($no++) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img 
                                    src="<?= base_url('uploads/gallery/' . esc($item['gambar_gallery'])) ?>" 
                                    alt="Gallery Image <?= esc($item['id_gallery']) ?>" 
                                    class="w-16 h-16 object-cover rounded shadow-md border border-nav-inactive"
                                    onerror="this.onerror=null; this.src='https://placehold.co/100x100/A3485A/FFFFFF?text=No+Img'">
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs overflow-hidden text-ellipsis">
                                <?= esc($item['deskripsi_gallery']) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 mx-1 btn-edit-gallery" 
                                    data-id="<?= esc($item['id_gallery']) ?>" 
                                    data-deskripsi="<?= esc($item['deskripsi_gallery']) ?>"
                                    title="Edit">
                                    <i class="fa-solid fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900 mx-1 btn-delete-gallery" 
                                    data-id="<?= esc($item['id_gallery']) ?>" 
                                    title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Tambah/Edit Gallery -->
<div id="gallery-modal-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div id="gallery-modal" class="bg-[#F3EFE9] w-full max-w-lg p-6 rounded-lg shadow-2xl relative border-2 border-primary-dark">
        
        <h3 id="modal-title" class="text-xl font-bold text-center mb-6 text-primary-dark border-b pb-2">
            Tambah Foto Gallery Baru
        </h3>

        <!-- ACTION form diarahkan ke Controller::saveGallery -->
        <form id="gallery-form" action="<?= site_url('admin/saveGallery') ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
            
            <input type="hidden" id="id_gallery" name="id_gallery" value="">
            
            <div>
                <label for="gambar_gallery" class="block text-sm font-medium text-gray-700 mb-1">Upload Gambar</label>
                <input type="file" id="gambar_gallery" name="gambar_gallery"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-nav-inactive file:text-primary-dark hover:file:bg-primary-dark hover:file:text-white"
                    accept="image/*">
                <!-- Preview Gambar (hanya untuk mode Edit) -->
                <div id="image-preview" class="mt-2 hidden">
                    <p class="text-xs text-gray-500 mb-1">Gambar saat ini:</p>
                    <img src="" id="current-image" class="w-24 h-24 object-cover rounded-md border border-gray-300">
                    <p id="image-note" class="text-xs text-red-500 mt-1 hidden">Kosongkan jika tidak ingin mengubah gambar.</p>
                </div>
            </div>

            <div>
                <label for="deskripsi_gallery" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea id="deskripsi_gallery_input" name="deskripsi_gallery" rows="3" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm bg-white" 
                    placeholder="Masukkan deskripsi untuk gambar galeri"></textarea>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" id="close-gallery-modal" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-200">
                    Batal
                </button>
                <button type="submit" id="submit-button" 
                    class="px-4 py-2 bg-primary-dark text-white rounded-lg hover:bg-nav-hover transition duration-200">
                    Simpan Data
                </button>
            </div>
        </form>

        <button type="button" id="close-modal-x" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 transition duration-150">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="delete-modal-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white w-full max-w-sm p-6 rounded-lg shadow-2xl relative border-2 border-red-500">
        <h3 class="text-xl font-bold text-red-600 mb-4 border-b pb-2">Konfirmasi Hapus</h3>
        <p class="text-gray-700 mb-6">Anda yakin ingin menghapus foto galeri ini? Aksi ini tidak dapat dibatalkan.</p>
        
        <div class="flex justify-end space-x-3">
            <button type="button" id="cancel-delete-modal" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                Batal
            </button>
            <a id="confirm-delete-button" href="#" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                Hapus Permanen
            </a>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalOverlay = document.getElementById('gallery-modal-overlay');
        const deleteModalOverlay = document.getElementById('delete-modal-overlay');
        const btnAdd = document.getElementById('btn-add-gallery');
        const btnClose = document.getElementById('close-gallery-modal');
        const btnCloseX = document.getElementById('close-modal-x');
        const modalTitle = document.getElementById('modal-title');
        const galleryForm = document.getElementById('gallery-form');
        const submitButton = document.getElementById('submit-button');
        
        const idInput = document.getElementById('id_gallery');
        const deskripsiInput = document.getElementById('deskripsi_gallery_input');
        const gambarInput = document.getElementById('gambar_gallery');
        const imagePreview = document.getElementById('image-preview');
        const currentImage = document.getElementById('current-image');
        const imageNote = document.getElementById('image-note');
        
        const confirmDeleteButton = document.getElementById('confirm-delete-button');
        const cancelDeleteButton = document.getElementById('cancel-delete-modal');

        function openModal(isEdit = false, data = {}) {
            galleryForm.reset();
            imagePreview.classList.add('hidden');
            idInput.value = '';

            if (isEdit) {
                modalTitle.textContent = 'Edit Foto Gallery (ID: ' + data.id + ')';
                submitButton.textContent = 'Update Data';
                
                // Isi field untuk Edit
                idInput.value = data.id;
                deskripsiInput.value = data.deskripsi;
                currentImage.src = data.image_url;
                
                imagePreview.classList.remove('hidden');
                imageNote.classList.remove('hidden');
                gambarInput.removeAttribute('required'); // Gambar tidak wajib diupdate
            } else {
                modalTitle.textContent = 'Tambah Foto Gallery Baru';
                submitButton.textContent = 'Simpan Data';
                
                imageNote.classList.add('hidden');
                gambarInput.setAttribute('required', 'required'); // Gambar wajib diupload
            }
            modalOverlay.classList.remove('hidden');
        }

        function closeModal() {
            modalOverlay.classList.add('hidden');
        }
        
        function closeDeleteModal() {
            deleteModalOverlay.classList.add('hidden');
        }

        // Event listener untuk tombol Tambah
        btnAdd.addEventListener('click', () => openModal(false));
        
        // Event listener untuk tombol Tutup modal
        btnClose.addEventListener('click', closeModal);
        btnCloseX.addEventListener('click', closeModal);
        cancelDeleteButton.addEventListener('click', closeDeleteModal);

        // Event listener untuk tombol Edit
        document.querySelectorAll('.btn-edit-gallery').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const deskripsi = this.getAttribute('data-deskripsi');
                // Asumsi URL gambar diambil dari baris tabel
                const imageUrl = this.closest('tr').querySelector('img').src; 

                const data = { 
                    id: id, 
                    deskripsi: deskripsi, 
                    image_url: imageUrl 
                };
                openModal(true, data);
            });
        });
        
        // Event listener untuk tombol Hapus
        document.querySelectorAll('.btn-delete-gallery').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const deleteUrl = '<?= site_url('admin/deleteGallery/') ?>' + id;
                confirmDeleteButton.href = deleteUrl;
                deleteModalOverlay.classList.remove('hidden');
            });
        });

    });
</script>

<?= $this->endSection() ?>