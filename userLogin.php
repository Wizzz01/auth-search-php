<?php
require_once 'core/handleForms.php';
require_once 'core/dbConfig.php';
require_once 'core/models.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
<link rel="stylesheet" href="CSS/loginStyles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<?php if (isset($_SESSION['message'])) { ?>
    <script>
        alert("<?php echo $_SESSION['message']; ?>");
    </script>
<?php unset($_SESSION['message']); } ?>
<div class="wrapper">
    <div class="title"><span>Login</span></div>
    <form action="core/handleForms.php" method="POST">
      <div class="row">
        <Label for="username" class="fas fa-user"></Label>
        <input type="text" name="username" placeholder="Username" required />
      </div>
      <div class="row">
        <label for="password" class="fas fa-lock"></label>
        <input type="password" name="password" placeholder="Password" required />
      </div>
	  <div class="row button">
        <input type="submit" name="loginUserBtn" value="Login"/>
      </div>
      <div class="signup-link">Need to register an admin? <a href="userRegister.php">Register here</a></div>
    </form>
  </div>
	
</body>
</html>