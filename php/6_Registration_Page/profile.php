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

<body style="height: 100vh">
  <?php
  var_dump($_POST)
  ?>
  <section>
    <div class="bg-img" style="height: 15vh"></div>
    <div style="position: relative; top: -5rem" class="d-flex flex-column justify-content-center align-content-center align-items-center">
      <img class="profile-img rounded-circle pb-2" src="./assets/images/profile_user.jpg" alt="" srcset="" />
      <span id="name" class="font-weight-bold"><?php echo $_POST["name"] ?></span>
      <span id="phone">+91 <?php echo $_POST["phone"] ?></span>
      <a href="mailto:<?php echo $_POST['email'] ?>" class="email text-primary"><?php echo $_POST["email"] ?></a>
    </div>
  </section>
  <section class="d-flex flex-column justify-content-center align-content-center align-items-center" style="position: relative; top: -5vh">
    <div class="container d-flex flex-column justify-content-center">
      <div class="row py-3 justify-content-center">
        <span class="col-0 col-md-3 col-lg-3"></span>
        <span class="col-4">Date of Birth:</span>
        <span class="col-5"><?php echo $_POST["dob"] ?></span>
      </div>
      <div class="row py-3 justify-content-center">
        <span class="col-0 col-md-3 col-lg-3"></span>
        <span class="col-4">Gender:</span>
        <span class="col-5"><?php echo $_POST["gender"] ?></span>
      </div>
      <div class="row py-3 justify-content-center">
        <span class="col-0 col-md-3 col-lg-3"></span>
        <span class="col-4">Skills:</span>
        <span class="col-5">
          <?php
          echo implode(", ", $_POST["skill"]);
          ?>
        </span>
      </div>
      <div class="row py-3 justify-content-center">
        <span class="col-0 col-md-3 col-lg-3"></span>
        <span class="col-4">About:</span>
        <span class="col-5"><?php echo $_POST["about"] ?></span>
      </div>
      <div class="row py-3 justify-content-center">
        <span class="col-0 col-md-3 col-lg-3"></span>
        <span class="col-4">Address:</span>
        <span class="col-5"><?php echo $_POST["addr"] ?></span>
      </div>
      <div class="row py-3 justify-content-center">
        <span class="col-0 col-md-3 col-lg-3"></span>
        <span class="col-4">Highest Education Qualification:</span>
        <span class="col-5">Bachelors </span>
      </div>
      <div class="row py-3 justify-content-center">
        <span class="col-0 col-md-3 col-lg-3"></span>
        <span class="col-4">Interests:</span>
        <div class="col-5">
          <?php echo implode(", ", $_POST["interests"]); ?>

        </div>
      </div>
      <div class="row py-3 justify-content-center">
        <span class="col-0 col-md-3 col-lg-3"></span>
        <span class="col-4">LinkedIn:</span>
        <span class="col-5"><?php echo $_POST["linkedin"] ?></span>
      </div>
      <div class="row py-3 justify-content-center">
        <span class="col-0 col-md-3 col-lg-3"></span>
        <span class="col-4">Github:</span>
        <span class="col-5"><?php echo $_POST["github"] ?></span>
      </div>
    </div>
  </section>
</body>

</html>