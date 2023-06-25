<!DOCTYPE html>
<html>

<head>
    <title>Nota Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 60px;
        }

        .header-info {
            text-align: right;
            display: flex;
            /* Added */
            justify-content: flex-end;
            /* Added */
        }

        .header-info p {
            margin: 1;
        }

        .header-info p:first-child {
            margin-right: 130px;
            /* Added */
        }

        .footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <p><strong>Nota Pembayaran</strong></p>
        <div class="header-info">
            <p><strong>Nama:</strong> <?= $allData['name']; ?></p>
            <p><strong>Tanggal:</strong> <?= $allData['date']; ?></p>
        </div>
    </div>
    <br>
    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Quantity</th>
                <th>Harga</th>
                <th>Total</th>
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
        </tbody>
    </table>
    <p><strong>Total Pembayaran: </strong> Rp <?= $allData['order_total']; ?></p>
    <p><strong>Status: </strong><?= $allData['stats']; ?></p>

    <div class="footer">
        <p>Alamat: <?= $allData['catatan']; ?></p>
    </div>
</body>

</html>