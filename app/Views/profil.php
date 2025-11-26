<?= $this->extend('layout/template') ?>
<?= $this->section('profil') ?>
    <main class="py-16 flex justify-center items-start">
        <div class="max-w-4xl w-full px-6">
            
            <a href="#" class="text-primary-dark text-4xl mb-8 inline-block hover:text-nav-hover transition duration-200" aria-label="Kembali ke halaman sebelumnya">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <div class="bg-profile-card p-10 rounded-xl shadow-2xl flex flex-col md:flex-row items-center md:items-start gap-10 border border-nav-inactive/50 noise-shape"
                 style="box-shadow: 0 10px 15px -3px rgba(163, 72, 90, 0.5), 0 4px 6px -2px rgba(163, 72, 90, 0.05);">

                <div class="flex-shrink-0 flex flex-col items-center">
                    <img id="profileImage" src="<?= base_url('assets/default_profile.png') ?>" alt="Foto Profil Pengguna" 
                         class="w-48 h-48 md:w-60 md:h-60 rounded-xl object-cover shadow-xl border-4 border-white/80 transform hover:scale-105 transition duration-500" 
                         style="box-shadow: 0 10px 15px -3px rgba(163, 72, 90, 0.5), 0 4px 6px -2px rgba(163, 72, 90, 0.05);" />
                    
                    <input type="file" id="imageUpload" accept="image/*" class="hidden">
                    
                    <button type="button" id="changePhotoButton" class="mt-4 px-4 py-1 bg-nav-inactive text-white text-sm rounded-full shadow-md hover:bg-primary-dark transition duration-300 font-semibold">
                        Ubah Foto
                    </button>
                </div>

                <form class="flex-grow w-full space-y-6">
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
                                placeholder="Masukkan Nama Depan Anda" value="Rezeki">
                        </div>
                        
                        <div class="flex-1">
                            <label for="nama_belakang" class="text-sm font-inika text-gray-500 mb-1 block">
                                Nama Belakang
                            </label>
                            <input type="text" id="nama_belakang" name="nama_belakang"
                                class="input-placeholder-style w-full text-lg"
                                placeholder="Masukkan Nama Belakang Anda" value="Nauli">
                        </div>
                    </div>

                    <div>
                        <label for="username" class="text-sm font-inika text-gray-500 mb-1 block">
                            Username
                        </label>
                        <input type="text" id="username" name="username"
                            class="input-placeholder-style w-full text-lg"
                            placeholder="Buat Username" value="User_Rena_NailArt">
                    </div>

                    <div>
                        <label for="email" class="text-sm font-inika text-gray-500 mb-1 block">
                            Email
                        </label>
                        <input type="email" id="email" name="email"
                            class="input-placeholder-style w-full text-lg"
                            placeholder="cth: namaanda@email.com" value="rena.nauli@example.com">
                    </div>
                    
                    <div>
                        <label for="tanggal_lahir" class="text-sm font-inika text-gray-500 mb-1 block">
                            Tanggal Lahir
                        </label>
                        <div class="relative">
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                class="input-placeholder-style w-full text-lg"
                                value="1995-04-01">
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
                                placeholder="cth: 81234567890" value="81234567890">
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-nav-inactive flex justify-end space-x-4">
                        <button type="button" class="px-6 py-2 bg-nav-inactive text-white rounded-full shadow-md hover:bg-gray-700 transition duration-300 text-base font-semibold">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2 bg-nav-hover text-white rounded-full shadow-md hover:bg-primary-dark transition duration-300 text-base font-semibold">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </main>
<?= $this->endSection() ?>