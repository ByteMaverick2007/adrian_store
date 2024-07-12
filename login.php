<?php
require("function.php");

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM regis WHERE username = '$username'");

    //cek username

    if (mysqli_num_rows($result) === 1) {

        //cek pw
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            header("Location:index.php");
            exit;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>



    <style>


        .form {
            width: 20%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 10%;
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

        .button2:hover {
            background-color: black;
        }

        .button2 a{
            color: white;
            text-decoration: none;
        }

        .button3 {
            margin-bottom: 3em;
        }

        .button3:hover {
            background-color: red;
        }
    </style>
</head>

<body>

    <?php if (isset($error)) : ?>

        <p style="color: red; font-style:italic;">username/password salah </p>

    <?php endif; ?>

    <!-- new ui -->

    <form class="form" action="" method="post">
        <p id="heading">Login</p>
        <div class="field">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path>
            </svg>
            <input autocomplete="off" placeholder="Username" class="input-field" type="text" name="username">
        </div>
        <div class="field">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
            </svg>
            <input placeholder="Password" class="input-field" type="password" name="password">
        </div>
        <div class="btn">
            <button class="button1" type="submit" name="login">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
            <button class="button2"><a href="regis.php">Sign up</a></button>
        </div>
        <button class="button3">Forgot Password</button>
    </form>
</body>

</html>