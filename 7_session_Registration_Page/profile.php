<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" href="./assets/css/style.css" />

  <title>Document</title>
</head>

<body>
  <?php
  session_start();
  var_dump($_SESSION)
  ?>
  <section>
    <div class="bg-img"></div>
    <div id="head" class="d-flex flex-column justify-content-center align-content-center align-items-center">
      <img class="profile-img rounded-circle pb-2" src="<?php echo $_SESSION["img"] ?>" alt="" srcset="" />
      <span id="name" class="font-weight-bold"><?php echo $_SESSION["name"] ?></span>
      <span id="phone">+91 <?php echo $_SESSION["phone"] ?></span>
      <a href="mailto:<?php echo $_SESSION['email'] ?>" class="email text-primary"><?php echo $_SESSION["email"] ?></a>
    </div>
  </section>
  <section id="details" class="d-flex flex-column justify-content-center align-content-center align-items-center">
    <div class="container d-flex flex-column justify-content-center">
      <div class="row py-3 justify-content-center">
        <span class="col-0 col-md-3 col-lg-3"></span>
        <span class="col-4">Date of Birth:</span>
        <span class="col-5"><?php echo $_SESSION["dob"] ?></span>
      </div>
      <div class="row py-3 justify-content-center">
        <span class="col-0 col-md-3 col-lg-3"></span>
        <span class="col-4">Gender:</span>
        <span class="col-5"><?php echo $_SESSION["gender"] ?></span>
      </div>
      <div class="row py-3 justify-content-center">
        <span class="col-0 col-md-3 col-lg-3"></span>
        <span class="col-4">Skills:</span>
        <span class="col-5">
          <?php
          echo implode(", ", $_SESSION["skill"]);
          ?>
        </span>
      </div>
      <div class="row py-3 justify-content-center">
        <span class="col-0 col-md-3 col-lg-3"></span>
        <span class="col-4">About:</span>
        <span class="col-5"><?php echo $_SESSION["about"] ?></span>
      </div>
      <div class="row py-3 justify-content-center">
        <span class="col-0 col-md-3 col-lg-3"></span>
        <span class="col-4">Address:</span>
        <span class="col-5"><?php echo $_SESSION["addr"] ?></span>
      </div>
      <div class="row py-3 justify-content-center">
        <span class="col-0 col-md-3 col-lg-3"></span>
        <span class="col-4">Highest Education Qualification:</span>
        <span class="col-5"><?php echo $_SESSION["education"] ?></span>
      </div>
      <div class="row py-3 justify-content-center">
        <span class="col-0 col-md-3 col-lg-3"></span>
        <span class="col-4">Interests:</span>
        <div class="col-5">
          <?php echo implode(", ", $_SESSION["interests"]); ?>
        </div>
      </div>
      <div class="row py-3 justify-content-center">
        <span class="col-0 col-md-3 col-lg-3"></span>
        <span class="col-9 col-md-4 col-lg-4">LinkedIn:</span>
        <a href="<?php echo $_SESSION['linkedin'] ?>" class="col-9 col-md-5 col-lg-5"><?php echo $_SESSION["linkedin"] ?></a>
      </div>
      <div class="row py-3 justify-content-center">
        <span class="col-0 col-md-3 col-lg-3"></span>
        <span class="col-9 col-md-4 col-lg-4">Github:</span>
        <a href="<?php echo $_SESSION['github'] ?>" class="col-9 col-md-5 col-lg-5"><?php echo $_SESSION["github"] ?></a>
      </div>
    </div>
  </section>
</body>

</html>