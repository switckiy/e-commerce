<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Profile</h1>
    <div class="row">
        <div class="col-lg-8">
            <form action="<?= base_url('user/updateProfile'); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="<?= user()->email; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Full name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?= user()->username; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Picture</div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('/img/') . user()->user_image; ?>" class="img-thumbnail">
                            </div>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </form>
            <script>
                // Get the file input element
                const fileInput = document.getElementById('image');

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