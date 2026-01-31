<?php
session_start();
include 'config.php';
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}
?>

<h2>KASIR MINI</h2>

<form method="post">
    Barcode:
    <input type="text" name="barcode" autofocus>
    Qty:
    <input type="number" name="qty" value="1">
    <button name="add">Tambah</button>
</form>

<hr>
<table border="1" cellpadding="5">
<tr>
    <th>Barang</th>
    <th>Harga</th>
    <th>Qty</th>
    <th>Subtotal</th>
</tr>

<?php
$total = 0;
if (isset($_POST['add'])) {
    $b = $_POST['barcode'];
    $q = (int)$_POST['qty'];

    $barang = mysqli_query($conn, "SELECT * FROM barang WHERE barcode='$b'");
    $row = mysqli_fetch_assoc($barang);

    if ($row) {
        $sub = $row['harga'] * $q;
        $total += $sub;

        // kurangi stok
        mysqli_query($conn,
            "UPDATE barang SET stok=stok-$q WHERE id=".$row['id']
        );

        echo "<tr>
            <td>{$row['nama']}</td>
            <td>{$row['harga']}</td>
            <td>$q</td>
            <td>$sub</td>
        </tr>";
    }
}
?>
<tr>
    <td colspan="3"><b>Total</b></td>
    <td><b><?= $total ?></b></td>
</tr>
</table>
