<?php
require("function.php");

$result = $conn->query("SELECT * FROM products");

session_start();
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
    header("Location: cart.php");
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
    header("Location: cart.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* new */
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200&display=swap');

        body {
            font-family: 'Manrope', sans-serif;
            background: #eee;
        }

        .size span {
            font-size: 7px;
        }

        .color span {
            font-size: 7px;
        }

        .product-deta {
            margin-right: 70px;
        }

        .gift-card:focus {
            box-shadow: none;
        }

        .pay-button {
            color: #fff;
        }

        .pay-button:hover {
            color: #fff;
        }

        .pay-button:focus {
            color: #fff;
            box-shadow: none;
        }

        .text-grey {
            color: #a39f9f;
        }

        .qty i {
            font-size: 7px;
        }

        /* button back */
        button {
            display: flex;
            height: 3em;
            width: 100px;
            align-items: center;
            justify-content: center;
            background-color: #eeeeee4b;
            border-radius: 3px;
            letter-spacing: 1px;
            transition: all 0.2s linear;
            cursor: pointer;
            border: none;
            background: #fff;
        }

        button>svg {
            margin-right: 5px;
            margin-left: 5px;
            font-size: 20px;
            transition: all 0.4s ease-in;
        }

        button:hover>svg {
            font-size: 1.2em;
            transform: translateX(-5px);
        }

        button:hover {
            box-shadow: 9px 9px 33px #d1d1d1, -9px -9px 33px #ffffff;
            transform: translateY(-2px);
        }

        button span a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>


    <!-- new ui -->
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-8">
                <div class="p-2">
                    <h4>Shopping cart</h4>
                </div>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $item) :
                    $item_total = $item['price'] * $item['quantity'];
                    $total += $item_total;
                ?>
                    <div class="d-flex flex-row justify-content-between align-items-center p-2 bg-white mt-4 px-3 rounded">
                        <!-- <div class="mr-1"><img class="rounded" src="https://i.imgur.com/XiFJkhI.jpg" width="70"></div> -->
                        <div class="d-flex flex-column align-items-center product-details"><span class="font-weight-bold"><?= htmlspecialchars($item['product_name']) ?></span>
                            <div class="d-flex flex-row product-desc">
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center qty">
                            <h4> <a class="text-decoration-none text-danger m-2" href=" cart.php?remove=<?= $item['products_id'] ?>">-</a>
                                <h5 class="text-grey mt-1 mr-1 ml-1"><?= htmlspecialchars($item['quantity']) ?></h5>
                                <h4> <a class="text-decoration-none text-danger m-2" href=" cart.php?add=<?= $item['products_id'] ?>">+</a>
                                </h4>
                        </div>
                        <div>
                            <h5 class="text-grey"><?= htmlspecialchars($item['price']) ?><span>K</span></h5>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="d-flex flex-row align-items-center mt-3 p-2 bg-white rounded"><input type="text" class="form-control border-0 gift-card" placeholder="TOTAL: <?= htmlspecialchars($total) ?>">
                    <div class="d-flex flex-row align-items-center p-1 bg-white rounded"><button class="btn btn-warning btn-block pb-2 pay-button" type="button"><a class="text-decoration-none text-white" href="checkout.php">Checkout</a></button></div>
                </div>
            </div>
        </div>
        <button>
            <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024">
                <path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path>
            </svg>
            <span><a href="index.php">Back</a></span>
        </button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</body>

</html>