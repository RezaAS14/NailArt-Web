<?= $this->extend('layout/template') ?>
<?= $this->section('detail_accessory') ?>
    <section class="max-w-7xl mx-auto py-10 px-4">
        <div class="detail-card">
            <!-- Discount Badge -->
            <?php if ($product['diskon'] > 0): ?>
                <span class="discount-badge-detail"><?= number_format($product['diskon'], 0) ?>% OFF</span>
            <?php endif; ?>
            
            <!-- Back Button -->
            <a href="<?= site_url('accessories') ?>" class="back-button" title="Kembali">
                <i class="fa-solid fa-arrow-left-long"></i>
            </a>
            
            <!-- Content Container -->
            <div class="grid md:grid-cols-2 gap-8 relative z-0">
                <!-- Image Section -->
                <div class="flex justify-center items-center">
                    <div class="product-detail-image-container">
                        <img src="<?= base_url('uploads/accessories/' . esc($product['gambar_produk'])) ?>" 
                             alt="<?= esc($product['nama_produk']) ?>"
                             onerror="this.src='<?= base_url('assets/placeholder.png') ?>'">
                        
                        <button class="add-to-cart-button-detail" 
                                onclick="addToCart('<?= esc($product['id_produk']) ?>', '<?= esc($product['nama_produk']) ?>', <?= $product['harga_produk'] - ($product['harga_produk'] * ($product['diskon'] / 100)) ?>, '<?= base_url('uploads/accessories/' . esc($product['gambar_produk'])) ?>')"
                                title="Tambah ke keranjang">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Details Section -->
                <div class="flex flex-col justify-center space-y-4">
                    <!-- Product Name -->
                    <h1 class="text-3xl font-inika font-bold text-black uppercase">
                        <?= esc($product['nama_produk']) ?>
                    </h1>
                    
                    <!-- Rating -->
                    <div class="flex items-center gap-2">
                        <div class="text-yellow-500">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half"></i>
                        </div>
                        <span class="text-gray-700 font-inika">4.9 dari 5</span>
                    </div>
                    
                    <!-- Price -->
                    <div class="space-y-2">
                        <?php 
                            $harga_asli = $product['harga_produk'];
                            $diskon = $product['diskon'] ?? 0;
                            $harga_diskon = $harga_asli - ($harga_asli * ($diskon / 100));
                        ?>
                        <p class="text-sm text-gray-600 font-inika">
                            <?php if ($diskon > 0): ?>
                                <span class="line-through mr-2">Rp <?= number_format($harga_asli, 0, ',', '.') ?></span>
                                <span class="text-green-600 font-bold">Hemat <?= number_format($diskon, 0) ?>%</span>
                            <?php endif; ?>
                        </p>
                        <p class="text-2xl font-bold text-primary-dark font-inika">
                            Rp <?= number_format($harga_diskon, 0, ',', '.') ?>
                        </p>
                    </div>
                    
                    <!-- Stock Status -->
                    <div>
                        <?php if ($product['stok_tersedia'] > 0): ?>
                            <p class="text-sm <?= $product['stok_tersedia'] > 5 ? 'text-green-600' : 'text-orange-600' ?> font-bold">
                                <?= $product['stok_tersedia'] > 5 ? '✓' : '⚠' ?> Stok Tersedia: <?= $product['stok_tersedia'] ?>
                            </p>
                        <?php else: ?>
                            <p class="text-sm text-red-600 font-bold">✗ Stok Habis</p>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Description -->
                    <div class="pt-4 border-t border-gray-300">
                        <h3 class="font-inika font-bold text-black mb-2">Deskripsi Produk</h3>
                        <p class="text-gray-700 text-sm leading-relaxed font-inika">
                            <?= nl2br(esc($product['deskripsi_produk'] ?? 'Tidak ada deskripsi tersedia')) ?>
                        </p>
                    </div>
                    
                    <!-- Add to Cart Button -->
                    <div class="pt-4">
                        <button onclick="addToCart('<?= esc($product['id_produk']) ?>', '<?= esc($product['nama_produk']) ?>', <?= $harga_diskon ?>, '<?= base_url('uploads/accessories/' . esc($product['gambar_produk'])) ?>')"
                                class="w-full bg-primary-dark text-white py-3 rounded-lg font-inika font-bold hover:bg-nav-hover transition duration-200"
                                <?php if ($product['stok_tersedia'] <= 0): ?>disabled<?php endif; ?>>
                            <i class="fa-solid fa-shopping-cart mr-2"></i>
                            <?php if ($product['stok_tersedia'] > 0): ?>
                                Tambah ke Keranjang
                            <?php else: ?>
                                Stok Habis
                            <?php endif; ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        // Fungsi untuk menambahkan produk ke keranjang
        function addToCart(productId, productName, price, imagePath) {
            const isLoggedIn = <?= session()->has('logged_in') ? 'true' : 'false' ?>;
            const stockAvailable = <?= $product['stok_tersedia'] ?>;
            
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
                        openModal();
                    }
                });
                return;
            }
            
            if (stockAvailable <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Stok Habis',
                    text: 'Maaf, produk ini sedang tidak tersedia.',
                    confirmButtonColor: '#A3485A'
                });
                return;
            }
            
            if (typeof incrementCart === 'function') {
                incrementCart('product_' + productId, {
                    id: 'product_' + productId,
                    name: productName,
                    price: price,
                    image: imagePath,
                    qty: 1,
                    maxStock: stockAvailable
                });
            } else {
                console.error('Function incrementCart not found');
            }
        }
    </script>
<?= $this->endSection() ?>
