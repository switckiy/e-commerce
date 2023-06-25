<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    </div>

    <div class="row">
        <div class="col-lg">
            <!-- Tabel Data -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Karyawan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ongkir</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($results as $dats) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $dats->username; ?></td>
                            <td><?= $dats->karyawan; ?></td>
                            <td><?= $dats->stats; ?></td>
                            <td><?= $dats->ongkos; ?></td>
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $dats->id; ?>">Edit</button>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal<?= $dats->id; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $dats->id; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel<?= $dats->id; ?>">Edit Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= base_url('admin/update/' . $dats->id); ?>" method="POST">
                                            <div class="form-group">
                                                <label for="karyawan">Karyawan</label>
                                                <select class="form-control" id="karyawan" name="karyawan" required>
                                                    <?php foreach ($karyawan as $row) : ?>
                                                        <option value="<?= $row['name']; ?>" <?= ($row['id'] == $dats->karyawan) ? 'selected' : ''; ?>>
                                                            <?= $row['name']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="stats">Status</label>
                                                <select class="form-control" id="stats" name="stats" required>
                                                    <option value="Sedang Diproses" <?= $dats->stats == 'Sedang Diproses' ? 'selected' : ''; ?>>Sedang Diproses</option>
                                                    <option value="Sedang Di Antar" <?= $dats->stats == 'Sedang Di Antar' ? 'selected' : ''; ?>>Sedang Di Antar</option>
                                                    <option value="Selesai" <?= $dats->stats == 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="stats">Ongkos Kirim</label>
                                                <input type="text" class="form-control" id="ongkos" name="ongkos" value="<?= $dats->ongkos; ?>" placeholder="<?= $dats->ongkos; ?>" oninput="formatDecimal(this)" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Edit -->
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- End Tabel Data -->
        </div>
    </div>


</div>
<script>
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
<!-- End New Modal -->
<?= $this->endSection(); ?>