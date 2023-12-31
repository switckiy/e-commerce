<?= $this->extend('shop/templates/index'); ?>
<?= $this->section('shopcon'); ?>
<div class="site-section">
  <div class="container">


    <div class="row mb-5">
      <form class="col-md-12" method="post">
        <div class="site-blocks-table">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="product-thumbnail">Image</th>
                <th class="product-name">Product</th>
                <th class="product-price">Price</th>
                <th class="product-quantity">Quantity</th>
                <th class="product-total">Total</th>
                <th class="product-remove">Remove</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!$products == '') : ?>
                <?php foreach ($products as $product) : ?>
                  <tr>
                    <td class="product-thumbnail">
                      <img src="<?= base_url('/uploads/' . $product['images']); ?>" alt="Image" class="img-fluid">
                    </td>
                    <td class="product-name">
                      <h2 class="h5 text-black"><?= $product['name_product']; ?></h2>
                    </td>
                    <td>Rp<?= $product['price']; ?></td>
                    <td><?= $product['quantity']; ?></td>
                    <td>Rp<?= $product['total']; ?></td>
                    <td><a href="<?= base_url('/user/deleteChart/' . $product['product_id']) . '/' . implode(" ", $user_id) ?>" class="btn btn-primary btn-sm">X</a></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </form>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="row mb-5">

          <div class="col-md-6">
          </div>
        </div>
      </div>

      <div class="col-md-6 pl-5">
        <div class="row justify-content-end">
          <div class="col-md-7">
            <div class="row">
              <div class="col-md-12 text-right border-bottom mb-5">
                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <span class="text-black">Subtotal</span>
              </div>
              <div class="col-md-6 text-right">
                <strong class="text-black">Rp<?= $total_price; ?></strong>
              </div>
            </div>
            <div class="row mb-5">
              <div class="col-md-6">
                <span class="text-black">Total</span>
              </div>
              <div class="col-md-6 text-right">
                <strong class="text-black">Rp<?= $total_price; ?></strong>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <a href="<?= base_url('/checkout') ?>" class="btn btn-primary btn-lg py-3 btn-block">Proceed To Checkout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>



<?= $this->endSection(); ?>