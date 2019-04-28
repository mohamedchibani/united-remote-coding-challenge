<?php 

	ob_start(); //Output Buffering Start -> Save output execept header in memory
	session_start();
	
	if(isset($_SESSION['user'])){
	 
		$pageTitle = 'Preferred Shops';

		include 'init.php';

		//Get all preferred shops informations  with current position of your company United Remote RABAT (lat: 33.9954189 - lng: -6.8522116)
    $stmt = $con->prepare('SELECT 

                          users_preferred_shops.*,
                          shop.name as name,
                          ACOS(SIN(RADIANS(33.9954189)) * SIN(RADIANS(shop.position_latitude)) + COS(RADIANS(33.9954189)) * COS(RADIANS(shop.position_latitude))
       * COS(RADIANS(shop.position_longitude - (-6.8522116)))) * 3959 as distance
  
                           FROM users_preferred_shops
                           JOIN shop ON shop.id = users_preferred_shops.shop_id
                           WHERE users_preferred_shops.user_id = ?  
                           AND ACOS(SIN(RADIANS(33.9954189)) * SIN(RADIANS(position_latitude)) + COS(RADIANS(33.9954189)) * COS(RADIANS(position_latitude)) * COS(RADIANS(position_longitude - (-6.8522116)))) * 3959 

						   ORDER BY distance
                           ');
    $stmt->execute(array($_SESSION['userid']));
		$preferred_shops = $stmt->fetchAll();

	?>  


	<div class="container">
		<div class="row">
			<?php foreach($preferred_shops as $shop){ ?>		
				<div class="col-lg-3 col-md-3 col-sm-2 col-xs-1" style="margin-bottom:15px">
					<div class="card" style="width: 16rem;">
					  <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title"><?php echo $shop['name']?></h5>
					    <a href="#" class="btn btn-danger remove_btn" 
		                  data-shopid="<?php echo $shop['shop_id']?>"
		                  data-userid="<?php echo $_SESSION['userid']?>">
		                  <i class="fa fa-trash"></i> Remove
		                </a><br>
		                <small><b><?php echo round($shop['distance'],2)?> KM</b></small>
					  </div>
					</div>
				</div>
			<?php }?>
		</div>
	</div>

	<?php	
		include $tpl.'footer.php';
  ?>
   
    <script>
            
      $(document).ready(function(){

        $('.remove_btn').click(function(){
                 
            var shop_id = $(this).data('shopid');
            var user_id = $(this).data('userid');
                
          $.ajax({
            url   : 'removeFromPreferredShops.php',
            method  : 'GET',  
            data  : {
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

	ob_end_flush();

?>