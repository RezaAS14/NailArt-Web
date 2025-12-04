<?= $this->extend('layout/template') ?>
<?= $this->section('models') ?>
    <section class="w-full bg-[#FEF3E2] py-10 px-6"> 

        <h1 class="text-center font-inika text-3xl text-black mb-3">
            Costum Design
        </h1>

        <p class="text-center text-black mb-6 dotted-line">
            *******************************************************************************************************************************************************************************************
        </p>

        <div class="flex justify-center gap-4 mb-10" id="category-buttons">
            <button class="px-6 py-1 rounded-full shadow font-inika category-button active text-sm" data-category="easy" style="background-color: #A3485A; color: white;">Easy</button>
            
            <button class="px-6 py-1 rounded-full shadow font-inika category-button text-sm" data-category="medium" style="background-color: #DDDEAB; color: black;">Medium</button>
            
            <button class="px-6 py-1 rounded-full shadow font-inika category-button text-sm" data-category="hard" style="background-color: #DDDEAB; color: black;">Hard</button>
        </div>

        <div class="max-w-7xl mx-auto grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6" id="design-gallery">

            <?php if (empty($models)): ?>
                <div class="col-span-full text-center py-10">
                    <p class="text-gray-500 text-lg">Belum ada desain model tersedia.</p>
                </div>
            <?php else: ?>
                <?php foreach ($models as $model): ?>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card <?= strtolower(esc($model['kategori_models'])) ?>">
                        <div class="overflow-hidden rounded-t-xl">
                            <img src="<?= base_url('uploads/models/' . esc($model['gambar_models'])) ?>" 
                                 alt="<?= esc($model['kategori_models']) ?> Design" 
                                 class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105"
                                 onerror="this.src='<?= base_url('assets/placeholder.png') ?>'">
                        </div>
                        <div class="bg-card-info p-3 text-center rounded-b-xl">
                            <p class="font-inika text-xs text-black">
                                Kisaran Pengerjaan : <?= esc($model['durasi']) ?> Jam
                            </p>
                               <p class="font-inika text-xs mt-1">
                                   Harga: <span class="font-black">Rp. <?= number_format($model['harga_models'], 0, ',', '.') ?></span>
                               </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryButtons = document.querySelectorAll('.category-button');
        const designCards = document.querySelectorAll('.design-card');
        
        // 1. Tambahkan CSS untuk menyembunyikan/menampilkan kartu dan hover effect
        const style = document.createElement('style');
        style.textContent = `
            .design-card {
                display: none; /* Sembunyikan semua secara default */
            }
            .design-card.active-display {
                display: block; /* Tampilkan yang aktif */
                /* Karena container menggunakan grid, display: block akan membuatnya tetap mengikuti flow grid */
            }
            .category-button {
                transition: background-color 0.3s ease, color 0.3s ease;
            }
            .category-button:hover {
                background-color: #A3485A !important;
                color: white !important;
            }
        `;
        document.head.appendChild(style);

        /**
         * Mengaktifkan tombol kategori yang diklik dan memperbarui tampilan kartu desain.
         * @param {string} category - Kategori yang akan ditampilkan (e.g., 'easy', 'medium', 'hard').
         */
        function filterDesigns(category) {
            const activeBg = '#A3485A'; // primary-dark
            const inactiveBg = '#DDDEAB'; // inactive background

            // 1. Perbarui status tombol aktif
            categoryButtons.forEach(button => {
                if (button.getAttribute('data-category') === category) {
                    button.classList.add('active');
                    // Set warna aktif (Merah/Primary Dark)
                    button.style.backgroundColor = activeBg; 
                    button.style.color = 'white'; 
                } else {
                    button.classList.remove('active');
                    // Set warna tidak aktif (Krem/Testing BG)
                    button.style.backgroundColor = inactiveBg; 
                    button.style.color = 'black'; 
                }
            });

            // 2. Tampilkan/Sembunyikan kartu desain
            designCards.forEach(card => {
                card.classList.remove('active-display'); // Sembunyikan dulu
                if (card.classList.contains(category)) {
                    card.classList.add('active-display'); // Tampilkan yang sesuai
                }
            });
        }

        // Tambahkan event listener ke setiap tombol kategori
        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                const category = this.getAttribute('data-category');
                filterDesigns(category);
            });
            
            // Set warna awal (sudah dilakukan di HTML dengan inline style, tapi lebih baik di sini)
            if (button.classList.contains('active')) {
                button.style.backgroundColor = '#A3485A'; // primary-dark
                button.style.color = 'white'; 
            } else {
                button.style.backgroundColor = '#DDDEAB'; // inactive background
                button.style.color = 'black'; 
            }
        });

        // Tampilkan kategori 'easy' saat halaman dimuat (default)
        filterDesigns('easy'); 
    });
</script>
<?= $this->endSection() ?>