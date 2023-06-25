<?= $this->extend('shop/templates/index'); ?>
<?= $this->section('shopcon'); ?>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="<?= base_url('/uploads/') . $images ?>" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6">

                <h2 class="text-black"><?= $productName ?></h2>
                <p><?= $productDescription ?></p>
                <?php if (in_groups('member')) : ?>
                    <p><strong class="text-primary h4">Rp<?= number_format($productPrice - $diskon, 3, '.', ',') ?></strong></p>
                <?php else : ?>
                    <p><strong class="text-primary h4">Rp<?= $productPrice; ?></strong></p>
                <?php endif; ?>

                <form action="<?= base_url('/user/addToChart'); ?>" method="post">
                    <div class="mb-5">
                        <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                            </div>
                            <input type="text" name="quantity" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="page_id" name="page_id" value="<?= $page_id ?>">
                    <input type="hidden" id="name" name="name_product" value="<?= $productName ?>">
                    <input type="hidden" id="images" name="images" value="<?= $images ?>">
                    <?php if (in_groups('member')) : ?>
                        <input type="hidden" id="price" name="price" value="<?= number_format($productPrice - 2.500, 3, '.', ',') ?>">
                    <?php else : ?>
                        <input type="hidden" id="price" name="price" value="<?= $productPrice ?>">
                    <?php endif; ?>

                    <?php if (logged_in()) : ?>
                        <p>
                            <a href="/shop" class="buy-now btn btn-sm btn-info">Back</a>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Add To Cart</button>
                        </p>
                    <?php else : ?>
                        <p>Please login to add the product to cart.</p>
                        <p>
                            <a href="/shop" class="buy-now btn btn-sm btn-info">Back</a>
                            <a href="/login" class="buy-now btn btn-sm btn-primary">Login</a>
                        </p>
                    <?php endif; ?>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="site-section block-3 site-blocks-2 bg-light">
    <!-- Featured products section -->
</div>

<?= $this->endSection(); ?>