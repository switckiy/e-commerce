<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#newItemModal"><i class="fas fa-fw fa-plus"></i> Add New Karyawan</a>
    </div>
    <div class="row">
        <div class="col-lg">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name Karyawan</th>
                        <th scope="col">Poin Karyawan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($karyawan as $user) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $user['name']; ?></td>
                            <?php $jumlahPoin = false; ?>
                            <?php foreach ($datas as $users) : ?>
                                <?php if ($users->karyawan == $user['name']) : ?>
                                    <td>Jumlah Poin: <?= $users->jumlah; ?></td>
                                    <?php $jumlahPoin = true; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if (!$jumlahPoin) : ?>
                                <td>Jumlah Poin: -</td>
                            <?php endif; ?>
                            <td>
                                <a href="<?= base_url('Karyawans/deleteKaryawan/' . $user['id']) ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus <?= $user['name'] ?> ?')">
                                    <i class="far fa-fw fa-trash-alt"></i>
                                </a>
                                <a href="<?= base_url('Karyawans/generatePDF/' . $user['id']) ?>" class="btn btn-info">
                                    <i class="fa-solid fa-circle-question"></i>
                                </a>
                            </td>
                        </tr>
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
            <form action="<?= base_url('Karyawans/addkaryawan'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name karyawan">
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

<?= $this->endSection(); ?>