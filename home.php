<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: login.php");
  exit;
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
    <script src="./scripts/script.js" defer></script>
</head>

<body>
  <?php require 'partials/_nav.php' ?>
  <div class="container">
    <div class="py-2 my-2  bg-secondary-subtle" style="">
      <h1 class="fs-5">Welcome,
        <span style="fw-bold">
          <?php echo $_SESSION["user"] ?>
        </span>
      </h1>
    </div>

    <div>
      <h4><b>Access your personal calculator</b></h4>
      <div class="mb-3">
        <label for="num1" class="form-label">Number 1</label>
        <input type="number" class="form-control" id="num1" name="num1" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="num2" class="form-label">Number 2</label>
        <input type="number" class="form-control" id="num2" name="num2">
      </div>
      <div class="mb-3 d-flex gap-3" role="group" aria-label="Basic example">
        <button type="button" id="add" class="btn btn-outline-primary">Add</button>
        <button type="button" id="sub" class="btn btn-outline-danger">Subtract</button>
        <button type="button" id="mul" class="btn btn-outline-warning">Multiply</button>
        <button type="button" id="div" class="btn btn-outline-secondary">Division</button>
        <button type="button" id="mod" class="btn btn-outline-info">MOD </button>
        <button type="button" id="clear" class="btn  btn-outline">CLEAR</button>
      </div>
      <div class="p-1 my-2  bg-dark-subtle " style="">
        <h1 class="fs-5 px-1 d-flex flex-row">
          <p id="n1"> </p>
          <p id="op">  </p>
          <p id="n2"> </p>
          <p id="equal"></p>
          <p id=""> <b id="ans"></b> </p>
        </h1>
      </div>
    </div>

  </div>
  



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
</body>

</html>