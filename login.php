<?php
$login = false;
$errorMessage = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'partials/_db.php';

  $email = $_POST["email"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM users WHERE email='$email'";

  $result = mysqli_query($conn, $sql);

  $num = mysqli_num_rows($result);

  if ($num == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $row['password'])) {
        session_start();
        // $login = true;
        // $_SESSION['loggedin'] = true;
        $_SESSION['user'] = $email;
        $otp = rand(10000, 99999); //Generate OTP
        include("SMTP/class.phpmailer.php");
        include("SMTP/class.smtp.php");

        $message = '<div>
     <p><b>Hello!</b></p>
     <p>You are recieving this email because we recieved a OTP request for your account.</p>
     <br>
     <p>Your OTP is: <b>' . $otp . '</b></p>
     <br>
     <p>If you did not request OTP, no further action is required.</p>
     <p>~ scor32k</p>
    </div>';

        $email = $email;
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = "scorcismweb@gmail.com"; // Enter your username
        $mail->Password = "bkagwisjmilpjpzp"; // Enter Password
        $mail->FromName = "calculator - scor32k";
        $mail->AddAddress($email);
        $mail->Subject = "OTP";
        $mail->isHTML(TRUE);
        $mail->Body = $message;

        if ($mail->send()) {

          $insert_query = mysqli_query($conn, "
          INSERT INTO `otp_check` (`otp`, `is_expired`, `create_at`, `email`) VALUES ('$otp', '0', current_timestamp(), '$email');
          ");

          header('location:otpverify.php');

        } else {
          $errorMessage = "Email not delivered";
        }
      } else {
        $errorMessage = "Invalid Credentialsssssssssssssssssss";
      }
    }
  } else {
    $errorMessage = "Invalid credentialswwwwwwwwwwwwww";
  }

}

?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Calculator</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
  <?php require 'partials/_nav.php' ?>

  <?php

  if ($login) {
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are now logged in
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
    <h2 class="text-left fw-bolder">Login to access the calculator</h2>


    <form action="/calculator/login.php" method="post">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <button type="submit" class="btn btn-primary">Send OTP</button>
    </form>


  </div>
  <?php require 'partials/_footer.php' ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
</body>

</html>