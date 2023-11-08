<!-- https://www.w3schools.com/php/php_form_validation.asp -->
<!-- https://www.javatpoint.com/form-validation-in-php -->

<!DOCTYPE HTML>
<html>

<head>
  <style>
    .error {
      color: #FF0000;
    }
  </style>
  <script type = "text/javascript" src="validate.js"></script>  
</head>

<body>

  <?php
  // Error values for when input is invalid
  $nameErr = $emailErr = $genderErr = $websiteErr = $countryErr = $interestsErr = $email_confirmationErr = $passwordErr = $aggErr = "";

  // These are variables to store the input fields
  $name = $email = $gender = $comment = $website = $country = $interest = $email_confirmation = $password = $age = "";
  $interests = [];

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

    if (empty($_POST["email-confirmation"])) {
      $email_confirmationErr = "Email is required";
    } else {
      $email_confirmation = check_input($_POST["email-confirmation"]);
      if (!filter_var($email_confirmation, FILTER_VALIDATE_EMAIL)) {
        $email_confirmationErr = "Invalid email format";
      }
    }

    if (empty($_POST["gender"])) {
      $genderErr = "Gender is required";
    } else {
      $gender = check_input($_POST["gender"]);
    }

    if (empty($_POST["age"])) {
      $ageErr = "Age is required";
    } else {
      $age = check_input($_POST["gender"]);
    }

    // Some fields may be left empty such as website and comment
    $website = check_input($_POST["website"]);
    // Check if URL address syntax is valid
    if (!filter_var($website, FILTER_VALIDATE_URL)) {
      $websiteErr = "Invalid URL";
    }

    if ($_POST["country"] == "default") {
      $countryErr = "Country is required";
    } else {
      $country = check_input($_POST["country"]);
    }

    if (isset($_POST['interest'])) {
      $interests = $_POST['interest'];
    } else {
      $interestsErr = "Please select your interests.";
    }

    $comment = check_input($_POST["comment"]);
  }

  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = check_input($_POST["password"]);
  }
  

  function check_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>

  <h1>Jacob Jayme</h1>

  <p><span class="error">* required field</span></p>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Name: <input type="text" name="name" value="<?php echo $name; ?>">
    <span class="error">*
      <?php echo $nameErr; ?>
    </span>
    <br><br>
    Enter your E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
    <span class="error">*
      <?php echo $emailErr; ?>
    </span>
    <br>
    Enter your E-mail again please or ill cry and piss myself: <input type="text" name="email-confirmation" value="<?php echo $email_confirmation; ?>">
    <span class="error">*
      <?php echo $email_confirmationErr; ?>
    </span>
    <br><br>
    Password: <input type="password" name="password" value="<?php echo $password; ?>">
    <span class="error">* <?php echo $passwordErr;?></span>
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

    How old are you?:
    <input type="radio" name="age" <?php if (isset($age) && $age == "<= 10")
      echo "checked"; ?>
      value="female"> <= 10
    <input type="radio" name="age" <?php if (isset($age) && $age == "> 10 and < 20")
      echo "checked"; ?> value="male"> > 10 and < 20
    <input type="radio" name="age" <?php if (isset($age) && $age == "20 +")
      echo "checked"; ?>
      value="other"> 20 + 
    <span class="error">*
      <?php echo $ageErr; ?>
    </span>
    <br><br>

    <p>Select your country:</p>
      <select name='country'>
        <option value='default' <?php if ($country == 'default') echo 'selected'; ?>>Choose a country</option>
        <option value='usa' <?php if ($country == 'usa') echo 'selected'; ?>>USA</option>
        <option value='canada' <?php if ($country == 'canada') echo 'selected'; ?>>Canada</option>
        <option value='uk' <?php if ($country == 'uk') echo 'selected'; ?>>UK</option>
        <option value='australia' <?php if ($country == 'australia') echo 'selected'; ?>>Australia</option>
        <option value='other' <?php if ($country == 'other') echo 'selected'; ?>>Other</option>
      </select>
      <span class="error">*
        <?php echo $countryErr; ?>
      </span>

      <p>Select your interests:</p>
      <input type='checkbox' name='interest[]' value='sports' <?php if (in_array('sports', $interests)) echo 'checked'; ?>> Sports<br>
      <input type='checkbox' name='interest[]' value='music' <?php if (in_array('music', $interests)) echo 'checked'; ?>> Music<br>
      <input type='checkbox' name='interest[]' value='movies' <?php if (in_array('movies', $interests)) echo 'checked'; ?>> Movies<br>
      <span class="error">*
        <?php echo $interestsErr; ?>
      </span>
    <br>

    <input type="submit" name="submit" value="Submit">
    <input type='button' value='Check Similarity' onclick='checkSimilarity()'>    
    <button type='button' onclick='validate()'>Validate</button>   
  </form>

  <?php
  echo "<h2>Here is your input:</h2>";
  echo $name;
  echo "<br>";
  echo $email;
  echo "<br>";
  echo $website;
  echo "<br>";
  echo $comment;
  echo "<br>";
  echo $gender;
  echo "<br>";
  echo $country;
  echo "<br>";
  foreach($interests as $interest){ 
    echo $interest;
    echo " ";
  }
  echo "<br>";
  echo $password;
  echo "<br>";
  echo $age;
  ?>

</body>
</html>