<?= $this->extend('layout/template') ?>
<?= $this->section('profil') ?>
<?php
    // Cek apakah user sudah login
    if (!session()->get('logged_in')) {
        return redirect()->to(site_url('/'))->with('login_error', 'Silakan login terlebih dahulu');
    }
    
    // Ambil data user dari variable yang dikirim controller
    $user = $userData ?? [];
    
    // Set default values
    $profileImage = !empty($user['gambar_user']) ? base_url('uploads/users/' . $user['gambar_user']) : base_url('assets/default_profile.png');
?>
    <main class="py-16 flex justify-center items-start">
        <div class="max-w-4xl w-full px-6">
            
            <a href="<?= previous_url() ?? site_url('/') ?>" class="text-primary-dark text-4xl mb-8 inline-block hover:text-nav-hover transition duration-200" aria-label="Kembali ke halaman sebelumnya">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <div class="bg-profile-card p-10 rounded-xl shadow-2xl flex flex-col md:flex-row items-center md:items-start gap-10 border border-nav-inactive/50 noise-shape"
                 style="box-shadow: 0 10px 15px -3px rgba(163, 72, 90, 0.5), 0 4px 6px -2px rgba(163, 72, 90, 0.05);">

                <div class="flex-shrink-0 flex flex-col items-center">
                    <img id="profileImage" src="<?= $profileImage ?>" alt="Foto Profil Pengguna" 
                         class="w-48 h-48 md:w-60 md:h-60 rounded-xl object-cover shadow-xl border-4 border-white/80 transform hover:scale-105 transition duration-500" 
                         style="box-shadow: 0 10px 15px -3px rgba(163, 72, 90, 0.5), 0 4px 6px -2px rgba(163, 72, 90, 0.05);" />
                    
                    <button type="button" id="changePhotoButton" class="mt-4 px-4 py-1 bg-nav-inactive text-white text-sm rounded-full shadow-md hover:bg-primary-dark transition duration-300 font-semibold">
                        Ubah Foto
                    </button>
                </div>

                <form id="profileForm" action="<?= site_url('profil/update') ?>" method="POST" enctype="multipart/form-data" class="flex-grow w-full space-y-6">
                    <?= csrf_field() ?>
                    <input type="hidden" id="profileImageChanged" name="profile_image_changed" value="0">
                    <input type="file" id="imageUploadHidden" name="imageUpload" accept="image/*" class="hidden">
                    <h1 class="text-4xl font-kapakana text-primary-dark mb-6 border-b pb-2 border-nav-inactive">
                        Edit Profile
                    </h1>
                    
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label for="nama_depan" class="text-sm font-inika text-gray-500 mb-1 block">
                                Nama Depan
                            </label>
                            <input type="text" id="nama_depan" name="nama_depan"
                                class="input-placeholder-style w-full text-lg"
                                placeholder="Masukkan Nama Depan Anda" 
                                value="<?= esc($user['nama_depan'] ?? '') ?>" required>
                        </div>
                        
                        <div class="flex-1">
                            <label for="nama_belakang" class="text-sm font-inika text-gray-500 mb-1 block">
                                Nama Belakang
                            </label>
                            <input type="text" id="nama_belakang" name="nama_belakang"
                                class="input-placeholder-style w-full text-lg"
                                placeholder="Masukkan Nama Belakang Anda" 
                                value="<?= esc($user['nama_belakang'] ?? '') ?>">
                        </div>
                    </div>

                    <div>
                        <label for="username" class="text-sm font-inika text-gray-500 mb-1 block">
                            Username
                        </label>
                        <input type="text" id="username" name="username"
                            class="input-placeholder-style w-full text-lg bg-gray-100"
                            placeholder="Buat Username" 
                            value="<?= esc($user['username'] ?? '') ?>" readonly>
                    </div>

                    <div>
                        <label for="email" class="text-sm font-inika text-gray-500 mb-1 block">
                            Email
                        </label>
                        <input type="email" id="email" name="email"
                            class="input-placeholder-style w-full text-lg bg-gray-100"
                            placeholder="cth: namaanda@email.com" 
                            value="<?= esc($user['email'] ?? '') ?>" readonly>
                    </div>
                    
                    <div>
                        <label for="tanggal_lahir" class="text-sm font-inika text-gray-500 mb-1 block">
                            Tanggal Lahir
                        </label>
                        <div class="relative">
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                class="input-placeholder-style w-full text-lg"
                                value="<?= esc($user['tanggal_lahir'] ?? '') ?>">
                            <i class="fa-solid fa-calendar-days absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
                        </div>
                    </div>
                    
                    <div>
                        <label for="handphone" class="text-sm font-inika text-gray-500 mb-1 block">
                            Nomor Handphone
                        </label>
                        <div class="flex">
                            <span class="input-prefix-style flex items-center text-lg font-semibold">
                                +62
                            </span>
                            <input type="tel" id="handphone" name="handphone"
                                class="input-placeholder-style input-main-style flex-1 text-lg"
                                placeholder="cth: 81234567890" 
                                value="<?= esc($user['no_telp'] ?? '') ?>">
                        </div>
                    </div>
                    
                    <div>
                        <label for="alamat" class="text-sm font-inika text-gray-500 mb-1 block">
                            Alamat
                        </label>
                        <textarea id="alamat" name="alamat"
                            class="input-placeholder-style input-main-style w-full text-lg resize-none"
                            placeholder="Masukkan alamat lengkap Anda"
                            rows="3"><?= esc($user['alamat'] ?? '') ?></textarea>
                    </div>

                    <div class="mt-8 pt-6 border-t border-nav-inactive flex justify-end space-x-4">
                        <button type="button" id="cancelButton" class="px-6 py-2 bg-nav-inactive text-white rounded-full shadow-md hover:bg-gray-700 transition duration-300 text-base font-semibold">
                            Batal
                        </button>
                        <button type="submit" id="saveButton" class="px-6 py-2 bg-nav-hover text-white rounded-full shadow-md hover:bg-primary-dark transition duration-300 text-base font-semibold">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const changePhotoButton = document.getElementById('changePhotoButton');
            const imageUpload = document.getElementById('imageUploadHidden');
            const profileImage = document.getElementById('profileImage');
            const profileImageChanged = document.getElementById('profileImageChanged');
            const cancelButton = document.getElementById('cancelButton');
            const profileForm = document.getElementById('profileForm');
            let originalImageSrc = profileImage.src;

            // Handle photo upload
            changePhotoButton.addEventListener('click', function() {
                imageUpload.click();
            });

            imageUpload.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Validasi file
                    const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                    const maxSize = 2 * 1024 * 1024; // 2MB

                    if (!validTypes.includes(file.type)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Format File Tidak Didukung',
                            text: 'Silakan upload file gambar (JPG, PNG, GIF, atau WEBP).',
                            confirmButtonColor: '#A3485A'
                        });
                        return;
                    }

                    if (file.size > maxSize) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ukuran File Terlalu Besar',
                            text: 'Maksimal ukuran file adalah 2MB.',
                            confirmButtonColor: '#A3485A'
                        });
                        return;
                    }

                    // Preview gambar
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        profileImage.src = event.target.result;
                        profileImageChanged.value = '1';
                        
                        // Tampilkan preview dengan toast
                        Swal.fire({
                            icon: 'success',
                            title: 'Gambar Dipilih',
                            text: 'Klik "Simpan Perubahan" untuk mengupdate foto profil Anda.',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Handle cancel button
            cancelButton.addEventListener('click', function() {
                Swal.fire({
                    title: 'Batalkan Perubahan?',
                    text: 'Semua perubahan yang belum disimpan akan hilang.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#A3485A',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Batalkan',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Reset form dan gambar
                        profileForm.reset();
                        profileImage.src = originalImageSrc;
                        profileImageChanged.value = '0';
                        window.location.href = '<?= previous_url() ?? site_url('/') ?>';
                    }
                });
            });

            // Handle form submission
            profileForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Simpan Perubahan?',
                    text: 'Data profil Anda akan diperbarui.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#A3485A',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Simpan',
                    cancelButtonText: 'Batal',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Tampilkan loading
                        Swal.fire({
                            title: 'Menyimpan...',
                            html: 'Mohon tunggu sementara data Anda diperbarui.',
                            icon: 'info',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Submit form
                        profileForm.submit();
                    }
                });
            });
        });
    </script>

    <?php if (session()->getFlashdata('login_success_message')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Login Berhasil!',
                    html: '<p class="text-lg">Selamat datang <strong><?= session()->getFlashdata('username') ?></strong></p>',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#A3485A',
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('profile_success')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: '<?= session()->getFlashdata('profile_success') ?>',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#A3485A',
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('profile_error')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Gagal!',
                    text: '<?= session()->getFlashdata('profile_error') ?>',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#A3485A'
                });
            });
        </script>
    <?php endif; ?>
<?= $this->endSection() ?>