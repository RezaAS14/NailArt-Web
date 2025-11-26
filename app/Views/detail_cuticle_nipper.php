<?= $this->extend('layout/template') ?>
<?= $this->section('detail_cuticle_nipper') ?>
    <main class="max-w-7xl mx-auto py-6 px-4">
        <div class="w-full mb-6">
            <div class="header-line"></div>
            <h2 class="text-3xl font-inika text-center py-4 text-black">
                PRODUCT DETAIL
            </h2>
            <div class="header-line"></div>
        </div>

        <div class="detail-card">
            <span class="discount-badge-detail">20%</span>
            
            <a href="<?= site_url('accessories') ?>" class="back-button" aria-label="Kembali ke Accessories">
                <i class="fa-solid fa-arrow-turn-up fa-rotate-270"></i> 
            </a>

            <div class="flex flex-col md:flex-row gap-8 items-start">
                
                <div class="product-detail-image-container flex-shrink-0">
                    <img src="<?= base_url('assets/cuticle-nipper.png') ?>" alt="Cuticle Nipper" class="rounded-lg">
                    <button class="add-to-cart-button-detail" aria-label="Tambah ke keranjang">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>

                <div class="flex-grow">
                    <h1 class="text-3xl font-inika text-black mb-2">Cuticle Nipper</h1>
                    
                    <div class="flex items-baseline mb-4">
                        <p class="text-2xl font-bold text-primary-dark font-inika mr-3">Rp 92.000</p>
                        <p class="text-base text-gray-500 line-through font-inika">Rp115.000</p>
                    </div>

                    <h3 class="text-lg font-bold font-inika text-black mb-2 mt-6">Description</h3>
                    <p class="text-base font-inika text-gray-700 leading-relaxed text-justify">
                        Cuticle nipper adalah alat perawatan kuku berbentuk tang kecil yang digunakan untuk memotong kutikula berlebih, kulit mati, maupun hangnail di sekitar pangkal kuku. Alat ini umumnya terbuat dari stainless steel dengan ujung yang tajam dan presisi, sehingga mampu membersihkan area kutikula dengan rapi tanpa merusak kulit sehat. Cuticle nipper membantu membuat kuku tampak lebih bersih, halus, dan siap untuk proses manicure atau pedicure.
                    </p>
                </div>
            </div>
        </div>
    </main>
<?= $this->endSection() ?>