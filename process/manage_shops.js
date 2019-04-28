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