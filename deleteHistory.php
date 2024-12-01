<?php require_once 'core/dbConfig.php';?>
<?php require_once 'core/handleForms.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<meta charset="UTF-8">
<link rel="stylesheet" href="CSS/fillStyles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete an applicant</title>
</head>
<body>
    <button class="returnBtn" onclick="document.location='applicantDatabase.php'">Return</button>
    <div class="header-container">
		<h1>Are you sure you want to remove this applicant?</h1>
	</div>
	<?php $getApplicantById = getApplicantByID($pdo, $_GET['id']); ?>
	<form action="core/handleForms.php?applicant_id=<?php echo $_GET['id']; ?>" method="POST">

		<div class="history-container">
			<p>Last name: <?php echo $getApplicantById['first_name']; ?></p>
			<p>First name: <?php echo $getApplicantById['last_name']; ?></p>
			<p>Years of experience: <?php echo $getApplicantById['years_of_experience']; ?></p>
			<p>Country of origin: <?php echo $getApplicantById['country_of_origin']; ?></p>
			<p>Date registered: <?php echo $getApplicantById['created_at']; ?></p>
			<div class="button">
				<input type="submit" name="deleteBtn" value="Delete">
			</div>
		</div>
	</form>
</body>
</html>