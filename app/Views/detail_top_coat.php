<?= $this->extend('layout/template') ?>
<?= $this->section('detail_top_coat') ?>
    <main class="max-w-7xl mx-auto py-6 px-4">
        <div class="w-full mb-6">
            <div class="header-line"></div>
            <h2 class="text-3xl font-inika text-center py-4 text-black">
                PRODUCT DETAIL
            </h2>
            <div class="header-line"></div>
        </div>

        <div class="detail-card">
            <span class="discount-badge-detail">80%</span>
            
            <a href="<?= site_url('accessories') ?>" class="back-button" aria-label="Kembali ke Accessories">
                <i class="fa-solid fa-arrow-turn-up fa-rotate-270"></i> 
            </a>

            <div class="flex flex-col md:flex-row gap-8 items-start">
                
                <div class="product-detail-image-container flex-shrink-0">
                    <img src="<?= base_url('assets/top-coat.png') ?>" alt="Top Coat" class="rounded-lg">
                    <button class="add-to-cart-button-detail" aria-label="Tambah ke keranjang">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>

                <div class="flex-grow">
                    <h1 class="text-3xl font-inika text-black mb-2">Top Coat</h1>
                    
                    <div class="flex items-baseline mb-4">
                        <p class="text-2xl font-bold text-primary-dark font-inika mr-3">Rp 29.046</p>
                        <p class="text-base text-gray-500 line-through font-inika">Rp149.950</p>
                    </div>

                    <h3 class="text-lg font-bold font-inika text-black mb-2 mt-6">Description</h3>
                    <p class="text-base font-inika text-gray-700 leading-relaxed text-justify">
                        Top coat adalah lapisan akhir yang diaplikasikan di atas cat kuku untuk memberikan perlindungan ekstra sekaligus menambah kilau pada hasil manicure. Produk ini membantu mencegah cat kuku mudah terkelupas, menggores, atau pudar, sehingga warna tetap terlihat segar dan tahan lebih lama. Dengan top coat, hasil akhir kuku tampak lebih rapi, berkilau, dan profesional.
                    </p>
                </div>
            </div>
        </div>
    </main>
<?= $this->endSection() ?>