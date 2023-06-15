<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Date Chekout</th>
                        <th scope="col">Status</th>
                        <th scope="col">print</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($results as $dats) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $dats->username; ?></td>
                            <td><?= $dats->tanggal; ?></td>
                            <td><?= $dats->stats; ?></td>
                            <td>
                                <a href="<?= base_url('user/generatePDF/' . $dats->id); ?>" class="btn btn-info">Details</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>