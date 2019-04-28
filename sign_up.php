<?php 
	session_start();
	$noNavbar = '';
	$pageTitle = 'Sign up';

	if(isset($_SESSION['user'])){
		header('Location: sign_in.php'); // Redirect To Dashboard Page
	}

	include 'init.php';
	
		/* Check if user coming from HTTP Post Request */
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			
			if(isset($_POST['signup'])){

				/* Les erreurs */
                $formErrors = array();


				$email 		   = $_POST['email'];
	            $password      = $_POST['password'];
				$passwordAgain = $_POST['password-again'];
				
				
				/* Filter user login informations */
				if(isset($email)){

                    $filterEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

                    if(filter_var($filterEmail, FILTER_VALIDATE_EMAIL) != true){
                        $formErrors[] = '<div style="font-size: 12px; margin-bottom: -15px;" class="alert alert-danger">The email can not be empty</div>';
                    }

                }
				

                if(isset($password) && isset($passwordAgain)){

                    //We don(t need to filter the password because we alredy put a hash to our password , even if the user put <script src =>password </script> 

                    if(empty($_POST['password'])){
                        $formErrors[] = '<div style="font-size: 12px; margin-bottom: -15px;" class="alert alert-danger">the password can not be empty</div>';
                    }

                    $shaPassword = sha1($password);
                    $shaPasswordAgain = sha1($passwordAgain);

                    if(sha1($password) !== sha1($passwordAgain)){
                        $formErrors[] = '<div style="font-size: 12px; margin-bottom: -15px;" class="alert alert-danger">Passwords do not match</div>';
                    }               
                }

	            /********************* End Filter **********************/


	        //Check if user aleardy exists in database
            $check_user_email = checkItem("email","user",$email);

            if($check_user_email){

				$formErrors[] = '<div style="font-size: 12px; margin-bottom: -15px;" class="alert alert-danger">This email already exists';

			}
			else{

					// Insert UserInfo in database
					$stmt = $con->prepare('INSERT INTO user(email,password) VALUES(?,?) ');

					$stmt->execute(array($email, $shaPasswordAgain));

					// Echo Success Message
					$msgSucess ='Congratulations, your account has been successfully created, you will be redirected to the main page in a few seconds';
					

					header("refresh:5;url=sign_in.php");
					
			}

		}
	
	}


?>
	
	<!-- Début formulaire d'inscription -->

	<form class="form-horizontal signup" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
		<h4 style="color:#000" class="text-center">User Sign up</h4>

        <!-- Début : Email -->
        <div class="form-group">
            <div class="input-group">
                <input type="email" id="email" name="email" placeholder="Email" class="form-control" autocomplete="off" required>
            </div>
        </div>
        <!-- Fin : Email-->

        <!-- Début : Mot de passe -->
        <div class="form-group">
            <div class="input-group">
                <input type="password" id="password" name="password" autocomplete="new-password" placeholder="Password" class="form-control" required>
            </div>
        </div>
        <!-- Fin : Mot de passe -->

        <!-- Début : Répéter mot de passe -->
        <div class="form-group">
            <div class="input-group">
                <input type="password" id="password-again" name="password-again" autocomplete="new-password" placeholder="Repeat password" class="form-control" required>
            </div>
        </div>
        <!-- Fin : Répéter mot de passe -->


        <div class="form-group">
        	<input class="btn btn-primary btn-block" type="submit" value="Sign up" name="signup">	
        	<a href="sign_in.php">Already have an account ?</a>
        </div>

        <!-- Début: Section d'erreurs & messages -->
		<div class="the-errors text-center">
			<?php
				if(!empty($formErrors)){
					foreach($formErrors as $error){
						echo $error . '<br>';
					}
				}

				if(isset($msgSucess)){
					echo '<div class="alert alert-success">'.$msgSucess.'</div>';	
				}			
			?>
		</div>
		<!-- Fin: Section d'erreurs & messages -->


    </form>
    <!-- Fin formulaire d'inscription -->

    


<?php include $tpl.'footer.php'; ?>