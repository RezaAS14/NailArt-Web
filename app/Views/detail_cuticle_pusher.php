<?= $this->extend('layout/template') ?>
<?= $this->section('detail_cuticle_pusher') ?>
    <main class="max-w-7xl mx-auto py-6 px-4">
        <div class="w-full mb-6">
            <div class="header-line"></div>
            <h2 class="text-3xl font-inika text-center py-4 text-black">
                PRODUCT DETAIL
            </h2>
            <div class="header-line"></div>
        </div>

        <div class="detail-card">
            <span class="discount-badge-detail">10%</span>
            
            <a href="<?= site_url('accessories') ?>" class="back-button" aria-label="Kembali ke Accessories">
                <i class="fa-solid fa-arrow-turn-up fa-rotate-270"></i> 
            </a>

            <div class="flex flex-col md:flex-row gap-8 items-start">
                
                <div class="product-detail-image-container flex-shrink-0">
                    <img src="<?= base_url('assets/cuticle-pusher.png') ?>" alt="Cuticle Pusher" class="rounded-lg">
                    <button class="add-to-cart-button-detail" aria-label="Tambah ke keranjang">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>

                <div class="flex-grow">
                    <h1 class="text-3xl font-inika text-black mb-2">Cuticle Pusher</h1>
                    
                    <div class="flex items-baseline mb-4">
                        <p class="text-2xl font-bold text-primary-dark font-inika mr-3">Rp 3.000</p>
                        <p class="text-base text-gray-500 line-through font-inika">Rp30.000</p>
                    </div>

                    <h3 class="text-lg font-bold font-inika text-black mb-2 mt-6">Description</h3>
                    <p class="text-base font-inika text-gray-700 leading-relaxed text-justify">
                        Cuticle pusher adalah alat perawatan kuku yang digunakan untuk mendorong dan merapikan kutikula, yaitu lapisan tipis kulit di sekitar pangkal kuku. Alat ini biasanya terbuat dari stainless steel, kayu, atau plastik, dan memiliki dua ujung berbeda—satu untuk mendorong kutikula secara lembut, dan satu lagi untuk membersihkan kotoran serta sisa kulit mati di area kuku. Dalam proses manicure maupun pedicure, cuticle pusher membantu menciptakan tampilan kuku yang lebih bersih, rapi, dan siap untuk diaplikasikan cat kuku. Penggunaan alat ini secara teratur dapat mencegah penumpukan kutikula, mengurangi risiko iritasi, serta membuat kuku tampak lebih sehat dan terawat. Karena kepraktisannya, cuticle pusher menjadi salah satu perlengkapan wajib dalam rutinitas perawatan kuku di rumah maupun di salon profesional.
                    </p>
                </div>
            </div>
        </div>
    </main>
<?= $this->endSection() ?>