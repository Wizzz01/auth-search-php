<?php
require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['submitBtn'])){
    
    $first_name =  trim($_POST['firstName']);  
    $last_name =  trim($_POST['lastName']); 
    $years_of_experience =  trim($_POST['yearsOfExperience']); 
    $country_of_origin =  trim($_POST['countryOfOrigin']); 

    if (!empty($first_name) && !empty($last_name) && !empty($years_of_experience) && !empty($country_of_origin)) {

            $query = insertIntoReg($pdo, $first_name, $last_name, $years_of_experience, $country_of_origin, $added_by );
                if ($query['status'] == '200') {
				    $_SESSION['message'] = $query['message'];
				    $_SESSION['status'] = $query['status'];
				    header("Location: ../index.php");
			    }

			    else {
				    $_SESSION['message'] = $query['message'];
				    $_SESSION['status'] = $query['status'];
				    header("Location: ../applicantRegister.php");
			    }

        }
    else {
        $_SESSION['message'] = "Please make sure there are no empty input fields";
        $_SESSION['status'] = "400";
        header("Location: ../applicantRegister.php");
    } 
}

if(isset($_POST['editBtn'])){
    $first_name =  $_POST['firstName'];  
    $last_name =  $_POST['lastName'];   
    $years_of_experience =  $_POST['yearsOfExperience']; 
    $country_of_origin =  $_POST['countryOfOrigin'];
    $last_updated = date('Y-m-d H:i:s'); 
    $last_updated_by = $_SESSION['username']; 
    $applicant_id = $_GET['applicant_id']; 

    $query = updateApplicant($pdo, $first_name, 
    $last_name, $years_of_experience, $country_of_origin, $last_updated, $last_updated_by, $applicant_id);

    if ($query['status'] == '200') {
        $_SESSION['message'] = $query['message'];
        $_SESSION['status'] = $query['status'];
        header("Location: ../applicantDatabase.php");
    }

    else {
        $_SESSION['message'] = $query['message'];
        $_SESSION['status'] = $query['status'];
        header("Location: ../editHistory.php");
    }
}


if(isset($_POST['deleteBtn'])){
    $id =  $_GET['applicant_id'];
    $query = deleteApplicant($pdo, $id);

    if ($query['status'] == '200') {
        $_SESSION['message'] = $query['message'];
        $_SESSION['status'] = $query['status'];
        header("Location: ../applicantDatabase.php");
    }

    else {
        $_SESSION['message'] = $query['message'];
        $_SESSION['status'] = $query['status'];
        header("Location: ../deleteHistory.php");
    }
}

if (isset($_GET['search'])) {
    $searchApplicants = getApplicantBySearch($pdo, $_GET['search']);
}

if (isset($_POST['registerUserBtn'])) {

    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    if (!empty($username) && !empty($password) && !empty($first_name) && !empty($last_name) && !empty($email) && !empty($address)) {

        $insertQuery = registerUser($pdo, $username, $password, $first_name, $last_name, $email, $address);

        if ($insertQuery) {
            header("Location: ../userLogin.php");
        } else {
            header("Location: ../userRegister.php");
        }
    } else {
        header("Location: ../userRegister.php");
        $_SESSION['message'] = "All fields are required for registration!";
    }
}

if (isset($_POST['loginUserBtn'])) {
    $username = $_POST['username'];
    $password = sha1($_POST['password']);

    if (!empty($username) && !empty($password)) {

		$loginQuery = loginUser($pdo, $username, $password);
	
		if ($loginQuery) {
			header("Location: ../index.php");
		}
		else {
			header("Location: ../userLogin.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for the login!";
		header("Location: ../userLogin.php");
	}
 
}

if (isset($_GET['logoutAUser'])) {
    $_SESSION['message'] = "You have been logged out! Please log in to view the database.";
	unset($_SESSION['username']);
	header('Location: ../userLogin.php');
}

?>
