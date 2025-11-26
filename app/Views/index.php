<?= $this->extend('layout/template') ?>

<?= $this->section('beranda') ?>
    <section class="w-full bg-[#FEF3E2] py-2 px-10">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

            <div>
                <h1 class="text-7xl font-kapakana text-black-400 mb-5">
                    Nail Art
                </h1>
                
                <p class="text-gray-700 leading-relaxed">
                    Di sela kesibukan yang padat, saatnya untuk **ME TIME**. <br>
                    Merawat diri menjadi salah satu cara merelakasikan diri. <br>
                    Mempercantik kuku tangan sesuai "dream" client yang membuat <br>
                    mereka menjadi happy ketika di nailart oleh kami.
                </p>
            </div>

            <div class="relative w-full h-72 flex justify-center md:justify-end md:mr-10">
                <div class="absolute right-0 bottom-0 w-48 h-60 bg-[#662222] rounded-t-[120px]"></div>
                
                <div class="absolute right-28 bottom-5 w-36 h-48 rounded-t-[90px] bg-[#8B4A4A] overflow-hidden noise-shape">
                </div>

                <div class="absolute right-4 top-14 w-8 h-8 bg-[#A3485A] rounded-full"></div>
            </div>
        </div>
    </section>

    <section class="w-full bg-[#F7EEDC] py-8 px-10">
        <div class="max-w-6xl mx-auto">
            
            <h2 class="text-4xl font-inika font-bold mb-5">
                Nail Art Costum
            </h2>

            <div class="mb-10">
                <h3 class="text-xl font-inika font-bold text-black-700 mb-3">
                    Easy Nail Art (1 jam)
                </h3>
                <p class="text-gray-700 mb-2 italic">
                    Ini disertakan dengan manicure: membersihkan kutikula/kulit mati di kuku dan membentuk kuku.
                </p>
                <p class="text-gray-700">
                    Design meliputi: satu titik di setiap jari, dua jari chrome/gradasi, setiap jari memiliki warna yang berbeda, 
                    dua permata, satu hati, satu bunga dasar atau sesuatu yang serupa dengan itu. Design ini seharusnya tidak membutuhkan waktu tambahan.
                </p>
            </div>

            <div class="mb-10">
                <h3 class="text-xl font-inika font-bold text-black-700 mb-3">
                    Medium Nail Art (1.5 jam)
                </h3>
                <p class="text-gray-700">
                    Design meliputi: french nailart, marble, pecahan shell, galaxy, simple flower, 
                    chrome, glitter, line, lattering, 2 jari gambar bunga secara detail, 2 jari dihiasi accesories batu.
                </p>
            </div>

            <div class="mb-10">
                <h3 class="text-xl font-inika font-bold text-black-700 mb-3">
                    Hard Nail Art (1.5-2jam)
                </h3>
                <p class="text-gray-700">
                    Design meliputi: french nail, marble, pecahan shell dengan emas, custome galaxy dengan bintang & planet, 
                    detail flower, chrome, glitter, line, lattering, 2 jari gambar bunga secara detail, 2 jari dihiasi accesories batu, mutiara, 2D/3D accesories, character.
                </p>
            </div>

        </div>
    </section>
<?= $this->endSection() ?>