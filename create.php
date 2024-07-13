<?php
require("function.php");

if (
    !isset($_SESSION['login'])
) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $conn->query("INSERT INTO products (product_name, price, quantity) VALUES ('$product_name', '$price', '$quantity')");
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>

<body>
    <h1>Tambah Produk</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="product_name">Nama Produk :</label>
                <input type="text" name="product_name" id="product_name">
            </li>
            <li>
                <label for="price">Harga :</label>
                <input type="text" name="price" id="price">
            </li>
            <li>
                <label for="quantity">Stok Tersedia:</label>
                <input type="text" name="quantity" id="quantity">
            </li>
            <li>
                <button type="submit" name="submit">Tambah</button>
            </li>
        </ul>
    </form>
</body>

</html>