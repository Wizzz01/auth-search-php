<?php 
require_once 'core/dbConfig.php';
require_once 'core/handleForms.php';

if (!isset($_SESSION['username'])) {
	header("Location: userLogin.php");
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="CSS/styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
        <a class="nav-link" href="applicantDatabase.php">View database</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="adminRecords.php">View admin records</a>
      </li>
    </ul>
    <form class="d-flex" role="search">
      <?php if (isset($_SESSION['username'])) { ?>
          <a class="btn btn-outline-dark m-2" href="core/handleForms.php?logoutAUser=1">Logout</a>
      <?php } else { echo "<h1>No user logged in</h1>";} ?>
    </form>
  </div>
</nav>
<div class="text-container">
  <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2> 
  <a href="applicantRegister.php" class="goto-page">Register an applicant</a>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
