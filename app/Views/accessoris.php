<?= $this->extend('layout/template') ?>
<?= $this->section('accessories') ?>
    <section class="max-w-7xl mx-auto py-6 px-4">
        <div class="w-full mb-8">
            <div class="header-line"></div>
            <h2 class="text-4xl font-inika text-center py-4 ml-10 uppercase text-gray-800">
                ACCESSORIES
            </h2>
            <div class="header-line"></div>
        </div>
        

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

            <div class="bg-white product-card p-2 text-center transition duration-300 hover:shadow-xl">
                <div class="product-image-container">
                    <span class="discount-badge">12%</span>
                    <button class="add-to-cart-button" aria-label="Add to cart"><i class="fa-solid fa-plus"></i></button>
                    <img src="<?= base_url('assets/nail-file.png') ?>" alt="Nail File" class="w-full h-full object-cover">
                    
                    <div class="product-overlay">
                        <a href="<?= site_url('accessories/detail_nail_file') ?>" class="detail-button">
                            Detail Produk
                        </a>
                    </div>
                </div>
                <p class="font-bold text-lg font-inika mb-1 text-gray-800">NAIL FILE</p>
                <p class="text-sm font-inika">
                    <span class="line-through text-gray-500 mr-2">Rp 90.800</span>
                    <span class="text-primary-dark font-bold">Rp 10.900</span> 
                </p>
                <div class="text-yellow-500 mt-1 mb-2">
                    <i class="fa-solid fa-star text-sm"></i>
                    <span class="text-xs text-gray-700">4.9</span>
                </div>
            </div>

            <div class="bg-white product-card p-2 text-center transition duration-300 hover:shadow-xl">
                <div class="product-image-container">
                    <span class="discount-badge">10%</span>
                    <button class="add-to-cart-button" aria-label="Add to cart"><i class="fa-solid fa-plus"></i></button>
                    <img src="<?= base_url('assets/cuticle-pusher.png') ?>" alt="Cuticle Pusher" class="w-full h-full object-cover">
                    
                    <div class="product-overlay">
                        <a href="<?= site_url('accessories/detail_cuticle_pusher') ?>" class="detail-button">
                            Detail Produk
                        </a>
                    </div>
                </div>
                <p class="font-bold text-lg font-inika mb-1 text-gray-800">CUTICLE PUSHER</p>
                <p class="text-sm font-inika">
                    <span class="line-through text-gray-500 mr-2">Rp 30.000</span>
                    <span class="text-primary-dark font-bold">Rp 3.000</span>
                </p>
                <div class="text-yellow-500 mt-1 mb-2">
                    <i class="fa-solid fa-star text-sm"></i>
                    <span class="text-xs text-gray-700">4.9</span>
                </div>
            </div>

            <div class="bg-white product-card p-2 text-center transition duration-300 hover:shadow-xl">
                <div class="product-image-container">
                    <span class="discount-badge">20%</span>
                    <button class="add-to-cart-button" aria-label="Add to cart"><i class="fa-solid fa-plus"></i></button>
                    <img src="<?= base_url('assets/cuticle-nipper.png') ?>" alt="Cuticle Nipper" class="w-full h-full object-cover">
                    
                    <div class="product-overlay">
                        <a href="<?= site_url('accessories/detail_cuticle_nipper') ?>" class="detail-button">
                            Detail Produk
                        </a>
                    </div>
                </div>
                <p class="font-bold text-lg font-inika mb-1 text-gray-800">CUTICLE NIPPER</p>
                <p class="text-sm font-inika">
                    <span class="line-through text-gray-500 mr-2">Rp 115.000</span>
                    <span class="text-primary-dark font-bold">Rp 92.000</span>
                </p>
                <div class="text-yellow-500 mt-1 mb-2">
                    <i class="fa-solid fa-star text-sm"></i>
                    <span class="text-xs text-gray-700">4.9</span>
                </div>
            </div>

            <div class="bg-white product-card p-2 text-center transition duration-300 hover:shadow-xl">
                <div class="product-image-container">
                    <span class="discount-badge">50%</span>
                    <button class="add-to-cart-button" aria-label="Add to cart"><i class="fa-solid fa-plus"></i></button>
                    <img src="<?= base_url('assets/nail-brush.png') ?>" alt="Nail Brush" class="w-full h-full object-cover">
                    
                    <div class="product-overlay">
                        <a href="<?= site_url('accessories/detail_nail_brush') ?>" class="detail-button">
                            Detail Produk
                        </a>
                    </div>
                </div>
                <p class="font-bold text-lg font-inika mb-1 text-gray-800">NAIL BRUSH</p>
                <p class="text-sm font-inika">
                    <span class="line-through text-gray-500 mr-2">Rp 58.000</span>
                    <span class="text-primary-dark font-bold">Rp 29.000</span>
                </p>
                <div class="text-yellow-500 mt-1 mb-2">
                    <i class="fa-solid fa-star text-sm"></i>
                    <span class="text-xs text-gray-700">4.9</span>
                </div>
            </div>

            <div class="bg-white product-card p-2 text-center transition duration-300 hover:shadow-xl">
                <div class="product-image-container">
                    <span class="discount-badge">50%</span>
                    <button class="add-to-cart-button" aria-label="Add to cart"><i class="fa-solid fa-plus"></i></button>
                    <img src="<?= base_url('assets/base-coat.png') ?>" alt="Base Coat" class="w-full h-full object-cover">
                    
                    <div class="product-overlay">
                        <a href="<?= site_url('accessories/detail_base_coat') ?>" class="detail-button">
                            Detail Produk
                        </a>
                    </div>
                </div>
                <p class="font-bold text-lg font-inika mb-1 text-gray-800">BASE COAT</p>
                <p class="text-sm font-inika">
                    <span class="line-through text-gray-500 mr-2">Rp 78.960</span>
                    <span class="text-primary-dark font-bold">Rp 39.480</span>
                </p>
                <div class="text-yellow-500 mt-1 mb-2">
                    <i class="fa-solid fa-star text-sm"></i>
                    <span class="text-xs text-gray-700">4.9</span>
                </div>
            </div>

            <div class="bg-white product-card p-2 text-center transition duration-300 hover:shadow-xl">
                <div class="product-image-container">
                    <span class="discount-badge">80%</span>
                    <button class="add-to-cart-button" aria-label="Add to cart"><i class="fa-solid fa-plus"></i></button>
                    <img src="<?= base_url('assets/top-coat.png') ?>" alt="Top Coat" class="w-full h-full object-cover">
                    
                    <div class="product-overlay">
                        <a href="<?= site_url('accessories/detail_top_coat') ?>" class="detail-button">
                            Detail Produk
                        </a>
                    </div>
                </div>
                <p class="font-bold text-lg font-inika mb-1 text-gray-800">TOP COAT</p>
                <p class="text-sm font-inika">
                    <span class="line-through text-gray-500 mr-2">Rp 149.950</span>
                    <span class="text-primary-dark font-bold">Rp 29.046</span>
                </p>
                <div class="text-yellow-500 mt-1 mb-2">
                    <i class="fa-solid fa-star text-sm"></i>
                    <span class="text-xs text-gray-700">4.9</span>
                </div>
            </div>

            <div class="bg-white product-card p-2 text-center transition duration-300 hover:shadow-xl">
                <div class="product-image-container">
                    <span class="discount-badge">12%</span>
                    <button class="add-to-cart-button" aria-label="Add to cart"><i class="fa-solid fa-plus"></i></button>
                    <img src="<?= base_url('assets/nail-polisher.png') ?>" alt="Nail Polisher" class="w-full h-full object-cover">
                    
                    <div class="product-overlay">
                        <a href="<?= site_url('accessories/detail_nail_polisher') ?>" class="detail-button">
                            Detail Produk
                        </a>
                    </div>
                </div>
                <p class="font-bold text-lg font-inika mb-1 text-gray-800">NAIL POLISHER</p>
                <p class="text-sm font-inika">
                    <span class="line-through text-gray-500 mr-2">Rp 49.000</span>
                    <span class="text-primary-dark font-bold">Rp 43.120</span>
                </p>
                <div class="text-yellow-500 mt-1 mb-2">
                    <i class="fa-solid fa-star text-sm"></i>
                    <span class="text-xs text-gray-700">4.9</span>
                </div>
            </div>

            <div class="bg-white product-card p-2 text-center transition duration-300 hover:shadow-xl">
                <div class="product-image-container">
                    <span class="discount-badge">57%</span>
                    <button class="add-to-cart-button" aria-label="Add to cart"><i class="fa-solid fa-plus"></i></button>
                    <img src="<?= base_url('assets/glitters.png') ?>" alt="Glitter" class="w-full h-full object-cover">
                    
                    <div class="product-overlay">
                        <a href="<?= site_url('accessories/detail_glitter') ?>" class="detail-button">
                            Detail Produk
                        </a>
                    </div>
                </div>
                <p class="font-bold text-lg font-inika mb-1 text-gray-800">GLITTER</p>
                <p class="text-sm font-inika">
                    <span class="line-through text-gray-500 mr-2">Rp 199.999</span>
                    <span class="text-primary-dark font-bold">Rp 85.600</span>
                </p>
                <div class="text-yellow-500 mt-1 mb-2">
                    <i class="fa-solid fa-star text-sm"></i>
                    <span class="text-xs text-gray-700">4.9</span>
                </div>
            </div>

        </div>
    </section>
<?= $this->endSection() ?>