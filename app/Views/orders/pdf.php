<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h3 { text-align: center; }
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid #000; padding:6px; }
        th { background:#f2f2f2; }
    </style>
</head>
<body>

<h3>NOTA PEMESANAN</h3>

<table>
    <tr>
        <td>No Order</td>
        <td><?= $header['order_number'] ?></td>
    </tr>
    <tr>
        <td>Pelanggan</td>
        <td><?= $header['customers_name'] ?></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td><?= $header['delivery_address'] ?></td>
    </tr>
    <tr>
        <td>Restaurant</td>
        <td><?= $header['restaurants_name'] ?></td>
    </tr>
</table>

<br>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Menu</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($detail as $d): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $d['name'] ?></td>
            <td><?= $d['qty'] ?></td>
            <td><?= number_format($d['price']) ?></td>
            <td><?= number_format($d['subtotal']) ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <th colspan="4">Total Bayar</th>
            <th><?= number_format($header['total_amount']) ?></th>
        </tr>
    </tbody>
</table>

</body>
</html>
