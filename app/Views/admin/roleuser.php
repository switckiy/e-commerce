<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-4 text-gray-800">Role User</h1>
        <a href="<?= base_url('/admin/listuser'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-fw fa-minus"></i> Back</a>
    </div>

    <div class="row">
        <div class="col-lg">
            <table class="table">
                <thead>
                    <tr>
                        <?php foreach ($datas as $data) : ?>
                            <?php if ($data->id !== 1) : ?> <!-- Exclude ID 1 -->
                                <th scope="col"><?= $data->name; ?></th>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($datas as $data) : ?>
                            <?php if ($data->id !== 1) : ?> <!-- Exclude ID 1 -->
                                <td>
                                    <div class="form-check">
                                        <?php
                                        $checked = ''; // Default unchecked state
                                        foreach ($role as $row) {
                                            if ($row->group_id == $data->id) {
                                                $checked = 'checked'; // Mark as checked if data exists
                                                break;
                                            }
                                        }
                                        ?>
                                        <input class="form-check-input" type="checkbox" value="<?= $data->id; ?>" id="role<?= $data->id; ?>" name="role" style="transform: scale(1);" <?= $checked; ?>>
                                    </div>
                                </td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Get all the checkboxes
    const checkboxes = document.querySelectorAll('input[name="role"]');

    // Add event listener to each checkbox
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const roleId = this.value;
            const isChecked = this.checked;
            const userId = <?= $userid ?>; // Get the userid from PHP

            // Send an asynchronous request to the controller
            fetch(`/admin/updaterole/${userId}`, { // Include the userid in the URL
                    method: 'POST',
                    body: JSON.stringify({
                        roleId,
                        isChecked,
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the response if needed
                    console.log(data);
                })
                .catch(error => {
                    // Handle errors if any
                    console.error(error);
                });
        });
    });
</script>


<?= $this->endSection(); ?>