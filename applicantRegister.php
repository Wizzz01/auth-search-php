<?php require_once 'core/dbConfig.php';?>
<?php require_once 'core/handleForms.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="CSS/fillStyles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
<button class="returnBtn" onclick="document.location='index.php'">Return</button>
<div class="container">
    <div class="title">Register here</div>
    <div class="content">
      <form action="core/handleForms.php" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Last name</span>
            <input type="text" name="lastName" placeholder="Enter last name" required>
          </div>

          <div class="input-box">
            <span class="details">First name</span>
            <input type="text" name="firstName" placeholder="Enter first name" required>
          </div>
         
          <div class="input-box">
            <span class="details">Years of experience</span>
            <input type="number" name="yearsOfExperience" placeholder="Enter years of experience" required>
          </div>
        
          <div class="input-box">
            <span class="details">Country of Origin</span>
            <input type="text" name="countryOfOrigin" placeholder="Enter country of origin" required>
          </div>
        </div>
        <div class="button">
          <input type="submit" name="submitBtn" value="Submit">
        </div>
    </div>
</div>
        </form>
</body>
</html>