<?php
		include('connect.php');
			
		if(isset($_GET["user_id"]) AND isset($_GET["shop_id"]))
		{

			$user_id = $_GET['user_id'];
			$shop_id = $_GET['shop_id']; 
		
			$stmt = $con->prepare('DELETE FROM users_preferred_shops 
								   WHERE user_id = ? AND shop_id = ?');
			$stmt->execute(array($user_id,$shop_id));
		
		}else{

			header('Location: sign_in.php');
		}
?>