<?= $this->extend('shop/templates/index'); ?>
<?= $this->section('shopcon'); ?>
<div class="site-section">
    <div class="container">

        <div class="row mb-5">
            <div class="col-md-9 order-2">

                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="float-md-left mb-4">
                            <h2 class="text-black h5">Shop All</h2>
                        </div>

                    </div>
                </div>
                <?php
                $items_per_page = 20; // Jumlah produk per halaman
                $total_products = count($products); // Jumlah total produk
                $total_pages = ceil($total_products / $items_per_page); // Jumlah total halaman

                $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Nomor halaman saat ini, baca dari query string (jika ada)

                $start_index = ($current_page - 1) * $items_per_page; // Indeks awal produk yang akan ditampilkan
                $end_index = min($start_index + $items_per_page, $total_products); // Indeks akhir produk yang akan ditampilkan

                $displayed_products = array_slice($products, $start_index, $end_index - $start_index); // Produk yang akan ditampilkan pada halaman ini
                ?>
                <div class="row mb-5">
                    <div class="row">
                        <?php foreach ($displayed_products as $product) : ?>

                            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                                <div class="block-4 text-center border">
                                    <figure class="block-4-image">
                                        <a href="<?= base_url('home/detile/' . $product['id']) ?>"><img src="<?= base_url('/uploads/' . $product['images']); ?>" alt="Image placeholder" class="img-fluid"></a>
                                    </figure>
                                    <div class="block-4-text p-4">
                                        <h6><a href="<?= base_url('home/detile/' . $product['id']) ?>" class="text-dark"><?= limitNameLength($product['name'], 25); ?></a></h6>
                                        <?php if (in_groups('member')) : ?>
                                            <p class="text-dark font-weight-bold">Rp<?= number_format($product['price'] - $product['diskon'], 3, '.', ',')  ?></p>
                                        <?php else : ?>
                                            <p class="text-dark font-weight-bold">Rp<?= $product['price']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php
                function limitNameLength($name, $maxLength)
                {
                    if (strlen($name) > $maxLength) {
                        $name = substr($name, 0, $maxLength - 3) . '...';
                    }
                    return $name;
                }
                ?>

                <div class="row" data-aos="fade-up">
                    <div class="col-md-12 text-center">
                        <div class="site-block-27">
                            <ul>
                                <?php if ($current_page > 1) : ?>
                                    <li><a href="<?= site_url('/shop?page=' . ($current_page - 1)); ?>">&lt;</a></li>
                                <?php endif; ?>
                                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                    <li<?= ($i == $current_page) ? ' class="active"' : ''; ?>><a href="<?= site_url('/shop?page=' . $i); ?>"><?= $i; ?></a></li>
                                    <?php endfor; ?>
                                    <?php if ($current_page < $total_pages) : ?>
                                        <li><a href="<?= site_url('/shop?page=' . ($current_page + 1)); ?>">&gt;</a></li>
                                    <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-3 order-1 mb-5 mb-md-0">
                <div class="border p-4 rounded mb-4">
                    <div class="mb-12">
                        <div class="d-flex">
                            <div class="mr-3">
                                <img src="https://img.lovepik.com/desgin_photo/45007/7385_detail.jpg" alt="Size" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>



<?= $this->endSection(); ?>