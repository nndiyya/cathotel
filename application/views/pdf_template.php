<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>Invoice</h2>
    <p>Alamat Tujuan: <?php echo $alamat; ?></p>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $total_harga = 0;
            foreach ($keranjang as $k) { 
                $total_per_item = $k['quantity'] * $k['product_harga']; 
                $total_harga += $total_per_item;
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $k['nama_barang']; ?></td>
                    <td><?php echo $k['quantity']; ?></td>
                    <td>Rp. <?php echo number_format($k['product_harga'], 0, ',', '.'); ?></td>
                    <td>Rp. <?php echo number_format($total_per_item, 0, ',', '.'); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <p>Total Harga: Rp. <?php echo number_format($total_harga, 0, ',', '.'); ?></p>
</body>

</html>