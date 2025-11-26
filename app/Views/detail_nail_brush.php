<?= $this->extend('layout/template') ?>
<?= $this->section('detail_nail_brush') ?>
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
                    <img src="<?= base_url('assets/nail-brush.png') ?>" alt="Nail Brush" class="rounded-lg">
                    <button class="add-to-cart-button-detail" aria-label="Tambah ke keranjang">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>

                <div class="flex-grow">
                    <h1 class="text-3xl font-inika text-black mb-2">Nail Brush</h1>
                    
                    <div class="flex items-baseline mb-4">
                        <p class="text-2xl font-bold text-primary-dark font-inika mr-3">Rp 29.000</p>
                        <p class="text-base text-gray-500 line-through font-inika">Rp58.000</p>
                    </div>

                    <h3 class="text-lg font-bold font-inika text-black mb-2 mt-6">Description</h3>
                    <p class="text-base font-inika text-gray-700 leading-relaxed text-justify">
                        Nail brush adalah sikat kecil yang digunakan untuk membersihkan kuku dan area sekitarnya dari kotoran, debu, dan sisa-sisa produk perawatan. Dengan bulu sikat yang lembut namun efektif, alat ini membantu menjaga kebersihan kuku sebelum dan sesudah manicure atau pedicure. Nail brush juga berguna untuk membersihkan permukaan kuku agar lebih siap menerima produk seperti base coat atau nail polish, sehingga hasil akhirnya tampak lebih rapi dan higienis.
                    </p>
                </div>
            </div>
        </div>
    </main>
<?= $this->endSection() ?>