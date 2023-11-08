<?php
/* Per lecture slides, we always want to validate the server
This is because clients don't always have to go through the browser to submit a request
They can also do that via CURL or Postman etc.
For example, try this command for a GET method
curl -X GET "http://localhost:1234/login.php?uname=etuong&pwd=asdf"
Note that for GET method, the query params are part of the URL
Try this command for a POST method
*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check that fields "pwd" and "uname" are set
  if (isset($_POST["pwd"]) && isset($_POST["uname"])) {
    echo "Username is " . $_POST["uname"];
    echo "<br />";

    if (strlen($_POST["pwd"]) > 7) {
      echo "Password is " . $_POST["pwd"];
    } else {
      echo "Please input password more than 7 characters";
    }
  } else {
    echo "Sordi! Suminasen";
  }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
  echo "Username is $_GET[uname]";
  echo "<br />";
  echo "Password is " . $_GET["pwd"];
}
?>