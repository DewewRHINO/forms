<html>

<head>
  <script src="./validate.js"></script>
</head>

<body>
  <!-- GET Or POST HTTP Method -->
  <form action="login.php" method="POST">
    <label for="uname">Username</label>
    <!-- The name (in this case it's uname) is important because this is what will carry over to the server -->
    <input type="text" placeholder="Enter your username" name="uname" required id="fname" />
    <br />
    <label for="pwd">Password</label>
    <input type="password" placeholder="Enter your password" name="pwd" required id="fpwd" />

    <input type="button" value="Validate me!" onClick="validate()" />

    <!-- This will call the form action -->
    <input type="submit" value="Login" onClick="validate()" />
  </form>
</body>

</html>