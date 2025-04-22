<?php 
	session_start();
	include("config.php");
	$username = addslashes($_SESSION['logged_in']);
	$report_id = addslashes($_POST['id_report']);
	$report_type = addslashes($_POST['report_type']);
	$report_link = addslashes($_POST['report_link']);
	if(empty($report_id)){

		header("Location : 404.php");

	}
	$sql = "SELECT * FROM reports WHERE username = '$username' AND id_report = '$report_id' AND type_report = '$report_type'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	if($stmt->rowCount() == 1){
		echo 11;
	}else{

		if(!isset($_SESSION['logged_in'])){

			echo 0;

		}else{

			$sql = "INSERT INTO reports(type_report,id_report,username,link) VALUES('$report_type','$report_id','$username','$report_link')";
			if($conn->exec($sql)){

				echo 1;

			}else{
				echo 11;
			}

		}
	}
	

?>