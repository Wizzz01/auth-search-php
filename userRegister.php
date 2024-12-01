<?php
require_once 'core/handleForms.php';
require_once 'core/models.php';
require_once 'core/dbConfig.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="CSS/fillStyles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin registration</title>
</head>
<body>
<div class="container">
    <?php if (isset($_SESSION['message'])) { ?>
        <h1 style="color: red;"><?php echo $_SESSION['message']; ?></h1>
    <?php } unset($_SESSION['message']); ?>
    <div class="title">Registration</div>
    
    <div class="content">
      <form action="core/handleForms.php" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" name="first_name" placeholder="Enter your first name" required>
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" name="last_name" placeholder="Enter your last name" required>
          </div>

          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name="email" placeholder="Enter your email" required>
          </div>
         
          <div class="input-box">
            <span class="details">Address</span>
            <input type="text" name="address" placeholder="Enter your address" required>
          </div>
        
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name="username" placeholder="Enter your username" required>
          </div>
         
          <div class="input-box">
            <span class="details">Password</span>
            <input type="text" name="password" placeholder="Enter your password" required>
          </div>
        </div>
        <div class="button">
          <input type="submit" name="registerUserBtn" value="Register">
        </div>
        <div class="signup-link">Already an admin? <a href="index.php">Login here</a></div>
      </form>
    </div>
  </div>
</body>
</html>