<?= $this->extend('layout/template') ?>
<?= $this->section('about') ?>
    <section class="w-full bg-[#F7EEDC] px-16 py-20">
        <div class="max-w-7xl mx-auto">
            
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_auto] gap-16 font-inika text-black">
                
                <div class="pr-8">
                    <h2 class="text-5xl font-bold mb-8">About Rena_ilso4</h2>

                    <p class="text-justify leading-relaxed mb-6 text-lg">
                        Rena_ilso4, dibuat karena sebuah pengalaman yang kurang menyenangkan. Sebelum rena_ilso4 dibuat,
                        Rena, sang artist yang sekaligus owner rena_ilso4 pernah memakai jasa orang lain untuk menghias
                        kukunya. Namun setelah kukunya selesai dihias, model yang diinginkan rena sangat jauh dari hasil
                        yang dibuat penyedia jasa.
                    </p>

                    <p class="text-justify leading-relaxed mb-6 text-lg">
                        Setelah dari itu, rena bercerita ke pasangannya, bahwa design yang dia inginkan tidak terwujud,
                        ia berkata kalau sebenarnya ia mampu untuk membuat design ini sendiri, namun karena penyedia
                        nailart itu adalah temannya, maka ia ingin membantunya. Pasangannya berkata "Kalau kamu punya
                        kemampuan untuk membuat nail art, saya sarankan untuk membuat usaha sampingan nail art.
                        Targetnya adalah mahasiswi dan pekerja pekerja wanita yang ingin menghias kuku dengan harga
                        sangat terjangkau".
                    </p>

                    <p class="text-justify leading-relaxed mb-16 text-lg">
                        Dari situlah rena_ilso4 terbentuk.
                    </p>

                    <h2 class="text-5xl font-bold mb-8">About Artist</h2>

                    <p class="text-justify leading-relaxed text-lg">
                        Rena adalah mahasiswi semester 7 di politeknik negeri medan, ia memiliki hobi dan skill
                        untuk menghias kuku. Itu merupakan alas utamanya untuk membangun rena_ilso4.
                    </p>
                </div>

                <div class="flex flex-col gap-8 items-center">
                    <img src="<?= base_url('assets/about1.jpg') ?>" alt="Nail Art Design" class="rounded-2xl shadow-xl object-cover w-[410px] h-[500px]" />
                    <img src="<?= base_url('assets/about2.jpg') ?>" alt="Nail Art Design" class="rounded-2xl shadow-xl object-cover w-[410px] h-[300px]" />
                </div>

            </div>

        </div>
    </section>
<?= $this->endSection() ?>