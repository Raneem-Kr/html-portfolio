function validate() {
  var isUsernameValid = true;
  var isUserpasswordValid = true;
  var isUserCPasswordValid = true;

  if (document.getElementById("username").value.trim() === "") {
    isUsernameValid = false;
    document.getElementById("spanIsUserNameValid").innerHTML =
      "&#x2716; Please enter your name";
    document.getElementById("spanIsUserNameValid").style.color = "red";
  } else {
    isUsernameValid = true;
    document.getElementById("spanIsUserNameValid").innerHTML = "&#x2714; Valid";
    document.getElementById("spanIsUserNameValid").style.color = "green";
  }

  var passwordField = document.getElementById("pwdUser").value;
  var confirmPasswordField = document.getElementById("cpwdUser").value;

  if (passwordField === "") {
    isUserpasswordValid = false;
    document.getElementById("spnIsUserPasswordValid").innerHTML =
      "&#x2716; Please enter your password";
    document.getElementById("spnIsUserPasswordValid").style.color = "red";
  } else if (passwordField.length < 7) {
    isUserpasswordValid = false;
    document.getElementById("spnIsUserPasswordValid").innerHTML =
      "&#x2716; Password should contain at least seven characters";
    document.getElementById("spnIsUserPasswordValid").style.color = "red";
  } else if (!/[a-z]/.test(passwordField)) {
    isUserpasswordValid = false;
    document.getElementById("spnIsUserPasswordValid").innerHTML =
      "&#x2716; Your password must contain at least one lowercase letter";
    document.getElementById("spnIsUserPasswordValid").style.color = "red";
  } else if (!/[A-Z]/.test(passwordField)) {
    isUserpasswordValid = false;
    document.getElementById("spnIsUserPasswordValid").innerHTML =
      "&#x2716; Your password must contain at least one uppercase letter";
    document.getElementById("spnIsUserPasswordValid").style.color = "red";
  } else if (!/\d/.test(passwordField)) {
    isUserpasswordValid = false;
    document.getElementById("spnIsUserPasswordValid").innerHTML =
      "&#x2716; Your password must contain at least one digit";
    document.getElementById("spnIsUserPasswordValid").style.color = "red";
  } else {
    isUserpasswordValid = true;
    document.getElementById("spnIsUserPasswordValid").innerHTML =
      "&#x2714; Valid";
    document.getElementById("spnIsUserPasswordValid").style.color = "green";
  }

  if (confirmPasswordField === "") {
    isUserCPasswordValid = false;
    document.getElementById("spanIsUserCPasswordValid").innerHTML =
      "&#x2716; Please enter your password";
    document.getElementById("spanIsUserCPasswordValid").style.color = "red";
  } else if (passwordField !== confirmPasswordField) {
    isUserCPasswordValid = false;
    document.getElementById("spanIsUserCPasswordValid").innerHTML =
      "&#x2716; Password and confirm password should be the same";
    document.getElementById("spanIsUserCPasswordValid").style.color = "red";
  } else {
    isUserCPasswordValid = true;
    document.getElementById("spanIsUserCPasswordValid").innerHTML =
      "&#x2714; Valid";
    document.getElementById("spanIsUserCPasswordValid").style.color = "green";
  }

  return isUsernameValid && isUserpasswordValid && isUserCPasswordValid;
}

function resetForm() {
  document.getElementById("spanIsUserNameValid").innerHTML = "";
  document.getElementById("spnIsUserPasswordValid").innerHTML = "";
  document.getElementById("spanIsUserCPasswordValid").innerHTML = "";
}
