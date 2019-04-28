<?php 

	ob_start(); //Output Buffering Start -> Save output execept header in memory
	session_start();
	
	if(isset($_SESSION['user'])){
	 
		$pageTitle = 'Nearby shops';

		include 'init.php';

		
        //Delete all disliked shops over 2 hours ago by this user - added to optimize query stmt
        /*$stmt0 = $con->prepare("DELETE FROM users_disliked_shops_2h 
                                WHERE users_disliked_shops_2h.dislike_datetime < DATE_SUB(NOW(), INTERVAL 2 HOUR)
                                AND user_id = ?
        	");
        $stmt0->execute(array($_SESSION["userid"]));*/


		//Get all shops informations with current position of your company United Remote RABAT (lat: 33.9954189 - lng: -6.8522116)
		$stmt = $con->prepare("SELECT shop.*, 

                           ACOS(SIN(RADIANS(33.9954189)) * SIN(RADIANS(position_latitude)) + COS(RADIANS(33.9954189)) * COS(RADIANS(position_latitude)) * COS(RADIANS(position_longitude - (-6.8522116)))) * 3959 as distance
			               FROM shop
                           
                           LEFT JOIN users_preferred_shops ON users_preferred_shops.shop_id = shop.id
                           LEFT JOIN users_disliked_shops_2h ON users_disliked_shops_2h.shop_id = shop.id
                           WHERE users_preferred_shops.shop_id IS NULL 
						   
						   AND ( users_disliked_shops_2h.dislike_datetime < DATE_SUB(NOW(), INTERVAL 2 HOUR)  
						   OR users_disliked_shops_2h.dislike_datetime IS NULL )
						   
						   AND ACOS(SIN(RADIANS(33.9954189)) * SIN(RADIANS(position_latitude)) + COS(RADIANS(33.9954189)) * COS(RADIANS(position_latitude)) * COS(RADIANS(position_longitude - (-6.8522116)))) * 3959
						   #AND users_preferred_shops.user_id IS NULL
						   #AND (users_disliked_shops_2h.user_id IS NULL OR AND users_disliked_shops_2h.user_id = ? )

						   ORDER BY distance
                           ");
    	$stmt->execute(array($_SESSION["userid"]));
		$shops = $stmt->fetchAll();
	?>  


	<div class="container">
		<div class="row">
			<?php foreach($shops as $shop){ ?>		
				<div class="col-lg-3 col-md-3 col-sm-2 col-xs-1" style="margin-bottom:15px">
					<div class="card" style="width: 16rem;">
					  <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title"><?php echo $shop['name']?></h5>
					    <a href="#" 
								data-shopid="<?php echo $shop['id']?>"
					    		data-userid="<?php echo $_SESSION['userid']?>)" 
					    class="btn btn-danger dislike_btn"><i class="fa fa-thumbs-down"></i> 
							Dislike
						</a>
					    
					    <a href="#" 
					    		data-shopid="<?php echo $shop['id']?>"
					    		data-userid="<?php echo $_SESSION['userid']?>" 
					    	class="btn btn-success like_btn">
					  		<i class="fa fa-thumbs-up"></i> 
					  		Like
					  	</a>
					  	<br>
					  	<small><b><?php echo round($shop['distance'],2)?> KM</b></small>
					  </div>
					</div>
				</div>
			<?php }?>
		</div>
	</div>


	<?php	
		/* End Dashboard Page*/

		include $tpl.'footer.php';

	?>
		<script>
						
			$(document).ready(function(){
				
				$('.like_btn').click(function(){
		             
		            var shop_id = $(this).data('shopid');
					var user_id = $(this).data('userid');
		            
		             $.ajax({
						url 	: 'addToPreferredShops.php',
						method  : 'GET',	
						data 	: {
									shop_id : shop_id, 
									user_id : user_id
						}

					})

		            $(this).parent().parent().parent().fadeOut(500);
				});

				$('.dislike_btn').click(function(){
		             
		            var shop_id = $(this).data('shopid');
					var user_id = $(this).data('userid');
		            
		             $.ajax({
						url 	: 'addToHiddenShopsOver2hours.php',
						method  : 'GET',	
						data 	: {
									shop_id : shop_id, 
									user_id : user_id
						}

					})

		            $(this).parent().parent().parent().fadeOut(500);
				});

			});

		</script>


	<?php
	
	}else{
		
		header('Location: sign_in.php');

		exit();
	}
?>



<?php
	ob_end_flush();

?>