<?php
require("function.php");

// cek apakah user sudah ada atau belum
if (isset($_POST["register"])) {
    $result = registrasi($_POST);
    if ($result > 0) {
        echo "<script>
        alert('User baru berhasil dibuat');
        window.location.href = 'login.php';
        </script>";
    } elseif ($result == -1) {
        echo "<script>
        alert('Username sudah ada');
        </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRASI</title>

    <style>
        .form {
            width: 20%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 5%;
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 0 2em 0.4em 2em;
            background-color: #171717;
            border-radius: 25px;
            transition: transform 0.4s ease-in-out, border 0.4s ease-in-out;
            justify-content: center;
            align-items: center;
        }

        .form:hover {
            transform: scale(1.05);
            border: 1px solid black;
        }

        #heading {
            text-align: center;
            margin: 2em;
            color: #fff;
            font-size: 1.2em;
        }

        .field {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5em;
            padding: 0.6em;
            border-radius: 25px;
            background-color: #171717;
            box-shadow: inset 2px 5px 10px rgb(5, 5, 5);
            color: #fff;
        }

        .input-icon {
            height: 1.3em;
            width: 1.3em;
            fill: #fff;
        }

        .input-field {
            width: 100%;
            background: none;
            border: none;
            outline: none;
            color: #d3d3d3;
        }

        .form .btn {
            display: flex;
            justify-content: center;
            margin-top: 2.5em;
        }

        .button1,
        .button2,
        .button3 {
            padding: 0.5em;
            border-radius: 5px;
            border: none;
            outline: none;
            transition: background-color 0.4s ease-in-out, color 0.4s ease-in-out;
            background-color: #252525;
            color: #fff;
        }

        .button1 {
            padding: 0.5em 1.1em;
            margin-right: 0.5em;
        }

        .button1:hover {
            background-color: black;
        }

        .button2 {
            padding: 0.5em 2.3em;
        }

        .button1 a{
            color: white;
            text-decoration: none;
        }

        .button2:hover {
            background-color: black;
        }

        .button3 {
            margin-bottom: 3em;
        }

        .button3 a {
            color: white;
            text-decoration: none;
        }

        .button3:hover {
            background-color: red;
        }
    </style>
</head>

<body>



    <!-- new ui -->

    <form class="form" action="" method="post">
        <p id="heading">Sign up</p>
        <div class="field">
            <input autocomplete="off" placeholder="Nama Depan" class="input-field" type="text" type="text" name="namaDepan">
        </div>
        <div class="field">
            <input autocomplete="off" placeholder="Nama Belakang" class="input-field" type="text" type="text" name="namaBelakang">
        </div>
        <div class="field">
            <input autocomplete="off" placeholder="Usernamae" class="input-field" type="text" type="text" name="username">
        </div>
        <div class="field">
            <input placeholder="Password" class="input-field" type="password" name="password">
        </div>
        <div class="field">
            <input placeholder="Verifkasi Password" class="input-field" type="password" name="ver">
        </div>
        <div class="btn">
            <button class="button1" type="submit" name="login"><a href="login.php">Login</a></button>
            <button class="button2" name="register">Sign up</button>
        </div>
        <button class="button3"><a href="index.php">Back</a></button>
    </form>

</body>

</html>