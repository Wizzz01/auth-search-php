<?php require_once 'core/dbConfig.php';?>
<?php require_once 'core/handleForms.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="CSS/fillStyles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update an applicant</title>
</head>
    <body>
    <?php $getApplicantById = getApplicantById($pdo, $_GET['id']); ?>
    <button class="returnBtn" onclick="document.location='applicantDatabase.php'">Return</button>
<div class="container">
    <div class="title">Edit applicant</div>
    <div class="content">
      <form action="core/handleForms.php?applicant_id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="user-details">

          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" name="lastName" placeholder="Edit last name" value="<?php echo $getApplicantById['last_name'];?>">
          </div>

          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" name="firstName" placeholder="Edit first name" value="<?php echo $getApplicantById['first_name'];?>">
          </div>
         
          <div class="input-box">
            <span class="details">Years of Experience</span>
            <input type="text" name="yearsOfExperience" placeholder="Edit years of experience" value="<?php echo $getApplicantById['years_of_experience'];?>">
          </div>
        
          <div class="input-box">
            <span class="details">Country of Origin</span>
            <input type="text" name="countryOfOrigin" placeholder="Edit country of origin" value="<?php echo $getApplicantById['country_of_origin'];?>">
          </div>
        </div>
        <div class="button">
          <input type="submit" name="editBtn" value="Edit" onclick="alert('Update success!')">
        </div>
    </div>
</div>
        </form>
</body>
</html>