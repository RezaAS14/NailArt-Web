<?= $this->extend('layout/template') ?>
<?= $this->section('detail_base_coat') ?>
    <main class="max-w-7xl mx-auto py-6 px-4">
        <div class="w-full mb-6">
            <div class="header-line"></div>
            <h2 class="text-3xl font-inika text-center py-4 text-black">
                PRODUCT DETAIL
            </h2>
            <div class="header-line"></div>
        </div>

        <div class="detail-card">
            <span class="discount-badge-detail">50%</span>
            
            <a href="<?= site_url('accessories') ?>" class="back-button" aria-label="Kembali ke Accessories">
                <i class="fa-solid fa-arrow-turn-up fa-rotate-270"></i> 
            </a>

            <div class="flex flex-col md:flex-row gap-8 items-start">
                
                <div class="product-detail-image-container flex-shrink-0">
                    <img src="<?= base_url('assets/base-coat.png') ?>" alt="Base Coat" class="rounded-lg">
                    <button class="add-to-cart-button-detail" aria-label="Tambah ke keranjang">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>

                <div class="flex-grow">
                    <h1 class="text-3xl font-inika text-black mb-2">Base Coat</h1>
                    
                    <div class="flex items-baseline mb-4">
                        <p class="text-2xl font-bold text-primary-dark font-inika mr-3">Rp 39.480</p>
                        <p class="text-base text-gray-500 line-through font-inika">Rp78.960</p>
                    </div>

                    <h3 class="text-lg font-bold font-inika text-black mb-2 mt-6">Description</h3>
                    <p class="text-base font-inika text-gray-700 leading-relaxed text-justify">
                        Base coat adalah lapisan dasar yang diaplikasikan sebelum cat kuku untuk melindungi permukaan kuku dan meningkatkan daya rekat nail polish. Produk ini membantu mencegah pewarnaan kuku menjadi kusam atau menguning, sekaligus membuat hasil cat kuku lebih halus, rata, dan tahan lama. Dengan penggunaan base coat, manicure menjadi lebih rapi dan kuku tetap terlindungi dari kerusakan.
                    </p>
                </div>
            </div>
        </div>
    </main>
<?= $this->endSection() ?>