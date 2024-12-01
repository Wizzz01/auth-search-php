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
    <title>Admin Records</title>
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
    </ul>
    <form class="d-flex" role="search">
      <?php if (isset($_SESSION['username'])) { ?>
          <a class="btn btn-outline-dark m-2" href="core/handleForms.php?logoutAUser=1">Logout</a>
      <?php } else { echo "<h1>No user logged in</h1>";} ?>
    </form>
  </div>
</nav>
    <?php $seeAllActivityLogs = seeAllActivityLogs($pdo); ?>
    
<table class="table table-striped table-hover my-2" style="border-collapse: collapse;">
    <tr class ="table-rows">
        <th class ="table-header">Admin record ID</th>
        <th class ="table-header">Operation</th>
        <th class ="table-header">Applicant ID</th>
        <th class ="table-header">Last Name</th>
        <th class ="table-header">First Name</th>
        <th class ="table-header">Username</th>
        <th class ="table-header">Added At</th>
    </tr>
    <?php if ($seeAllActivityLogs['statusCode'] === 200) {
    foreach ($seeAllActivityLogs['querySet'] as $row) { ?>
    <tr class="table-rows">
        <td class="table-data"><?php echo $row['activity_log_id']; ?></td>
        <td class="table-data"><?php echo $row['operation']; ?></td>
        <td class="table-data"><?php echo $row['applicant_id']; ?></td>
        <td class="table-data"><?php echo $row['last_name']; ?></td>
        <td class="table-data"><?php echo $row['first_name']; ?></td>
        <td class="table-data"><?php echo $row['username']; ?></td>
        <td class="table-data"><?php echo $row['date_added']; ?></td>
    </tr>
    <?php } }?> 
</table>
</body>
</html>