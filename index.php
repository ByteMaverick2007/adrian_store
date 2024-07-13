<?php
session_start();
require("function.php");

$result = $conn->query("SELECT * FROM products");
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['add'])) {
    $id = $_GET['add'];
    $product = $conn->query("SELECT * FROM products WHERE products_id=$id")->fetch_assoc();
    if ($product) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
        } else {
            $product['quantity'] = 1;
            $_SESSION['cart'][$id] = $product;
        }
    }
    header("Location: index.php");
    exit;
}

if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    if (isset($_SESSION['cart'][$id])) {
        if ($_SESSION['cart'][$id]['quantity'] > 1) {
            $_SESSION['cart'][$id]['quantity']--;
        } else {
            unset($_SESSION['cart'][$id]);
        }
    }
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function confirmLogout() {
            if (confirm("Apakah kamu yakin ingin Log out?")) {
                window.location.href = "logout.php";
            }
        }
    </script>
</head>

<body class="bg-gray-100">

    <!-- Navigation Bar -->
    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">My Shop</h1>
            <ul class="flex space-x-4">
                <li>
                    <a href="cart.php" class="flex items-center hover:underline">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.34 2M7 13h10l1.38-7H6.34L5 4H3m0 0h2l.34 2m0 0h12.64l1.38-7H6.34L5 4H3m4 10v6m0 0H7m0 0v6m4-6v6m0 0h-2m0 0v6m8-6v6m0 0h-2m0 0v6m-4-6v6m0 0h-2m0 0v6"></path>
                        </svg>
                        Keranjang
                    </a>
                </li>
                <li><button onclick="confirmLogout()" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded">Log out</button></li>
            </ul>
        </div>
    </nav>

    <!-- Product List -->
    <div class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4">
                    <h2 class="text-lg font-semibold"><?= htmlspecialchars($row['product_name']) ?></h2>
                    <p class="text-gray-700">Product description. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <div class="flex items-center justify-between mt-4">
                        <span class="text-gray-900 font-bold"><?= htmlspecialchars($row['price']) ?>K</span>
                        <a href="index.php?add=<?= $row['products_id'] ?>" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Add to Cart
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

</body>

</html>