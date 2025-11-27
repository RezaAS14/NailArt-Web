<?= $this->extend('layout/template') ?>
<?= $this->section('keranjang') ?>

<section class="max-w-7xl mx-auto py-10 px-4 font-inika">
    <div class="flex flex-col md:flex-row gap-6">

        <div class="md:w-3/4 bg-testing-bg rounded-lg shadow-xl p-6 relative noise-shape">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 border-b border-gray-400 pb-2">Keranjang</h2>
            
            <div id="cart-items-container" class="space-y-4">
                <div id="empty-cart-message" class="text-center text-gray-500 py-10 hidden">
                    Keranjang Anda kosong. Tambahkan produk dari <a href="<?= site_url('accessories') ?>" class="text-primary-dark underline hover:text-nav-hover font-bold">Accessories</a>.
                </div>
            </div>

        </div>

        <div class="md:w-1/4">
            <div class="bg-testing-bg rounded-lg shadow-xl p-6 h-fit noise-shape mb-4">
                <h3 class="text-3xl font-bold text-gray-800 mb-4 border-b border-gray-400 pb-2">SUBTOTAL</h3>
                
                <p id="subtotal-amount" class="text-2xl font-bold text-right text-gray-800 mb-6">Rp 0</p>
                
                <button class="w-full bg-[#91815A] text-white py-3 rounded-lg font-bold text-lg hover:bg-[#A1916A] transition duration-200 uppercase shadow-md active:shadow-inner" id="checkout-button">
                    Checkout
                </button>
            </div>
            
            <div id="transaction-success-box" class="bg-testing-bg rounded-lg shadow-xl p-4 noise-shape hidden">
                <div class="flex items-center mb-2">
                    <span class="text-green-600 text-xl mr-2"><i class="fa-solid fa-circle-check"></i></span>
                    <p class="font-bold text-gray-800 text-lg">Transaksi Berhasil <i class="fa-solid fa-check"></i></p>
                </div>
                <p class="text-sm text-gray-700">Total Harga: <span id="transaction-total-amount" class="font-bold">Rp 0</span></p>
            </div>
            </div>

    </div>
</section>

