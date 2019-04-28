<?php
		include('connect.php');
			
		if(isset($_GET["user_id"]) AND isset($_GET["shop_id"]))
		{

			$user_id = $_GET['user_id'];
			$shop_id = $_GET['shop_id']; 
		
			$stmt = $con->prepare('INSERT INTO users_disliked_shops_2h(user_id,shop_id,dislike_datetime) VALUES(?,?,now())');
			$stmt->execute(array($user_id,$shop_id));
		
		}else{

			header('Location: sign_in.php');
		}
?>