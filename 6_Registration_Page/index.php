<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
  <link rel="stylesheet" href="./assets/css/style.css" />
  <title>Registration Page</title>
</head>

<body class="bg-img">
  <?php
  include_once("./backend/utils/upload.php");
  include_once("./backend/utils/form_validate.php");

  ?>
  <div class="d-flex justify-content-center align-content-center align-items-center">
    <!-- input types are text and required atrribute is not used to skip html validation -->
    <form class="p-4 rounded" name="myform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
      <h3 class="text-center pb-2">Registration Form</h3>
      <p class="required-header text-center "> fileds are Required</p>

      <div class="form-group  ">
        <label for="name" class="required"> Name </label>
        <input type="text" name="name" id="name" class="form-control" value="<?php echo $name ?>" />
        <p id="msg-name" class=" <?php if ($nameErr == "") echo "d-none"  ?>  w-100  text-center rounded border bg-error border-danger text-danger"> <?php echo $nameErr; ?></p>
      </div>
      <div class="form-group">
        <label for="dob" class="required"> Date of birth: </label>
        <input type="date" name="dob" id="dob" class="form-control" value="<?php echo $dob ?>" />
        <p id="msg-dob" class=" <?php if ($dobErr == "") echo "d-none"  ?>  w-100  text-center rounded border bg-error border-danger text-danger"> <?php echo $dobErr; ?></p>
      </div>


      <div class="form-group">
        <label for="gender" class="required"> Gender </label>
        <br />
        <div class="form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="gender" value="male" <?php if ($gender === "male")  echo "checked" ?> />
            Male
          </label>
        </div>
        <div class="form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="gender" value="female" <?php if ($gender === "female")  echo "checked" ?> />
            Female
          </label>
        </div>
        <div class="form-check-inline disabled">
          <label class="form-check-label">
            <input type="radio" style="
                  padding: 200px;
                  background-color: #f0ffff;
                  border: 1px solid red;
                " name="gender" value="other" <?php if ($gender === "other")  echo "checked" ?> />
            Other
          </label>
        </div>
        <p id="msg-gender" class=" <?php if ($genderErr == "") echo "d-none"  ?>  w-100  text-center rounded border bg-error border-danger text-danger"> <?php echo $genderErr; ?></p>
      </div>
      <div class="form-group">
        <label for="email" class="required">Email address</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>" />
        <p id="msg-email" class=" <?php if ($emailErr == "") echo "d-none"  ?>  w-100  text-center rounded border bg-error border-danger text-danger"> <?php echo $emailErr; ?></p>
      </div>

      <div class="form-group">
        <label for="phone" class="required"> Contact No </label>
        <input type="number" class="form-control" id="phone" name="phone" value="<?php echo $phone ?>" />
        <p id="msg-phone" class=" <?php if ($phoneErr == "") echo "d-none"  ?>  w-100  text-center rounded border bg-error border-danger text-danger"> <?php echo $phoneErr; ?></p>
      </div>


      <div class="form-group " id="skills">
        <label for="skills" class="required">Skills</label>
        <br>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="skill[]" value="html" <?php if (in_array("html", $skill))  echo "checked" ?>>
          <label class="form-check-label" for="inlineCheckbox1">html</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="skill[]" value="css" <?php if (in_array("css", $skill))  echo "checked" ?>>
          <label class="form-check-label" for="inlineCheckbox2">css</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="skill[]" value="php" <?php if (in_array("php", $skill))  echo "checked" ?>>
          <label class="form-check-label" for="inlineCheckbox3">php</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="inlineCheckbox4" name="skill[]" value="reactJS" <?php if (in_array("reactJS", $skill))  echo "checked" ?>>
          <label class="form-check-label" for="inlineCheckbox4">reactJS</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="inlineCheckbox5" name="skill[]" value="mySQL" <?php if (in_array("mySQL", $skill))  echo "checked" ?>>
          <label class="form-check-label" for="inlineCheckbox5">mySQL</label>

        </div>
        <p id="msg-skill" class=" <?php if ($skillErr == "") echo "d-none"  ?>  w-100  text-center rounded border bg-error border-danger text-danger"> <?php echo $skillErr; ?></p>

      </div>

      <div class="form-group">
        <label for="img" class="required">Select image:</label>
        <input type="file" class="form-control p-1" id="img" name="img" accept="image/*" value="<?php echo $img ?>">
        <p id="msg-img" class=" <?php if ($imgErr == "") echo "d-none"  ?>  w-100  text-center rounded border bg-error border-danger text-danger"> <?php echo $imgErr; ?></p>
      </div>

      <div class="form-group">
        <label for="about"> About</label>
        <textarea type="text" class="form-control" id="about" name="about"><?php echo $about ?></textarea>
        <p id="msg-about" class=" <?php if ($aboutErr == "") echo "d-none"  ?>  w-100  text-center rounded border bg-error border-danger text-danger"> <?php echo $aboutErr; ?></p>
      </div>
      <div class="form-group">
        <label for="addr" class="required"> Address</label>
        <textarea type="text" class="form-control" id="addr" name="addr"><?php echo $addr ?></textarea>
        <p id="msg-addr" class=" <?php if ($addrErr == "") echo "d-none"  ?>  w-100  text-center rounded border bg-error border-danger text-danger"> <?php echo $addrErr; ?></p>
      </div>


      <div class="form-group">
        <label for="education" class="required"> Education Qualification</label>
        <select class="form-control" id="education" name="education">
          <option selected disabled>Nothing selected</option>
          <option class="dropdown-item" value="doctorate" href="#" <?php if ($education && $education === "doctorate")  echo "selected" ?>>Doctorate</option>
          <option class="dropdown-item" value="masters" href="#" <?php if ($education && $education === "masters")  echo "selected" ?>>Masters</option>
          <option class="dropdown-item" value="bachelors" href="#" <?php if ($education && $education === "bachelors")  echo "selected" ?>>Bachelors</option>
          <option class="dropdown-item" value="high-school" href="#" <?php if ($education && $education === "high-school")  echo "selected" ?>>High School</option>
        </select>

        <p id="msg-education" class=" <?php if ($educationErr == "") echo "d-none"  ?>  w-100  text-center rounded border bg-error border-danger text-danger"> <?php echo $educationErr; ?></p>

      </div>

      <div class="form-group p-1">
        <label for="interests" class="required"> Interests</label>
        <select class="form-control" name="interests[]" id="interests" multiple data-live-search="true">
          <option class="dropdown-item" value="lorem" <?php if (in_array("lorem", $interests))  echo "selected" ?>>Lorem</option>
          <option class="dropdown-item" value="ipsum" <?php if (in_array("ipsum", $interests))  echo "selected" ?>>Ipsum</option>
          <option class="dropdown-item" value="dolor" <?php if (in_array("dolor", $interests))  echo "selected" ?>>dolor</option>
          <option class="dropdown-item" value="sit" <?php if (in_array("sit", $interests))  echo "selected" ?>>sit</option>
          <option class="dropdown-item" value="amet" <?php if (in_array("amet", $interests))  echo "selected" ?>>amet</option>
          <option class="dropdown-item" value="consectetur" <?php if (in_array("consectetur", $interests))  echo "selected" ?>>consectetur</option>
        </select>

        <p id="msg-interests" class=" <?php if ($interestsErr == "") echo "d-none"  ?>  w-100  text-center rounded border bg-error border-danger text-danger"> <?php echo $interestsErr; ?></p>

      </div>

      <div class="form-group">
        <label for="linkedin"> LinkedIn</label>
        <input type="url" class="form-control" id="linkedin" name="linkedin" value="<?php echo $linkedin ?>" />
        <p id="msg-linkedin" class=" <?php if ($linkedinErr == "") echo "d-none"  ?>  w-100  text-center rounded border bg-error border-danger text-danger"> <?php echo $linkedinErr; ?></p>
      </div>
      <div class="form-group">

        <label for="github"> Github</label>
        <input type="url" class="form-control" id="github" name="github" value="<?php echo $github ?>" />
        <p id="msg-github" class=" <?php if ($githubErr == "") echo "d-none"  ?>  w-100  text-center rounded border bg-error border-danger text-danger"> <?php echo $githubErr; ?></p>
      </div>

      <button type="submit" name="submit" class="btn btn-primary float-right">
        Submit
      </button>
    </form>
  </div>
  <!-- Imported External JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

  <script src="./assets/js/script.js"></script>
</body>

</html>