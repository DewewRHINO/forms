function checkSimilarity() {
  var text1 = document.querySelectorAll('[name="email"]')[0].value;
  console.log(text1);
  var text2 = document.querySelectorAll('[name="email-confirmation"]')[0].value;
  console.log(text2);
  
  if (text1 === text2 && !text1 == "") {
    alert("The inputs are the same");
  } else {
    alert("The inputs are not the same");
  }
}

function validate() {
  var name = document.querySelectorAll('[name="name"]')[0].value;
  var email = document.querySelectorAll('[name="email"]')[0].value;
  var email_confimration = document.querySelectorAll('[name="email-confirmation"]')[0].value;
  var password = document.querySelectorAll('[name="password"]')[0].value;
  var age = document.querySelectorAll('[name="age"]')[0].value;
  var gender = document.querySelector("input[name='gender']:checked");
  var interests = document.querySelectorAll("input[name='interest[]']:checked");
  
  var errors = [];
  
  if (name === "") {
    errors.push("Your name is required silly goose");
  }
  
  if (email === "") {
    errors.push("Email is required");
  } else if (!isValidEmail(email)) {
    errors.push("Invalid email format");
  }

  if (email_confimration === "") {
    errors.push("Email confimration is required");
  } else if (!isValidEmail(email)) {
    errors.push("Invalid email format for email confirmation");
  }

  if (password === "") {
    errors.push("password is required");
  } 
  
  if (!gender) {
    errors.push("Gender is required");
  }

  if (!age) {
    errors.push("Age is required");
  }
  
  if (interests.length === 0) {
    errors.push("At least one interest should be selected");
  }
  
  if (errors.length > 0) {
    alert("Validation Errors:\n" + errors.join("\n"));
  } else {
    alert("Form is valid and ready for submission.");
    // You can submit the form here if you wish.
  }
}

function isValidEmail(email) {
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function isInterestSelected($interest, $interests) {
  return in_array($interest, $interests);
}