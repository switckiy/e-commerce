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
    <h1>Data Antar Karyawan </h1>


    <h2>Data Karyawan</h2>
    <table>
        <tr>
            <th>Karyawan</th>
            <th>Jumlah Antar</th>
        </tr>
        <?php foreach ($data1 as $item) : ?>
            <tr>
                <td><?= $item->name ?></td>
                <td><?= $item->jumlah_nama_karyawan ?></td>
            </tr>
        <?php endforeach; ?>
    </table>



    <h2>Data Barang</h2>
    <table>
        <tr>
            <th>Karyawan</th>
            <th>Tanggal</th>
            <th>Nama Produk</th>
            <th>Quantity</th>

            <th>Tanggal</th>
        </tr>
        <?php foreach ($data as $item) : ?>
            <tr>
                <td><?= $item->karyawan ?></td>
                <td><?= $item->tanggal ?></td>
                <td><?= $item->name_product ?></td>
                <td><?= $item->quantity ?></td>
                <td><?= $item->date ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>