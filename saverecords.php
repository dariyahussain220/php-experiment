<?php
$inipath = php_ini_loaded_file();

	if ($inipath) {
	
	   if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
		
			echo 'We don\'t have mysqli';
		
		} else {
			
			$attemptingDate  = date("Y-m-d H:i:s");
			
			$firstName  = $_POST['firstName'];

			$lastName  = $_POST['lastName'];

			$studentNumber  = $_POST['studentNumber'];

			$noOfAttempts  = $_POST['attempts'];

			$host         = "localhost";
			$username     = "root";
			$password     = "Admin@123";

			$conn = new mysqli($host, $username, $password);
			
			//check connection 
			if (mysqli_connect_error()) {
				die("Connection failed: " . $conn->mysqli_connect_error());
			} else {
				
					$queryDB = "CREATE DATABASE IF NOT EXISTS quiz";
					$conn->query($queryDB);
					$conn->close();
					
					$conn = new mysqli($host, $username, $password, 'quiz');
					$tableQuery = "CREATE TABLE IF NOT EXISTS attempts ( 
						attemptId BIGINT(8) AUTO_INCREMENT PRIMARY KEY,
						attemptingDate VARCHAR(30) NOT NULL,
						firstName VARCHAR(30) NOT NULL,
						lastName VARCHAR(30),
						studentNumber INT(8) NOT NULL,
						noOfAttempts INT(8),
						score INT(8)
						)";
					$conn->query($tableQuery);

					$sql    = "INSERT INTO attempts (attemptingDate, firstName, lastName, studentNumber, noOfAttempts) VALUES (?, ?, ?, ?, ?)";
					if($stmt = $conn->prepare($sql)){
						$stmt->bind_param('sssii', $attemptingDate, $firstName, $lastName, $studentNumber, $noOfAttempts);
					
						if($stmt->execute()){							
							header('Location :http://http://localhost:8080/markquiz.php');
							exit;
							
						} else {
							echo "Error occured while saving data...";
						}
					} else {
						echo "Error occured while making query";
					}
				}
				$conn->close();
			}
	} else {
			echo 'failed to load ini path..';
		}
?>