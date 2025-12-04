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
            
            <?php if (empty($accessories)): ?>
                <div class="col-span-full text-center py-10">
                    <p class="text-gray-500 text-lg">Belum ada produk accessories tersedia.</p>
                </div>
            <?php else: ?>
                <?php foreach ($accessories as $product): ?>
                    <?php 
                        // Hitung harga setelah diskon
                        $harga_asli = $product['harga_produk'];
                        $diskon = $product['diskon'] ?? 0;
                        $harga_diskon = $harga_asli - ($harga_asli * ($diskon / 100));
                    ?>
                    
                    <div class="bg-white product-card p-2 text-center transition duration-300 hover:shadow-xl">
                        <div class="product-image-container">
                            <?php if ($diskon > 0): ?>
                                <span class="discount-badge"><?= number_format($diskon, 0) ?>%</span>
                            <?php endif; ?>
                            
                            <button class="add-to-cart-button" 
                                    onclick="addToCart('<?= esc($product['id_produk']) ?>', '<?= esc($product['nama_produk']) ?>', <?= $harga_diskon ?>, '<?= base_url('uploads/accessories/' . esc($product['gambar_produk'])) ?>')"
                                    aria-label="Add to cart">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            
                            <img src="<?= base_url('uploads/accessories/' . esc($product['gambar_produk'])) ?>" 
                                 alt="<?= esc($product['nama_produk']) ?>" 
                                 class="w-full h-full object-cover"
                                 onerror="this.src='<?= base_url('assets/placeholder.png') ?>'">
                            
                            <div class="product-overlay">
                                <a href="<?= site_url('accessories/detail/' . esc($product['id_produk'])) ?>" class="detail-button">
                                    Detail Produk
                                </a>
                            </div>
                        </div>
                        
                        <p class="font-bold text-lg font-inika mb-1 text-gray-800 uppercase">
                            <?= esc($product['nama_produk']) ?>
                        </p>
                        
                        <p class="text-sm font-inika">
                            <?php if ($diskon > 0): ?>
                                <span class="line-through text-gray-500 mr-2">
                                    Rp <?= number_format($harga_asli, 0, ',', '.') ?>
                                </span>
                            <?php endif; ?>
                            <span class="text-primary-dark font-bold">
                                Rp <?= number_format($harga_diskon, 0, ',', '.') ?>
                            </span>
                        </p>
                        
                        <div class="text-yellow-500 mt-1 mb-2">
                            <i class="fa-solid fa-star text-sm"></i>
                            <span class="text-xs text-gray-700">4.9</span>
                        </div>
                        
                        <?php if ($product['stok_tersedia'] <= 5): ?>
                            <p class="text-xs text-red-500 font-bold">Stok Terbatas!</p>
                        <?php endif; ?>
                    </div>
                    
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </section>
    
    <script>
        // Fungsi untuk menambahkan produk ke keranjang
        function addToCart(productId, productName, price, imagePath) {
            const isLoggedIn = <?= session()->has('logged_in') ? 'true' : 'false' ?>;
            
            if (!isLoggedIn) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Login Diperlukan',
                    html: '<p>Silakan login terlebih dahulu untuk menambahkan produk ke keranjang.</p>',
                    confirmButtonColor: '#A3485A',
                    showCancelButton: true,
                    confirmButtonText: '<i class="fa-solid fa-right-to-bracket mr-2"></i>Login Sekarang',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('btn-show-login-modal').click();
                    }
                });
                return;
            }
            
            if (typeof incrementCart === 'function') {
                incrementCart('product_' + productId, {
                    id: 'product_' + productId,
                    name: productName,
                    price: price,
                    image: imagePath,
                    qty: 1
                });
            } else {
                console.error('Function incrementCart not found');
            }
        }
    </script>
<?= $this->endSection() ?>