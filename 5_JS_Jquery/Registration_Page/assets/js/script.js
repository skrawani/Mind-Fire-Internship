const validateEmail = (email) => {
  // check if Email are valid or not
  const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
};

const validateName = (name) => {
  //   check if Name only contains alphabets
  const re = /^[a-zA-Z ]{1,40}$/;
  return re.test(String(name).toLowerCase());
};

const validatePhoneNo = (phone) => {
  //check if number is having 10 charactes and only digits
  const re = /^\d{10}$/;
  return re.test(phone);
};

const validatePass = (pass) => {
  /* check if is in Following Format
        • Must be atleat 8 characters long
        • Must Contain a uppercase , a lowercase character
        • Must Contain a digit and a special Character
    */
  if (
    pass.length >= 8 &&
    /[a-z]/i.test(pass) &&
    /[0-9]/.test(pass) &&
    /[^A-Za-z 0-9]/g.test(pass) &&
    /[A-Z]/i.test(pass)
  )
    return true;
  // if not then return false
  return false;
};

const clearPrevMsg = () => {
  document.getElementById("msg-email").classList.remove("d-block");
  document.getElementById("msg-name").classList.remove("d-block");
};

function validateForm() {
  try {
    //   get all form values form html
    const email = document.forms["myform"]["email"].value;
    const name = document.forms["myform"]["name"].value;
    const phone = document.forms["myform"]["phone"].value;
    const gender = document.forms["myform"]["gender"].value;
    const password = document.forms["myform"]["password"].value;
    const cpassword = document.forms["myform"]["cpassword"].value;

    // clear all previous messages
    // document.getElementById("msg-email").classList.remove("d-block");
    // document.getElementById("msg-name").classList.remove("d-block");
    // document.getElementById("msg-gender").classList.remove("d-block");
    // document.getElementById("msg-phone").classList.remove("d-block");
    // document.getElementById("msg-password").classList.remove("d-block");
    // document.getElementById("msg-cpassword").classList.remove("d-block");

    // check if Email is valid or not
    if (!validateEmail(email)) {
      document.forms["myform"]["email"].classList.add("border-danger");
      document.getElementById("msg-email").innerHTML = "Email Id is not valid";
      document.getElementById("msg-email").classList.add("d-block");
      return false;
    }

    // check if Name is valid or not
    if (!validateName(name)) {
      document.forms["myform"]["name"].classList.add("border-danger");
      document.getElementById("msg-name").innerHTML =
        "Name Length must be greater than 0  and less than 40";
      document.getElementById("msg-name").classList.add("d-block");

      return false;
    }

    // check if Gender is Empty
    if (gender == "") {
      document.getElementById("msg-gender").innerHTML = "Select a gender";
      return false;
    }

    // check if PhoneNo is valid or not
    if (!validatePhoneNo(phone)) {
      document.forms["myform"]["phone"].classList.add("border-danger");
      document.getElementById("msg-phone").innerHTML = "Enter valid Phone no";
      document.getElementById("msg-phone").classList.add("d-block");
      return false;
    }

    // check if Password is in Correct Format(valid) or not
    if (!validatePass(password)) {
      document.forms["myform"]["password"].classList.add("border-danger");
      document.getElementById("msg-pass").innerHTML =
        ' <p class="p-0 pl-4 m-0 ">Password must</p>\
      <ul>\
        <li>be atleat 8 characters long</li>\
        <li>contain a uppercase, a lowercase character</li>\
        <li>contain a digit and a special Character</li>\
      </ul>';
      document.getElementById("msg-pass").classList.add("d-block");
      return false;
    }

    // check if Both Passwords are same or not
    if (password !== cpassword) {
      alert("Passwords are not same");
      return false;
    }
  } catch (error) {
    // log error (if any)
    console.log(error);
    return false;
  }
}
