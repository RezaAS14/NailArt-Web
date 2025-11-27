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
            
            <button class="px-6 py-1 rounded-full shadow font-inika category-button text-sm" data-category="medium" style="background-color: #E6CFA9; color: black;">Medium</button>
            
            <button class="px-6 py-1 rounded-full shadow font-inika category-button text-sm" data-category="hard" style="background-color: #E6CFA9; color: black;">Hard</button>
        </div>

        <div class="max-w-7xl mx-auto grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6" id="design-gallery">

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card easy">
                <div class="overflow-hidden rounded-t-xl"> <img src="<?= base_url('assets/nail_art_1.jpg') ?>" alt="Nail Art Design 1" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl"> <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.70.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card easy">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_2.png') ?>" alt="Nail Art Design 2" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.65.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card easy">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_3.png') ?>" alt="Nail Art Design 3" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.65.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card easy">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_4.png') ?>" alt="Nail Art Design 4" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.65.000,00</p>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card easy"> 
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_5.png') ?>" alt="Nail Art Design 5" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.65.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card easy">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_6.png') ?>" alt="Nail Art Design 6" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.65.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card easy">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_7.png') ?>" alt="Nail Art Design 7" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.65.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card easy">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_8.png') ?>" alt="Nail Art Design 8" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.70.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card easy">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_9.png') ?>" alt="Nail Art Design 9" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.65.000,00</p>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card easy"> 
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_10.png') ?>" alt="Nail Art Design 10" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.65.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card medium">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_11.jpg') ?>" alt="Nail Art Design 11" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1,5 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.120.000,00</p>
                    </div>
                </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card medium"> 
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_12.png') ?>" alt="Nail Art Design 12" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1,5 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.90.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card medium">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_13.png') ?>" alt="Nail Art Design 13" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1,5 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.90.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card medium">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_14.png') ?>" alt="Nail Art Design 14" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1,5 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.120.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card medium">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_15.png') ?>" alt="Nail Art Design 15" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1,5 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.120.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card medium">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_16.png') ?>" alt="Nail Art Design 16" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1,5 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.100.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card medium">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_17.png') ?>" alt="Nail Art Design 17" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1,5 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.90.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card medium">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_18.png') ?>" alt="Nail Art Design 18" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1,5 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.100.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card medium">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_19.png') ?>" alt="Nail Art Design 19" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1,5 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.100.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card medium">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_20.png') ?>" alt="Nail Art Design 20" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 1,5 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.100.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card hard">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_21.png') ?>" alt="Nail Art Design 21" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 2,3 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.160.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card hard">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_22.png') ?>" alt="Nail Art Design 22" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 2,3 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.160.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card hard">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_23.png') ?>" alt="Nail Art Design 23" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 2,3 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.160.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card hard">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_24.png') ?>" alt="Nail Art Design 24" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 2,3 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.160.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card hard">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_25.png') ?>" alt="Nail Art Design 25" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 2,3 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.160.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card hard">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_26.png') ?>" alt="Nail Art Design 26" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 5 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.250.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card hard">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_27.png') ?>" alt="Nail Art Design 27" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 2 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.150.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card hard">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_28.png') ?>" alt="Nail Art Design 28" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 3 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.180.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card hard">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_29.png') ?>" alt="Nail Art Design 29" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 2,3 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.160.000,00</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden group design-card hard">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="<?= base_url('assets/nail_art_30.png') ?>" alt="Nail Art Design 30" class="w-full h-48 object-cover transform transition duration-300 group-hover:scale-105">
                </div>
                <div class="bg-card-info p-3 text-center rounded-b-xl">
                    <p class="font-inika text-xs text-black">Kisaran Pengerjaan : 2,3 Jam</p>
                    <p class="font-inika text-sm font-bold text-black">Harga : Rp.170.000,00</p>
                </div>
            </div>

        </div>
    </section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryButtons = document.querySelectorAll('.category-button');
        const designCards = document.querySelectorAll('.design-card');
        
        // 1. Tambahkan CSS untuk menyembunyikan/menampilkan kartu
        const style = document.createElement('style');
        style.textContent = `
            .design-card {
                display: none; /* Sembunyikan semua secara default */
            }
            .design-card.active-display {
                display: block; /* Tampilkan yang aktif */
                /* Karena container menggunakan grid, display: block akan membuatnya tetap mengikuti flow grid */
            }
        `;
        document.head.appendChild(style);

        /**
         * Mengaktifkan tombol kategori yang diklik dan memperbarui tampilan kartu desain.
         * @param {string} category - Kategori yang akan ditampilkan (e.g., 'easy', 'medium', 'hard').
         */
        function filterDesigns(category) {
            const activeBg = '#A3485A'; // primary-dark
            const inactiveBg = '#E6CFA9'; // testing-bg

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
                button.style.backgroundColor = '#E6CFA9'; // testing-bg
                button.style.color = 'black'; 
            }
        });

        // Tampilkan kategori 'easy' saat halaman dimuat (default)
        filterDesigns('easy'); 
    });
</script>
<?= $this->endSection() ?>