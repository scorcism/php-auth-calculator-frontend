<?php

$errorMessage = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();
    include 'partials/_db.php';

    $otp = $_POST["otp"];

    $select_query = mysqli_query($conn, "select * from otp_check where otp='$otp' and is_expired!=1 and NOW()<=DATE_ADD(create_at,interval 5 minute)");

    $count = mysqli_num_rows($select_query);

    if ($count > 0) {
        $select_query = mysqli_query($conn, "update otp_check set is_expired=1 where otp='$otp'");
        $login = true;
        $_SESSION['loggedin'] = true;
        header("location: home.php");
    } else {
        $errorMessage = "Invalid OTP!";
    }
}


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if ($errorMessage) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $errorMessage . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <div class="container my-4">
        <h2 class="text-left fw-bolder">Enter OTP</h2>


        <form action="/calculator/otpverify.php" method="post">
            <div class="mb-3">
                <label for="otp" class="form-label">OTP:</label>
                <input type="number" class="form-control" id="otp" name="otp" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>