<?php
session_start();
require("function.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $_SESSION['cart'] = [];
    header("Location: index.php");
    exit;
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="text-center">Checkout</h2>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Total Harga: <?= $total ?>K</h4>
                        <form action="" method="post" class="mt-4">
                            <button type="submit" class="btn btn-success btn-block">Confirm Purchase</button>
                        </form>
                        <a href="index.php" class="btn btn-link btn-block mt-3">Back to Product List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>