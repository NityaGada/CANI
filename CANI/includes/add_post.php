<?php 
	
	session_start();
	
	include('db.php');
	
	date_default_timezone_set('Asia/Kolkata');
	
	$user_nam = $_SESSION['first'].' '.$_SESSION['last'];

	$user_email_address = $_SESSION['email'];
	
	$user_pic = $_SESSION['image'];
	
	$postdate = date('F d, Y h:i a');
	
	$post_title =  $conn->real_escape_string($_POST['title']);

    $postcont = $conn->real_escape_string($_POST['postcont']);

	$contentprompt = $conn->real_escape_string($_POST['contentprompt']);

	$imageprompt = $conn->real_escape_string($_POST['imageprompt']);

	$toolcontent = $conn->real_escape_string($_POST['toolcontent']);

	$toolimage = $conn->real_escape_string($_POST['toolimage']);
	
	$topic_id = $_SESSION["id"];
	
	$post_image = $_FILES['post_ima']['name'];
	
			$post_tmp_n = $_FILES['post_ima']['tmp_name'];


	move_uploaded_file($post_tmp_n,'../img/'.$post_image);
	
	echo $contentprompt,$postcont,$post_image,$imageprompt,$toolcontent,$toolimage,$topic_id,$user_pic,$post_title; 
	
	if($postcont && $post_image && $contentprompt && $imageprompt ){
		try{
			$query = 'INSERT INTO user_post(`user_name`,`user_email`,`user_picture`,`post_date`,`post_title`,`post_content`,`post_image`,`content_prompt`,`image_prompt`,`content_ai`,`image_ai`,`topic_id`) VALUES("'.$user_nam.'","'.$user_email_address.'","'.$user_pic.'","'.$postdate.'","'.$post_title.'","'.$postcont.'","'.$post_image.'","'.$contentprompt.'","'.$imageprompt.'","'.$toolcontent.'","'.$toolimage.'","'.$topic_id.'")';
			
			mysqli_query($conn,$query);

			

			if (isset($_GET['profile'])) {
				header('location: ../profile.php?result=post-added-successful');
			} else {
				header('location: ../home.php?result=post-added-successful');
			}
		}catch (mysqli_sql_exception $e) {
			var_dump($e);
      		exit; 
		}
		
	}else{
		if (isset($_GET['profile'])) {
			header('location: ../profile.php?result=unable-to-create-post');
		} else {
			header('location: ../home.php?result=unable-to-create-post');
		}
	}
	














