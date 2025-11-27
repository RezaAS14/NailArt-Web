<?= $this->extend('layout/template') ?>
<?= $this->section('detail_nail_file') ?>
    <main class="max-w-7xl mx-auto py-6 px-4">
        <div class="w-full mb-6">
            <div class="header-line"></div>
            <h2 class="text-3xl font-inika text-center py-4 text-black">
                PRODUCT DETAIL
            </h2>
            <div class="header-line"></div>
        </div>

        <div class="detail-card">
            <span class="discount-badge-detail">12%</span>
            
            <a href="<?= site_url('accessories') ?>" class="back-button" aria-label="Kembali ke Accessories">
                <i class="fa-solid fa-arrow-turn-up fa-rotate-270"></i> 
            </a>

            <div class="flex flex-col md:flex-row gap-8 items-start">
                
                <div class="product-detail-image-container flex-shrink-0">
                    <img src="<?= base_url('assets/nail-file.png') ?>" alt="Nail File" class="rounded-lg">
                    <button class="add-to-cart-button-detail" aria-label="Tambah ke keranjang">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>

                <div class="flex-grow">
                    <h1 class="text-3xl font-inika text-black mb-2">Nail File</h1>
                    
                    <div class="flex items-baseline mb-4">
                        <p class="text-2xl font-bold text-primary-dark font-inika mr-3">Rp 10.900</p>
                        <p class="text-base text-gray-500 line-through font-inika">Rp 90.800</p>
                    </div>

                    <h3 class="text-lg font-bold font-inika text-black mb-2 mt-6">Description</h3>
                    <p class="text-base font-inika text-gray-700 leading-relaxed text-justify">
                        Nail file adalah alat perawatan kuku yang digunakan untuk membentuk, merapikan, dan menghaluskan ujung kuku agar tampak rapi dan bersih. Alat ini biasanya terbuat dari bahan seperti kertas amplas halus, kaca, logam, atau kristal, dan sering digunakan dalam perawatan manicure maupun pedicure. Dengan teksturnya yang abrasif, nail file membantu menghilangkan bagian kuku yang kasar atau tidak rata sehingga menghasilkan bentuk kuku yang lebih estetik dan nyaman.
                    </p>
                </div>
            </div>
        </div>
    </main>
<?= $this->endSection() ?>