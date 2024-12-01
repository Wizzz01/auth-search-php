<?php 
require_once 'core/dbConfig.php';
require_once 'core/handleForms.php';
require_once 'core/models.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
<link rel="stylesheet" href="CSS/styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    
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
        <a class="nav-link" href="applicantDatabase.php">Return to Database</a>
      </li>
    </ul>
    <form action="searchResults.php" method="GET">
      <input type="text" name="search" placeholder="Enter search term">
      <input type="submit" value="Search">
    </form>
  </div>
</nav>
    <?php  
        if (isset($_SESSION['message']) && isset($_SESSION['status'])) {

            if ($_SESSION['status'] == "200") {
                echo "<h1 style='color: green;'>{$_SESSION['message']}</h1>";
            }

            else {
                echo "<h1 style='color: red;'>{$_SESSION['message']}</h1>";	
            }

        }
        unset($_SESSION['message']);
        unset($_SESSION['status']);
	?>
    <h2>Search Results</h2>

    <?php 
        $searchTerm = $_GET['search'];
        $results = getApplicantBySearch($pdo, $searchTerm);
        if ($results) { 
    ?>
        <table style="width:50%; margin-top: 150px; margin-left: 450px; text-align: center; border: 2px solid black; border-collapse:collapse;">
    <tr style="border: 2px solid black;">
        <th style="border: 2px solid black;">First Name</th>
        <th style="border: 2px solid black;">Last Name</th>
        <th style="border: 2px solid black;">Years of Experience</th>
        <th style="border: 2px solid black;">Country of Origin</th>
        <th style="border: 2px solid black;">Date Added</th>
    </tr>
    <?php foreach ($results as $row) { ?>
        <tr style="border: 2px solid black;">
            <td style="border: 2px solid black; padding: 1rem;"><?php echo $row['first_name']; ?></td>
            <td style="border: 2px solid black; padding: 1rem;"><?php echo $row['last_name']; ?></td>
            <td style="border: 2px solid black; padding: 1rem;"><?php echo $row['years_of_experience']; ?></td>
            <td style="border: 2px solid black; padding: 1rem;"><?php echo $row['country_of_origin']; ?></td>
            <td style="border: 2px solid black; padding: 1rem;"><?php echo $row['created_at']; ?></td>
        </tr>
    <?php } ?>
</table>
    <?php } else { ?>
        <p>No results found for "<?php echo htmlspecialchars($searchTerm); ?>"</p>
    <?php } ?>
</body>
</html>
