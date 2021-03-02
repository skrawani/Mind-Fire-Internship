<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSS Files -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./assets/css/style.css" />

    <title>Registration Page</title>
  </head>
  <body>
    <?php 
    // starting the session
    session_start();
    include_once("./backend/form_validate.php");
    ?>
    <div
      class="d-flex justify-content-center align-content-center align-items-center"
    >
      <!-- input types are text and required atrribute is not used to skip html validation -->
      <form
        class="p-4 rounded"
        name="myform"
        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
        method="POST"
      >
        <h4 class="text-center pb-2">Registration Form</h4>
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>" />
          <p
            id="msg-email"
            class=" <?php if($emailErr == "") echo "d-none"  ?>  w-100  text-center rounded border bg-error border-danger text-danger"
          > <?php echo $emailErr; ?></p>
        </div>

        <div class="form-group">
          <label for="name"> Name </label>
          <input type="text" name="name" id="name" class="form-control" value="<?php echo $name ?>" />
          <p
            id="msg-name"
            class=" <?php if($nameErr == "") echo "d-none"  ?>  w-100  text-center rounded border bg-error border-danger text-danger"
          > <?php echo $nameErr; ?></p>
        </div>

        <div class="form-group">
          <label for="gender"> Gender </label>
          <br />
          <div class="form-check-inline">
            <label class="form-check-label">
              <input
                type="radio"
                class="form-check-input"
                name="gender"
                value="male"
                <?php if($gender === "male")  echo "checked"?>
              />
              Male
            </label>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input
                type="radio"
                class="form-check-input"
                name="gender"
                value="female"
                <?php if($gender === "female")  echo "checked"?>
              />
              Female
            </label>
          </div>
          <div class="form-check-inline disabled">
            <label class="form-check-label">
              <input
                type="radio"
                style="
                  padding: 200px;
                  background-color: #f0ffff;
                  border: 1px solid red;
                "
                name="gender"
                value="other"
                <?php if($gender === "other")  echo "checked"?>
              />
              Other
            </label>
          </div>
          <p
            id="msg-gender"
            class=" <?php if($genderErr == "") echo "d-none"  ?>  w-100  text-center rounded border bg-error border-danger text-danger"
          > <?php echo $genderErr; ?></p>
        </div>

        <div class="form-group">
          <label for="phone"> Phone No </label>
          <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone ?>" />
          <p
            id="msg-phone"
            class=" <?php if($phoneErr == "") echo "d-none"  ?>  w-100  text-center rounded border bg-error border-danger text-danger"
          > <?php echo $phoneErr; ?></p>
        </div>

        <div class="form-group">
          <label for="password"> Password </label>
          <input type="password" class="form-control" id="password" name="pass" value="<?php echo $pass ?>" />
          <div
            id="msg-pass"
            class=" <?php if($passErr == "") echo "d-none"  ?>  w-100   rounded border bg-error border-danger text-danger"
          >
           <?php echo $passErr; ?>
          </div>
        </div>

        <div class="form-group">
          <label for="cpassword"> Confirm Password </label>
          <input type="password" class="form-control" id="cpassword" name="cpass" value="<?php echo $cpass ?>" />
          <p
            id="msg-cpass"
            class=" <?php if($cpassErr == "") echo "d-none"  ?>  w-100  text-center rounded border bg-error border-danger text-danger"
          > <?php echo $cpassErr; ?></p>
        </div>

        <button type="submit" class="btn btn-primary float-right">
          Submit
        </button>
      </form>
    </div>
    <!-- Imported External JS -->
  </body>
</html>
