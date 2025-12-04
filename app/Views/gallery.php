<?= $this->extend('layout/template') ?>


<?= $this->section('galeri') ?>

    <main class="py-10">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-2 md:grid-cols-5 gap-6">

                <?php if (empty($gallery_items)): ?>
                    <div class="col-span-full text-center py-10">
                        <p class="text-gray-500 text-lg">Belum ada foto di galeri.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($gallery_items as $item): ?>
                        <div class="gallery-item">
                            <div class="image-container aspect-w-3 aspect-h-3">
                                <img src="<?= base_url('uploads/gallery/' . esc($item['gambar_gallery'])) ?>" 
                                     alt="Nail Art Gallery" 
                                     onerror="this.src='<?= base_url('assets/placeholder.png') ?>'">
                            </div>
                            <div class="bg-testing-bg font-inika text-center py-2 px-1 text-sm">
                                <?= esc($item['deskripsi_gallery']) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>

        </div>

    </main>

<?= $this->endSection() ?>