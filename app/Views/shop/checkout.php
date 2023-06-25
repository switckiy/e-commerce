<?= $this->extend('shop/templates/index'); ?>
<?= $this->section('shopcon'); ?>
<form action="<?= base_url('/user/chekout'); ?>" method="post">
  <div class="site-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mb-5 mb-md-0">
          <h2 class="h3 mb-3 text-black">Billing Details</h2>
          <div class="p-3 p-lg-5 border">
            <div class="form-group">
              <label for="c_country" class="text-black">Provinsi<span class="text-danger">*</span></label>
              <select id="c_country" name="c_country" class="form-control">
                <option value="jawa barat">Jawa Barat</option>

              </select>
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <label for="c_address" class="text-black">Kota <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Street address">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6">
                <label for="c_state_country" class="text-black">Kecamatan<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="c_state_country" name="c_state_country">
              </div>
              <div class="col-md-6">
                <label for="c_postal_zip" class="text-black">Kelurahan<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip">
              </div>
            </div>

            <div class="form-group row mb-5">
              <div class="col-md-6">
                <label for="name" class="text-black">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Youre Name">
              </div>

              <div class="col-md-6">
                <label for="c_phone" class="text-black">Nomor Telepon <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number">
              </div>
            </div>

            <div class="form-group">
              <label for="c_order_notes" class="text-black">Alamat Lengkap</label>
              <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
            </div>

          </div>
        </div>
        <div class="col-md-6">
          <div class="row mb-5">
            <div class="col-md-12">
              <h2 class="h3 mb-3 text-black">Your Order</h2>
              <div class="p-3 p-lg-5 border">
                <table class="table site-block-order-table mb-5">
                  <thead>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total</th>
                  </thead>
                  <tbody>
                    <?php foreach ($products as $product) : ?>
                      <tr>
                        <td><?= $product['name_product'] ?></td>
                        <td><?= $product['quantity'] ?></td>
                        <td>Rp<?= $product['total'] ?></td>
                      </tr>
                      <tr>
                      <?php endforeach; ?>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                        <td></td>
                        <td class="text-black">Rp<?= $total_price; ?></td>
                      </tr>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                        <td></td>
                        <td class="text-black font-weight-bold"><strong>Rp<?= $total_price; ?></strong></td>
                        <input type="hidden" name="total" value="<?= $total_price; ?>">
                      </tr>
                      <tr>
                        <td class="text-black">Note : tidak termasuk ongkir</td>
                        <td></td>
                        <td></td>
                      </tr>
                  </tbody>
                </table>

                <div class="border p-3 mb-3">
                  <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Cod Only</a></h3>

                  <div class="collapse" id="collapsebank">
                    <div class="py-2">
                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='thankyou.html'">Place Order</button>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- </form> -->
    </div>
  </div>

</form>
<?= $this->endSection(); ?>