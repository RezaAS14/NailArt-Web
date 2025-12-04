<?= $this->extend('layout/template') ?>
<?= $this->section('keranjang') ?>

<section class="max-w-7xl mx-auto py-10 px-4 font-inika">
    <div class="flex flex-col md:flex-row gap-6">

        <!-- Keranjang Items -->
        <div class="md:w-3/4 bg-testing-bg rounded-lg shadow-xl p-6 relative noise-shape">
            <div class="flex justify-between items-center mb-6 border-b border-gray-400 pb-3">
                <div class="flex items-center gap-3">
                    <a href="<?= site_url('accessories') ?>" class="text-primary-dark hover:text-nav-hover transition duration-200" title="Kembali ke Accessories">
                        <i class="fa-solid fa-arrow-left text-2xl"></i>
                    </a>
                    <h2 class="text-3xl font-bold text-gray-800">
                        <i class="fa-solid fa-shopping-cart mr-2"></i>Keranjang Belanja
                    </h2>
                </div>
                <span id="cart-item-count" class="bg-primary-dark text-white px-3 py-1 rounded-full text-sm font-bold">
                    0 Item
                </span>
            </div>
            
            <div id="cart-items-container" class="space-y-4">
                <!-- Loading State -->
                <div id="loading-cart" class="text-center text-gray-500 py-10">
                    <i class="fa-solid fa-spinner fa-spin text-3xl mb-3"></i>
                    <p>Memuat keranjang...</p>
                </div>
                
                <!-- Empty State -->
                <div id="empty-cart-message" class="text-center text-gray-500 py-10 hidden">
                    <i class="fa-solid fa-cart-shopping text-5xl mb-4 opacity-30"></i>
                    <p class="text-lg mb-2">Keranjang Anda kosong</p>
                    <p class="text-sm">Tambahkan produk dari <a href="<?= site_url('accessories') ?>" class="text-primary-dark underline hover:text-nav-hover font-bold">Accessories</a>.</p>
                </div>
            </div>

        </div>

        <!-- Sidebar Checkout -->
        <div class="md:w-1/4">
            <div class="bg-testing-bg rounded-lg shadow-xl p-6 h-fit noise-shape mb-4">
                <h3 class="text-2xl font-bold text-gray-800 mb-4 border-b border-gray-400 pb-3">
                    <i class="fa-solid fa-receipt mr-2"></i>Ringkasan
                </h3>
                
                <!-- Item Count -->
                <div class="flex justify-between mb-3 text-gray-700">
                    <span>Total Item:</span>
                    <span id="summary-item-count" class="font-semibold">0</span>
                </div>
                
                <!-- Subtotal -->
                <div class="flex justify-between mb-4 pb-4 border-b border-gray-400">
                    <span class="text-gray-700">Subtotal:</span>
                    <span id="subtotal-amount" class="font-bold text-xl text-gray-800">Rp 0</span>
                </div>
                
                <!-- Checkout Button -->
                <button class="w-full bg-[#91815A] text-white py-3 rounded-lg font-bold text-lg hover:bg-[#A1916A] transition duration-200 uppercase shadow-md active:shadow-inner flex items-center justify-center gap-2" id="checkout-button">
                    <i class="fa-solid fa-credit-card"></i>
                    Checkout
                </button>
                
                <!-- Info -->
                <p class="text-xs text-gray-600 mt-3 text-center">
                    <i class="fa-solid fa-shield-halved mr-1"></i>Transaksi aman & tersimpan
                </p>
            </div>
            
            <!-- Transaction Success Box (Hidden by default) -->
            <div id="transaction-success-box" class="bg-testing-bg rounded-lg shadow-xl p-4 noise-shape hidden">
                <div class="flex items-center mb-2">
                    <span class="text-green-600 text-xl mr-2"><i class="fa-solid fa-circle-check"></i></span>
                    <p class="font-bold text-gray-800 text-lg">Transaksi Berhasil <i class="fa-solid fa-check"></i></p>
                </div>
                <p class="text-xs text-gray-700 mb-2">Username: <span id="transaction-username" class="font-semibold"></span></p>
                <p class="text-xs text-gray-700 mb-2">Alamat: <span id="transaction-alamat" class="font-semibold"></span></p>
                <p class="text-xs text-gray-700 mb-2">Tanggal: <span id="transaction-date" class="font-semibold"></span></p>
                <p class="text-sm text-gray-700 mb-1">Total: <span id="transaction-total-amount" class="font-bold">Rp 0</span></p>
            </div>
        </div>

    </div>
</section>

