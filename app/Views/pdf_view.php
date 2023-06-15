<!DOCTYPE html>
<html>

<head>
    <title>Data PDF</title>
    <style>
        /* CSS styling untuk tampilan PDF */
        @page {
            size: landscape;
        }

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
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Data PDF</h1>

    <h2>Query Pertama</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Negara</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Kode Pos</th>
            <th>Telp</th>
            <th>Catatan</th>
            <th>Order Total</th>
            <th>Status</th>
            <th>Karyawan</th>
            <th>Tanggal</th>
            <th>Nama Produk</th>
            <th>Gambar</th>
            <th>Quantity</th>
            <th>Harga</th>
            <th>Total</th>
            <th>Tanggal</th>
            <th>Nama</th>
        </tr>
        <?php foreach ($data as $item) : ?>
            <tr>
                <td><?= $item->id ?></td>
                <td><?= $item->user_id ?></td>
                <td><?= $item->negara ?></td>
                <td><?= $item->alamat ?></td>
                <td><?= $item->kota ?></td>
                <td><?= $item->kode_pos ?></td>
                <td><?= $item->telp ?></td>
                <td><?= $item->catatan ?></td>
                <td><?= $item->order_total ?></td>
                <td><?= $item->stats ?></td>
                <td><?= $item->karyawan ?></td>
                <td><?= $item->tanggal ?></td>
                <td><?= $item->name_product ?></td>
                <td><?= $item->images ?></td>
                <td><?= $item->quantity ?></td>
                <td><?= $item->price ?></td>
                <td><?= $item->total ?></td>
                <td><?= $item->date ?></td>
                <td><?= $item->name ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Query Kedua</h2>
    <table>
        <tr>
            <th>Karyawan</th>
            <th>Jumlah</th>
        </tr>
        <?php foreach ($datas as $item) : ?>
            <tr>
                <td><?= $item->karyawan ?></td>
                <td><?= $item->jumlah ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Query Ketiga</h2>
    <table>
        <tr>
            <th>Nama Produk</th>
            <th>Total Quantity</th>
        </tr>
        <?php foreach ($data2 as $item) : ?>
            <tr>
                <td><?= $item->name_product ?></td>
                <td><?= $item->total_quantity ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>