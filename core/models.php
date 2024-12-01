<?php

require_once 'dbConfig.php';

function registerUser($pdo, $username, $password, $first_name, $last_name, $email, $address) {

    $checkUserSql = "SELECT * FROM users WHERE username = ?";
    $checkUserSqlStmt = $pdo->prepare($checkUserSql);
    $checkUserSqlStmt->execute([$username]);

    if ($checkUserSqlStmt->rowCount() == 0) {

        $sql = "INSERT INTO users (username, password, first_name, last_name, email, address, age) VALUES(?, ?, ?, ?, ?,?)";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$username, $password, $first_name, $last_name, $email,  $address]);

        if ($executeQuery) {
            $_SESSION['message'] = "User successfully registered!";
            return true;
        } else {
            $_SESSION['message'] = "An error occurred during registration.";
        }

    } else {
        $_SESSION['message'] = "Username already exists.";
    }
}


function loginUser($pdo, $username, $password) {
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);

    if ($stmt->rowCount() == 1) {
        
        $userInfo = $stmt->fetch();
        $usernameFromDB = $userInfo['username']; 
		$passwordFromDB = $userInfo['password'];

		if ($password == $passwordFromDB) {
			$_SESSION['username'] = $usernameFromDB;
			$_SESSION['message'] = "Login successful!";
			return true;
		}

		else {
			$_SESSION['message'] = "Password is invalid, but user exists";
		}
	}

	
	if ($stmt->rowCount() == 0) {
		$_SESSION['message'] = "Username doesn't exist from the database. You may consider registration first";
	}

}

function getApplicantByID($pdo, $applicant_id) {
	$sql = "SELECT * FROM registered WHERE applicant_id = ?";
	$stmt = $pdo->prepare($sql);
	if ($stmt->execute([$applicant_id])) {
		return $stmt->fetch();
	}
}

function seeAllApplicants($pdo){
    $sql = "select * from registered";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();
    if ($executeQuery) {
        return [
            "message" => "Records retrieved successfully",
            "statusCode" => 200,
            "querySet" => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    }
    return true;
}

function getApplicantBySearch($pdo, $search_query) {
	$sql = "SELECT * FROM registered WHERE 
			CONCAT(first_name,last_name,
				years_of_experience,country_of_origin,
				created_at,added_by,
				last_updated,
				last_updated_by) 
			LIKE ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%".$search_query."%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}
function insertAnActivityLog($pdo, $operation, $applicant_id, $first_name, 
		$last_name, $years_of_experience, $country_of_origin, $username) {

	$sql = "INSERT INTO activity_logs (operation, applicant_id, first_name, last_name, years_of_experience, 
    country_of_origin, username) VALUES(?,?,?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$operation, $applicant_id, $first_name, 
    $last_name, $years_of_experience, $country_of_origin, $username]);

	if ($executeQuery) {
		return true;
	}

}

function seeAllActivityLogs($pdo) {
	$sql = "SELECT * FROM activity_logs 
			ORDER BY date_added DESC";
	$stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();
    if ($executeQuery) {
        return [
            "message" => "Records retrieved successfully",
            "statusCode" => 200,
            "querySet" => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    }
    return true;
}

function insertIntoReg($pdo, $first_name, $last_name, $years_of_experience, $country_of_origin, $added_by) {
	$response = array();
	$sql = "INSERT INTO registered (first_name, last_name, years_of_experience, country_of_origin, added_by) VALUES(?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$insertApplicant = $stmt->execute([$first_name, $last_name, $years_of_experience, $country_of_origin, $added_by]);

	if ($insertApplicant) {
		$findInsertedItemSQL = "SELECT * FROM registered ORDER BY date_added DESC LIMIT 1";
		$stmtfindInsertedItemSQL = $pdo->prepare($findInsertedItemSQL);
		$stmtfindInsertedItemSQL->execute();
		$getApplicantID = $stmtfindInsertedItemSQL->fetch();

		$insertAnActivityLog = insertAnActivityLog($pdo, "INSERT", $getApplicantID['applicant_id'], 
			$getApplicantID['first_name'], $getApplicantID['last_name'], 
			$getApplicantID['years_of_experience'], $getApplicantID['country_of_origin'], $_SESSION['username']);

		if ($insertAnActivityLog) {
			$response = array(
				"status" =>"200",
				"message"=>"Applicant addedd successfully!"
			);
		}

		else {
			$response = array(
				"status" =>"400",
				"message"=>"Insertion of activity log failed!"
			);
		}
		
	}

	else {
		$response = array(
			"status" =>"400",
			"message"=>"Insertion of data failed!"
		);

	}

	return $response;
}
function updateApplicant($pdo, $first_name, $last_name, $years_of_experience, $country_of_origin, $last_updated, $last_updated_by, $applicant_id ) {

	$response = array();
	$sql = "UPDATE registered
			SET first_name = ?,
				last_name = ?,
				years_of_experience = ?, 
				country_of_origin = ?, 
				last_updated = ?,
                last_updated_by = ? 
			WHERE applicant_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$updateBranch = $stmt->execute([ $first_name, $last_name, $years_of_experience, $country_of_origin, $last_updated, $last_updated_by, $applicant_id]);

	if ($updateBranch) {

		$findInsertedItemSQL = "SELECT * FROM registered WHERE applicant_id = ?";
		$stmtfindInsertedItemSQL = $pdo->prepare($findInsertedItemSQL);
		$stmtfindInsertedItemSQL->execute([$applicant_id]);
		$getApplicantID = $stmtfindInsertedItemSQL->fetch(); 

		$insertAnActivityLog = insertAnActivityLog($pdo, "UPDATE", $getApplicantID['applicant_id'], 
			$getApplicantID['first_name'], $getApplicantID['last_name'], 
			$getApplicantID['years_of_experience'], $getApplicantID['country_of_origin'], $_SESSION['username']);

		if ($insertAnActivityLog) {

			$response = array(
				"status" =>"200",
				"message"=>"Updated the applicant successfully!"
			);
		}

		else {
			$response = array(
				"status" =>"400",
				"message"=>"Insertion of activity log failed!"
			);
		}

	}

	else {
		$response = array(
			"status" =>"400",
			"message"=>"An error has occured with the query!"
		);
	}

	return $response;

}

function deleteApplicant($pdo, $applicant_id) {
	$response = array();
	$sql = "SELECT * FROM registered WHERE applicant_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$applicant_id]);
	$getApplicantID = $stmt->fetch();

	$insertAnActivityLog = insertAnActivityLog($pdo, "DELETE", $getApplicantID['applicant_id'], 
		$getApplicantID['first_name'], $getApplicantID['last_name'], 
		$getApplicantID['years_of_experience'], $getApplicantID['country_of_origin'], $_SESSION['username']);

	if ($insertAnActivityLog) {
		$deleteSql = "DELETE FROM registered WHERE applicant_id = ?";
		$deleteStmt = $pdo->prepare($deleteSql);
		$deleteQuery = $deleteStmt->execute([$applicant_id]);

		if ($deleteQuery) {
			$response = array(
				"status" =>"200",
				"message"=>"Deleted the applicant's registration successfully!"
			);
		}
		else {
			$response = array(
				"status" =>"400",
				"message"=>"Deletion failed!"
			);
		}
	}
	else {
		$response = array(
			"status" =>"400",
			"message"=>"An error has occured with the query!"
		);
	}

	return $response;
}

?>