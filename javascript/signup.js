
function validateForm() {
    let x = document.forms["signup"]["username"].value;
    let pass=document.forms["signup"]["password"].value;
    let cpass=document.forms["signup"]["cpassword"].value;
    if (x == "") {
      alert("Name must be filled out");
      return false;
    }
    if (pass != cpass) {
        alert("Passwords doesn't match!");
        return false;
    }
  }