<script>
    // --- FUNGSI HALAMAN KERANJANG ---
    
    // Data produk dummy (referensi untuk gambar/nama/harga jika diperlukan)
    const allProductsData = [
        { id: 'nail_file', name: 'NAIL FILE', price: 10900, qty: 0, image: '<?= base_url('assets/nail-file.png') ?>' },
        { id: 'cuticle_nipper', name: 'CUTICLE NIPPER', price: 92000, qty: 0, image: '<?= base_url('assets/cuticle-nipper.png') ?>' },
        { id: 'cuticle_pusher', name: 'CUTICLE PUSHER', price: 3000, qty: 1, image: '<?= base_url('assets/cuticle-pusher.png') ?>' },
        // Pastikan path image benar saat dipanggil dari JS/PHP
        // Jika path di atas tidak berfungsi, coba hilangkan base_url() dan gunakan path relatif saja:
        // { id: 'cuticle_pusher', name: 'CUTICLE PUSHER', price: 3000, qty: 1, image: 'assets/cuticle-pusher.png' },
        
    ];

    const cartContainer = document.getElementById('cart-items-container');
    const subtotalElement = document.getElementById('subtotal-amount');
    const emptyCartMessage = document.getElementById('empty-cart-message');
    const transactionBox = document.getElementById('transaction-success-box');
    const transactionTotalAmount = document.getElementById('transaction-total-amount');
    
    /** Mengambil data keranjang dari localStorage. */
    function getCartData() {
        // Logika disinkronkan dengan template.php (mengambil item dari localStorage)
        const data = localStorage.getItem('cartItems');
        return data ? JSON.parse(data) : [];
    }
    
    /** Menyimpan data keranjang ke localStorage. */
    function saveCartData(items) {
        localStorage.setItem('cartItems', JSON.stringify(items));
        // Memastikan badge di header diperbarui jika fungsi tersedia
        if (typeof updateCartBadge === 'function') {
            updateCartBadge(); 
        }
    }

    /** Menghitung subtotal. */
    function calculateSubtotal(items) {
        // Filter item dengan qty > 0 sebelum menghitung total
        const activeItems = items.filter(item => item.qty > 0); 
        const subtotal = activeItems.reduce((sum, item) => sum + (item.price * item.qty), 0);
        return subtotal;
    }
    
    /** Memformat angka menjadi Rupiah (contoh: 10900 -> Rp 10.900) */
    function formatRupiah(number) {
        return "Rp " + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    
    /** Mengubah kuantitas produk. */
    function changeQuantity(productId, delta) {
        let items = getCartData();
        let itemIndex = items.findIndex(item => item.id === productId);

        if (itemIndex > -1) {
            items[itemIndex].qty += delta;

            if (items[itemIndex].qty <= 0) {
                // Hapus item jika kuantitas <= 0
                items.splice(itemIndex, 1);
            }
            
            saveCartData(items);
            renderCartItems(); // Render ulang tampilan
            transactionBox.classList.add('hidden'); // Sembunyikan notifikasi jika ada perubahan
        }
    }

    /** Merender item keranjang ke DOM. */
    function renderCartItems() {
        let items = getCartData();
        
        // Hapus konten yang ada
        cartContainer.innerHTML = '';
        
        // Filter items dengan qty > 0 untuk ditampilkan (Walaupun harusnya sudah difilter di saveCartData)
        items = items.filter(item => item.qty > 0);

        if (items.length === 0) {
            emptyCartMessage.classList.remove('hidden');
        } else {
            emptyCartMessage.classList.add('hidden');
        }

        // Tampilkan item
        items.forEach(item => {
            const itemHTML = `
                <div class="cart-item flex items-center py-4 border-b border-gray-400" data-product-id="${item.id}">
                    <div class="w-20 h-20 bg-white rounded-lg overflow-hidden flex-shrink-0 mr-4 border border-gray-300">
                        <img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover">
                    </div>
                    
                    <div class="flex-grow">
                        <p class="text-xl font-bold text-gray-800">${item.name}</p>
                        <p class="text-base text-gray-700">${formatRupiah(item.price)}</p>
                    </div>
                    
                    <div class="flex items-center space-x-2 flex-shrink-0">
                        <button class="qty-minus w-8 h-8 rounded-full bg-primary-dark text-white flex items-center justify-center shadow hover:bg-nav-hover transition duration-200" data-id="${item.id}">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        <span class="qty-display font-bold text-lg w-8 text-center">${item.qty}</span>
                        <button class="qty-plus w-8 h-8 rounded-full bg-primary-dark text-white flex items-center justify-center shadow hover:bg-nav-hover transition duration-200" data-id="${item.id}">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
            `;
            cartContainer.insertAdjacentHTML('beforeend', itemHTML);
        });

        // Hitung Subtotal dan tampilkan
        const subtotal = calculateSubtotal(items);
        subtotalElement.textContent = formatRupiah(subtotal);
        
        // Tambahkan event listeners ke tombol kuantitas yang baru dibuat
        attachQtyEventListeners();
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

    /** Logika Checkout */
    document.getElementById('checkout-button').addEventListener('click', function() {
        const items = getCartData();
        const subtotal = calculateSubtotal(items);

        if (subtotal === 0) {
            alert('Keranjang Anda kosong. Tidak dapat melakukan Checkout.');
            return;
        }

        // Tampilkan notifikasi Transaksi Berhasil
        transactionTotalAmount.textContent = formatRupiah(subtotal);
        transactionBox.classList.remove('hidden');
        
        // Simulasi: Reset keranjang setelah 5 detik (atau saat halaman dimuat ulang)
        setTimeout(() => {
             // saveCartData([]); // Nonaktifkan reset keranjang agar user dapat melihat item yang dibeli
             // renderCartItems();
        }, 5000);

        // alert(`Checkout berhasil! Total belanja: ${formatRupiah(subtotal)}.`);
    });

    // Inisialisasi: Render item saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        renderCartItems();
    });

</script>

<?= $this->endSection() ?>