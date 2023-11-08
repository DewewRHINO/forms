<!-- https://www.w3schools.com/php/php_form_validation.asp -->
<!-- https://www.javatpoint.com/form-validation-in-php -->

<!DOCTYPE HTML>
<html>

<head>
  <style>
    .error {
      color: #ff0000;
    }
  </style>
</head>

<body>

  <?php
  // Define variables and set to empty values
  // These are error variables to be displayed for invalidated fields
  $nameErr = $emailErr = $genderErr = $websiteErr = "";

  // These are variables to store the input fields
  $name = $email = $gender = $comment = $website = "";

  // Only process if the request method is a POST
  // As a reminder, this information comes from the HTTP headers
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // For every field, assert that it is not empty,
    // Cleanse the data and check for validation
  
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = check_input($_POST["name"]);
      // Check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z\s]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
      }
    }

    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } else {
      $email = check_input($_POST["email"]);
      // Check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      }
    }

    if (empty($_POST["gender"])) {
      $genderErr = "Gender is required";
    } else {
      $gender = check_input($_POST["gender"]);
    }

    // Some fields may be left empty such as website and comment
    $website = check_input($_POST["website"]);
    // Check if URL address syntax is valid
    if (!filter_var($website, FILTER_VALIDATE_URL)) {
      $websiteErr = "Invalid URL";
    }

    $comment = check_input($_POST["comment"]);
  }

  function check_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>

  <h2>PHP Form Validation Example</h2>

  <p><span class="error">* required field</span></p>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Name: <input type="text" name="name" value="<?php echo $name; ?>">
    <span class="error">*
      <?php echo $nameErr; ?>
    </span>
    <br><br>
    E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
    <span class="error">*
      <?php echo $emailErr; ?>
    </span>
    <br><br>
    Website: <input type="text" name="website" value="<?php echo $website; ?>">
    <span class="error">
      <?php echo $websiteErr; ?>
    </span>
    <br><br>
    Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment; ?></textarea>
    <br><br>
    Gender:
    <input type="radio" name="gender" <?php if (isset($gender) && $gender == "female")
      echo "checked"; ?>
      value="female">Female
    <input type="radio" name="gender" <?php if (isset($gender) && $gender == "male")
      echo "checked"; ?> value="male">Male
    <input type="radio" name="gender" <?php if (isset($gender) && $gender == "other")
      echo "checked"; ?>
      value="other">Other
    <span class="error">*
      <?php echo $genderErr; ?>
    </span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
  </form>

  <?php
  echo "<h2>Your Input:</h2>";
  echo $name;
  echo "<br>";
  echo $email;
  echo "<br>";
  echo $website;
  echo "<br>";
  echo $comment;
  echo "<br>";
  echo $gender;
  ?>

</body>

</html>