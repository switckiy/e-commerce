<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">About Edit</h1>
    <div class="row">
        <div class="col-lg-10">
            <form action="<?= site_url('admin/about') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('/img/') . $images; ?>" class="img-thumbnail">
                            </div>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="images" name="images">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $titles; ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" required><?= $description; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <script>
                // Get the file input element
                const fileInput = document.getElementById('images   ');

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
        </div>
    </div>
</div>
<?= $this->endSection(); ?>