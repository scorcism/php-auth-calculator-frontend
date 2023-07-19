<?php

$showAlert = false;
$errorMessage = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include "partials/_db.php";


    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // check user existance
    $existUser = "SELECT * FROM `users` WHERE email = '$email' ";
    $result = mysqli_query($conn, $existUser);
    $rowCount = mysqli_num_rows($result);

    if ($rowCount > 0) {
        $errorMessage = "User already exists";
    } else {
        if ((strlen($password) > 5 && strlen($cpassword) > 5 && strlen($email) > 2)) {

            if (($password == $cpassword)) {
                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO `users` ( `email`, `password`, `date`) VALUES ( '$email', '$password_hash', current_timestamp())";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $showAlert = true;
                }
                sleep(4);
                header("location: login.php");

            } else {
                $errorMessage = "Passwords do not match!!";
            }
        } else {
            $errorMessage = "Password length should be >5!!";
        }
    }

}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup - Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <?php require 'partials/_nav.php' ?>

    <?php
    if ($showAlert) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sucess!</strong> You account is now created you can login .
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>

    <?php
    if ($errorMessage) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $errorMessage . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>


    <div class="container my-4">
        <h2 class="text-left fw-bolder">Singup</h2>

        <form action="/calculator/signup.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
    <?php require 'partials/_footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>