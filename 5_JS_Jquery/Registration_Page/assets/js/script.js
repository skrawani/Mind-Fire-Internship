const validateEmail = (email) => {
  // check if Email are valid or not
  const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
};

const validateName = (name) => {
  //check if name if empty or greater than 40 characters
  if (name == "" || name.lenght > 40) return false;
  //   check if Name only contains alphabets
  const re = /^[0-9a-z]+$/;
  return !re.test(String(name).toLowerCase());
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

function validateForm() {
  try {
    //   get all form values form html
    const email = document.forms["myform"]["email"].value;
    const name = document.forms["myform"]["name"].value;
    const phone = document.forms["myform"]["phone"].value;
    const gender = document.forms["myform"]["gender"].value;
    const password = document.forms["myform"]["password"].value;
    const cpassword = document.forms["myform"]["cpassword"].value;

    // check if Email is valid or not
    if (!validateEmail(email)) {
      alert("Enter valid Email Address");
      return false;
    }

    // check if Name is valid or not
    if (!validateName(name)) {
      alert("Enter valid Name");
      return false;
    }

    // check if Gender is Empty
    if (gender == "") {
      alert("Enter gender input");
      return false;
    }

    // check if PhoneNo is valid or not
    if (!validatePhoneNo(phone)) {
      alert("Enter valid Phone Number");
      return false;
    }

    // check if Password is in Correct Format(valid) or not
    if (!validatePass(password)) {
      var msg =
        "Password Should be in Following Format\n\n" +
        "• Must be atleat 8 characters long\n" +
        "• Must Contain a uppercase , a lowercase character\n" +
        "• Must Contain a digit and a special Character\n\n";

      alert(msg);
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
  }
}
