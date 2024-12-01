<?php
require_once 'core/dbConfig.php'; 
require_once 'core/handleForms.php';
require_once 'core/models.php';
if (!isset($_SESSION['username'])) {
	header("Location: userLogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="CSS/styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Database</title>
</head>
<body> 
<nav class="navbar navbar-expand-lg navbar-light bg-primary custom-navbar">
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="applicantRegister.php">Register a new applicant</a>
      </li>
    </ul>
    <form action="searchResults.php" method="GET">
      <input type="text" name="search" placeholder="Enter search term">
      <input type="submit" value="Search">
    </form>
  </div>
</nav>
    <?php $seeAllApplicants = seeAllApplicants($pdo); ?>
    
<table class="table table-striped table-hover my-2" style="border-collapse: collapse;">
    <tr class ="table-rows">
        <th class ="table-header">ID</th>
        <th class ="table-header">Last Name</th>
        <th class ="table-header">First Name</th>
        <th class ="table-header">Years of Experience</th>
        <th class ="table-header">Country of Origin</th>
        <th class ="table-header">Date of registration</th>
        <th class ="table-header">Actions</th>
    </tr>

    <?php if ($seeAllApplicants['statusCode'] === 200) {
    foreach ($seeAllApplicants['querySet'] as $row) { ?>
    <tr class="table-rows">
        <td class="table-data"><?php echo $row['applicant_id']; ?></td>
        <td class="table-data"><?php echo $row['last_name']; ?></td>
        <td class="table-data"><?php echo $row['first_name']; ?></td>
        <td class="table-data"><?php echo $row['years_of_experience']; ?></td>
        <td class="table-data"><?php echo $row['country_of_origin']; ?></td>
        <td class="table-data"><?php echo $row['created_at']; ?></td>
        <td class="table-data">
            <a href="editHistory.php?id=<?php echo $row['applicant_id']; ?>">Edit</a> | 
            <a href="deleteHistory.php?id=<?php echo $row['applicant_id']; ?>">Delete</a>
        </td>
    </tr>
    <?php } }?> 
</table>
</body>
</html>