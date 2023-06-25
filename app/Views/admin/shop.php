<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-4 text-gray-800">Shop Barang</h1>
        <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#newItemModal"><i class="fas fa-fw fa-plus"></i> Add New Item</a>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-image">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($shops as $product) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td>
                                <div class=" custom-image-size">
                                    <img src="<?= base_url('/uploads/') . $product['images']; ?>" alt="Product Image" class="img-thumbnail">
                                </div>
                            </td>

                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['quantity']; ?></td>
                            <td><?php echo $product['price']; ?></td>
                            <td>
                                <a href="" data-toggle="modal" data-target="#eeditSubMenuModal<?= $product['id'] ?>" class="badge badge-success"><i class="far fa-fw fa-edit"></i></a>
                                <a href="<?= base_url('admin/deleteshop/' . $product['id']) ?>" class="badge badge-danger" onclick="return confirm('Apakah anda yakin untuk menghapus <?= $product['id'] ?> ?')"><i class="far fa-fw fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


</div>


<!-- New Modal -->
<div class="modal fade" id="newItemModal" tabindex="-1" role="dialog" aria-labelledby="newItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newItemModalLabel">Add New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/addItem'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="images" name="images">
                            <label class="custom-file-label" for="images">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Item name">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Item Quantity">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="price" name="price" placeholder="Item Price" oninput="formatDecimal(this)" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Item deskripsi">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="diskon" name="diskon" placeholder="Item diskon Kusu Memeber" oninput="formatDecimal(this)" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End New Modal -->



<!-- Edit Modal -->
<?php foreach ($shops as $esm) : ?>
    <div class="modal fade" id="eeditSubMenuModal<?= $esm['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="eeditSubMenuModal<?= $esm['id'] ?>Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eeditSubMenuModal<?= $esm['id'] ?>Label">Add New Sub Menu</h5>
                    <buttond type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </buttond>
                </div>
                <form action="<?= base_url('admin/editItem/' . $esm['id']); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" value="<?= $esm['name']; ?>" placeholder="Item name">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" id="quantity" name="quantity" value="<?= $esm['quantity']; ?>" placeholder="Item Quantity">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="price" name="price" placeholder="Item Price" value="<?= $esm['price']; ?>" oninput="formatDecimal(this)" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $esm['deskripsi']; ?>" placeholder="Item deskripsi">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="diskon" name="diskon" placeholder="Item diskon Kusu Memeber" value="<?= $esm['diskon']; ?>" oninput="formatDecimal(this)" required>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<script>
    // Get the file input element
    const fileInput = document.getElementById('images');

    // Add event listener for file selection
    fileInput.addEventListener('change', function(event) {
        // Get the selected file name
        const fileName = event.target.files[0].name;

        // Update the label with the selected file name
        const label = document.querySelector('.custom-file-label');
        label.textContent = fileName;
    });


    function formatDecimal(input) {
        // Menghapus karakter non-digit kecuali titik desimal
        let value = input.value.replace(/[^\d.]/g, '');

        // Memastikan hanya ada satu titik desimal
        const decimalCount = value.split('.').length - 1;
        if (decimalCount > 1) {
            value = value.slice(0, value.lastIndexOf('.'));
        }

        // Memperbarui nilai input dengan format desimal
        input.value = value;
    }
</script>


<style>
    .custom-image-size img {
        margin: 1px;
        width: 300px;
        height: 150px;
    }
</style>



<?= $this->endSection(); ?>