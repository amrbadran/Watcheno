
<?php 
	include('config.php');
	
	$video_title = addslashes($_POST['title_video']);
	$video_descr = addslashes($_POST['descr_video']);
	$video_key = addslashes($_POST['video_key']);
	$thumbnail_tmp_name = $_FILES['thumbnail']['tmp_name'];
	if(empty($thumbnail_tmp_name)){

		$sql = "UPDATE videos SET video_title='$video_title',video_descr='$video_descr',active='none2' WHERE id='$video_key'";
		if($conn->exec($sql)):

			echo $video_key;
			setcookie("none",$video_key,time() - 86400,"/");
			setcookie("none2",$video_key,time() + 86400,"/");

		endif;
		
	}

	else{

		$thumbnail_ext = pathinfo($_FILES['thumbnail']['name'],PATHINFO_EXTENSION);
		
		$thumbnail_name = uniqid(rand()) . '.' . $thumbnail_ext;
		$thumbnail_dest = 'images/' . $thumbnail_name;
		$thumbnail_ext_sec = explode('.',$_FILES['thumbnail']['name']);
		$arr_allowed = array('jpg','jpeg','png');
		if(!in_array($thumbnail_ext_sec[1],$arr_allowed)){
			echo 11;
		}else{	
		
		if(move_uploaded_file($thumbnail_tmp_name,$thumbnail_dest)){
			
			$sql = "UPDATE videos SET video_title='$video_title',video_descr='$video_descr',video_thumbnail='$thumbnail_dest',active='none2' WHERE id='$video_key'";


			if($conn->exec($sql)){
				if(getimagesize($thumbnail_dest) === false){
					setcookie("none",$id,time() - 86400,"/");
					setcookie("none2",$video_key,time() - 86400,"/");

					$sql = "SELECT video_src FROM videos WHERE id='$video_key'";

					$stmt = $conn->prepare($sql);

					$stmt->execute();

					while($row = $stmt->fetch()){

						$video_src_delete = $row['video_src'];

					}
					unlink($thumbnail_dest);
					unlink($video_src_delete);
					$sql_de = "DELETE FROM videos WHERE id='$video_key'";

					if($conn->exec($sql_de)){

						echo 1;

					}
					else echo 0;

				}else{
					echo $video_key;
					setcookie("none",$video_key,time() - 86400,"/");
					setcookie("none2",$video_key,time() + 86400,"/");
				}
			}

			
			}
		}
	}

?>