<script>
    // --- FUNGSI HALAMAN KERANJANG ---
    
    const cartContainer = document.getElementById('cart-items-container');
    const subtotalElement = document.getElementById('subtotal-amount');
    const emptyCartMessage = document.getElementById('empty-cart-message');
    const transactionBox = document.getElementById('transaction-success-box');
    const transactionTotalAmount = document.getElementById('transaction-total-amount');
    
    const isLoggedIn = <?= session()->has('logged_in') ? 'true' : 'false' ?>;
    
    /** Mengambil data keranjang dari localStorage atau server. */
    function getCartData() {
        if (isLoggedIn) {
            // Jika user login, ambil dari server
            return fetch('<?= site_url('cart/get') ?>')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        return data.items.map(item => ({
                            id: 'product_' + item.id_produk,
                            name: item.nama_produk,
                            price: item.harga_produk * (1 - (item.diskon / 100)),
                            qty: parseInt(item.jumlah_keranjang),
                            image: '<?= base_url('uploads/accessories/') ?>' + item.gambar_produk
                        }));
                    }
                    return [];
                });
        } else {
            // Jika guest, ambil dari localStorage
            const data = localStorage.getItem('cartItems');
            return Promise.resolve(data ? JSON.parse(data) : []);
        }
    }
    
    /** Menyimpan data keranjang ke localStorage (untuk guest). */
    function saveCartData(items) {
        if (!isLoggedIn) {
            localStorage.setItem('cartItems', JSON.stringify(items));
        }
        if (typeof updateCartBadge === 'function') {
            updateCartBadge(); 
        }
    }

    /** Menghitung subtotal. */
    function calculateSubtotal(items) {
        const activeItems = items.filter(item => item.qty > 0); 
        const subtotal = activeItems.reduce((sum, item) => sum + (item.price * item.qty), 0);
        return subtotal;
    }
    
    /** Memformat angka menjadi Rupiah (contoh: 10900 -> Rp 10.900) */
    function formatRupiah(number) {
        return "Rp " + number.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    
    /** Mengubah kuantitas produk. */
    function changeQuantity(productId, delta) {
        if (!isLoggedIn) {
            // Guest user - update localStorage
            getCartData().then(items => {
                let itemIndex = items.findIndex(item => item.id === productId);

                if (itemIndex > -1) {
                    items[itemIndex].qty += delta;

                    if (items[itemIndex].qty <= 0) {
                        items.splice(itemIndex, 1);
                    }
                    
                    saveCartData(items);
                    renderCartItems();
                    transactionBox.classList.add('hidden');
                }
            });
        } else {
            // Logged in user - update server database
            const realProductId = productId.replace('product_', '');
            
            // Calculate new quantity first
            getCartData().then(items => {
                let item = items.find(i => i.id === productId);
                if (!item) return;
                
                let newQty = item.qty + delta;
                
                if (newQty <= 0) {
                    // Delete item from database
                    fetch('<?= site_url('cart/remove') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: new URLSearchParams({
                            '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                            'product_id': realProductId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            renderCartItems();
                            if (typeof updateCartBadge === 'function') {
                                updateCartBadge();
                            }
                        }
                    })
                    .catch(error => console.error('Error removing item:', error));
                } else {
                    // Update quantity in database
                    fetch('<?= site_url('cart/update') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: new URLSearchParams({
                            '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                            'product_id': realProductId,
                            'quantity': newQty
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            renderCartItems();
                            if (typeof updateCartBadge === 'function') {
                                updateCartBadge();
                            }
                        }
                    })
                    .catch(error => console.error('Error updating quantity:', error));
                }
                
                transactionBox.classList.add('hidden');
            });
        }
    }

    /** Merender item keranjang ke DOM. */
    function renderCartItems() {
        // Show loading
        const loadingEl = document.getElementById('loading-cart');
        if (loadingEl) loadingEl.classList.remove('hidden');
        
        getCartData().then(items => {
            cartContainer.innerHTML = '';
            
            const activeItems = items.filter(item => item.qty > 0);

            if (activeItems.length === 0) {
                emptyCartMessage.classList.remove('hidden');
            } else {
                emptyCartMessage.classList.add('hidden');
            }

            // Update cart count badge
            const cartCount = document.getElementById('cart-item-count');
            const summaryCount = document.getElementById('summary-item-count');
            const totalItems = activeItems.reduce((sum, item) => sum + item.qty, 0);
            
            if (cartCount) cartCount.textContent = totalItems + ' Item' + (totalItems > 1 ? '' : '');
            if (summaryCount) summaryCount.textContent = totalItems + ' produk';

            activeItems.forEach(item => {
                const itemHTML = `
                    <div class="cart-item flex items-center gap-4 py-4 px-3 border-b border-gray-400 hover:bg-white hover:bg-opacity-30 transition rounded-lg" data-product-id="${item.id}">
                        <div class="w-20 h-20 bg-white rounded-lg overflow-hidden flex-shrink-0 border-2 border-gray-300 shadow-sm">
                            <img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover" onerror="this.src='<?= base_url('assets/placeholder.png') ?>'">
                        </div>
                        
                        <div class="flex-grow">
                            <p class="text-lg font-bold text-gray-800 mb-1">${item.name}</p>
                            <p class="text-sm text-gray-600">Harga: ${formatRupiah(item.price)}</p>
                            <p class="text-sm font-semibold text-primary-dark">Total: ${formatRupiah(item.price * item.qty)}</p>
                        </div>
                        
                        <div class="flex flex-col items-center gap-2 flex-shrink-0">
                            <div class="flex items-center gap-2">
                                <button class="qty-minus w-8 h-8 rounded-full bg-primary-dark text-white flex items-center justify-center shadow hover:bg-nav-hover transition duration-200 active:scale-95" data-id="${item.id}" title="Kurangi">
                                    <i class="fa-solid fa-minus text-xs"></i>
                                </button>
                                <span class="qty-display font-bold text-lg w-10 text-center bg-white px-2 py-1 rounded border border-gray-300">${item.qty}</span>
                                <button class="qty-plus w-8 h-8 rounded-full bg-primary-dark text-white flex items-center justify-center shadow hover:bg-nav-hover transition duration-200 active:scale-95" data-id="${item.id}" title="Tambah">
                                    <i class="fa-solid fa-plus text-xs"></i>
                                </button>
                            </div>
                            <button class="text-red-600 hover:text-red-800 text-xs flex items-center gap-1 transition" onclick="removeItem('${item.id}')" title="Hapus item">
                                <i class="fa-solid fa-trash-can"></i> Hapus
                            </button>
                        </div>
                    </div>
                `;
                cartContainer.insertAdjacentHTML('beforeend', itemHTML);
            });

            const subtotal = calculateSubtotal(activeItems);
            subtotalElement.textContent = formatRupiah(subtotal);
            
            // Hide loading
            if (loadingEl) loadingEl.classList.add('hidden');
            
            attachQtyEventListeners();
        });
    }
    
    /** Hapus item dari keranjang */
    function removeItem(productId) {
        Swal.fire({
            title: 'Hapus Item?',
            text: 'Apakah Anda yakin ingin menghapus item ini dari keranjang?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#A31111',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                changeQuantity(productId, -999); // Set to negative large number to remove
                Swal.fire({
                    icon: 'success',
                    title: 'Dihapus!',
                    text: 'Item berhasil dihapus dari keranjang.',
                    confirmButtonColor: '#A3485A',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            }
        });
    }

    /** Menambahkan event listeners ke tombol +/- */
    function attachQtyEventListeners() {
        document.querySelectorAll('.qty-minus').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                changeQuantity(productId, -1);
            });
        });

        document.querySelectorAll('.qty-plus').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                changeQuantity(productId, 1);
            });
        });
    }

    /** Logika Checkout dengan SweetAlert2 */
    document.getElementById('checkout-button').addEventListener('click', function() {
        getCartData().then(items => {
            const subtotal = calculateSubtotal(items);

            if (subtotal === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Keranjang Kosong',
                    text: 'Keranjang Anda kosong. Tidak dapat melakukan Checkout.',
                    confirmButtonColor: '#A3485A',
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                });
                return;
            }

            if (!isLoggedIn) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Login Diperlukan',
                    html: '<p>Silakan login terlebih dahulu untuk melakukan checkout.</p>',
                    confirmButtonColor: '#A3485A',
                    showCancelButton: true,
                    confirmButtonText: 'Login Sekarang',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to home page to show login modal
                        window.location.href = '<?= site_url('/') ?>';
                    }
                });
                return;
            }

            Swal.fire({
                title: 'Konfirmasi Checkout',
                html: `
                    <div class="text-left space-y-2">
                        <p class="text-lg font-bold text-center mb-4">Ringkasan Belanja</p>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-700">Total Item:</span>
                                <span class="font-semibold">${items.filter(i => i.qty > 0).reduce((sum, i) => sum + i.qty, 0)} produk</span>
                            </div>
                            <div class="flex justify-between border-t pt-2">
                                <span class="text-gray-700 font-bold">Total Harga:</span>
                                <span class="font-bold text-green-600 text-xl">${formatRupiah(subtotal)}</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mt-4 text-center">Lanjutkan checkout?</p>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#A3485A',
                cancelButtonColor: '#d33',
                confirmButtonText: '<i class="fa-solid fa-check mr-2"></i>Ya, Checkout!',
                cancelButtonText: '<i class="fa-solid fa-times mr-2"></i>Batal',
                width: '500px'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Simpan data checkout untuk success box
                    const checkoutDate = new Date().toLocaleString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    localStorage.setItem('lastCheckoutTotal', formatRupiah(subtotal));
                    localStorage.setItem('lastCheckoutDate', checkoutDate);
                    
                    // Show loading
                    Swal.fire({
                        title: 'Memproses Checkout...',
                        html: '<i class="fa-solid fa-spinner fa-spin text-4xl text-primary-dark"></i><p class="text-sm mt-2">Menyimpan ke database...</p>',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Submit form checkout
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '<?= site_url('checkout/process') ?>';
                    form.style.display = 'none';
                    
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '<?= csrf_token() ?>';
                    csrfInput.value = '<?= csrf_hash() ?>';
                    form.appendChild(csrfInput);
                    
                    const totalInput = document.createElement('input');
                    totalInput.type = 'hidden';
                    totalInput.name = 'total_harga';
                    totalInput.value = subtotal.toFixed(0);
                    form.appendChild(totalInput);
                    
                    document.body.appendChild(form);
                    
                    // Submit dengan delay
                    setTimeout(() => {
                        form.submit();
                    }, 500);
                }
            });
        });
    });

    // Inisialisasi: Render item saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        renderCartItems();
    });
    
    // Alert checkout success/error
    <?php if (session()->getFlashdata('checkout_success')): ?>
        // Ambil data dari localStorage dan flashdata
        const lastTotal = localStorage.getItem('lastCheckoutTotal') || 'Rp 0';
        const lastDate = localStorage.getItem('lastCheckoutDate') || new Date().toLocaleString('id-ID');
        const checkoutUsername = '<?= session()->getFlashdata('checkout_username') ?? 'User' ?>';
        const checkoutAlamat = '<?= session()->getFlashdata('checkout_alamat') ?? 'Tidak tersedia' ?>';
        
        // Tampilkan success box di halaman keranjang
        transactionTotalAmount.textContent = lastTotal;
        document.getElementById('transaction-date').textContent = lastDate;
        document.getElementById('transaction-username').textContent = checkoutUsername;
        document.getElementById('transaction-alamat').textContent = checkoutAlamat;
        transactionBox.classList.remove('hidden');
        
        // Sembunyikan checkout button section
        const checkoutBtnSection = document.querySelector('.bg-testing-bg.rounded-lg.shadow-xl.p-6.h-fit');
        if (checkoutBtnSection) {
            checkoutBtnSection.classList.add('hidden');
        }
        
        // Tampilkan SweetAlert dengan info lengkap
        Swal.fire({
            icon: 'success',
            title: 'Checkout Berhasil!',
            html: `
                <div class="text-left">
                    <p class="mb-3 text-lg font-semibold">Terima kasih atas orderannya!</p>
                    <p class="text-xs text-gray-600 mb-4">Segala informasi mengenai pesanan akan kami hubungi melalui email dan nomor telepon, mohon ditunggu yaa~</p>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <p class="text-green-700 font-semibold mb-3 flex items-center">
                            <i class="fa-solid fa-circle-check mr-2 text-xl"></i> Data Transaksi Tersimpan
                        </p>
                        <div class="space-y-1 text-xs text-gray-700">
                            <p><strong>Username:</strong> ${checkoutUsername}</p>
                            <p><strong>Alamat:</strong> ${checkoutAlamat}</p>
                            <p><strong>Tanggal:</strong> ${lastDate}</p>
                            <p><strong>Total:</strong> ${lastTotal}</p>
                        </div>
                    </div>
                </div>
            `,
            confirmButtonColor: '#A3485A',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
            width: '500px'
        }).then(() => {
            // Clear cart untuk guest user
            if (!isLoggedIn) {
                saveCartData([]);
                renderCartItems();
            }
        });
        
        // Clear localStorage
        localStorage.removeItem('lastCheckoutTotal');
        localStorage.removeItem('lastCheckoutDate');
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('checkout_error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Checkout Gagal',
            html: '<p><?= session()->getFlashdata('checkout_error') ?></p><p class="text-sm text-gray-600 mt-2">Silakan coba lagi atau hubungi admin.</p>',
            confirmButtonColor: '#A3485A'
        });
    <?php endif; ?>

</script>

<?= $this->endSection() ?>