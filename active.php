<?php 

	include('config.php');

	$active_code = addslashes($_GET['a']);

	$sql = $conn->prepare("SELECT active_code,active FROM users WHERE active_code = ?");
	$sql->execute(array($active_code));

	while($row = $sql->fetch()){
		$active = $row['active'];
		$active_code2 = $row['active_code']; 
	}

	if(isset($_GET['a'])){
		if($active){
			header("Location: 404.php");
		}else{
			$sql = $conn->prepare("UPDATE users SET active=1 WHERE active_code=?");
			$update = $sql->execute(array($active_code));
			if($update){
				header("Location: index.php");
			}
		}
	}else{
		header("Location: 404.php");
	}
?>