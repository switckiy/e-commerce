<!DOCTYPE html>
<html>

<head>
    <title>PDF Template</title>

</head>
<style>
    body {
        font-size: 14px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
</style>

<body>
    <div class="container">
        <h1>Bon</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 40%;">Produk</th>
                    <th style="width: 30%;">Harga</th>
                    <th style="width: 20%;">Quantity</th>
                    <th style="width: 30%;">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row) : ?>
                    <tr>
                        <td><?= $row->name_product; ?></td>
                        <td><?= $row->quantity; ?></td>
                        <td>Rp <?= $row->price; ?></td>
                        <td>Rp <?= $row->total; ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="1" style="text-align: right;"><strong>Status :</strong></td>
                    <td><strong><?= $row->stats; ?></strong></td>
                    <td colspan="1" style="text-align: right;"><strong>Total:</strong></td>
                    <td><strong>Rp <?= $row->order_total; ?></strong></td>
                </tr>

            </tbody>



        </table>
    </div>
</body>


</body>

</html>