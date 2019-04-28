<?php 
	session_start();
	$noNavbar = '';
	$pageTitle = 'Sign in';

	if(isset($_SESSION['userid'])){
		header('Location: index.php'); // Redirect To Dashboard Page
	}
	
	include 'init.php';
	
	// Check if user coming from HTTP Post Request
	if($_SERVER['REQUEST_METHOD'] == 'POST'){


        /* Les erreurs */
        $formErrors = array();

		$email = $_POST['email'];
		$password = $_POST['pass'];
		$hashedPass = sha1($password);
	
		// Check if the user exist in database
		$stmt = $con->prepare('SELECT id, email, password 
						
								FROM user 
								WHERE email = ? AND password = ?
							 ');
		
		$stmt->execute(array($email, $hashedPass));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();

		// If Count > 0 this mean the database contains record about this username
		if($count > 0){
			$_SESSION['user'] = $email; // Register session email
			$_SESSION['userid'] = $row['id'];
			header('Location: index.php'); // Redirect To Dashboard Page
			exit();
		}else{
			$formErrors[] = '<div style="font-size: 12px; margin-bottom: -15px;" class="alert alert-danger">Email or password not valid';
		}

	}


?>
	<!-- Début formulaire d'inscription -->

	<form class="login" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
		<h4 style="color:#000" class="text-center">User Login</h4>
        
         <!-- Début : Email -->
        <div class="form-group">
            <div class="input-group">
				<input class="form-control input" type="text" name="email" placeholder="Email address" autocomplete="off">
			</div>
        </div>
        <!-- Fin : Email-->

		 <!-- Début : Mot de passe -->
        <div class="form-group">
            <div class="input-group">
				<input class="form-control" type="password" name="pass" placeholder="Password" autocomplete="new-password">
			</div>
        </div>
        <!-- Fin : Mot de passe -->

		<input class="btn btn-primary btn-block" type="submit" value="Login">
	
	<a href="sign_up.php">New account</a>

	<!-- Début: Section d'erreurs & messages -->
	<div class="the-errors text-center">
		<?php
			if(!empty($formErrors)){
				foreach($formErrors as $error){
					echo $error . '<br>';
				}
			}

			if(isset($msgSucess)){
				echo '<div class="msg success">'.$msgSucess.'</div>';	
			}			
		?>
	</div>
	<!-- Fin: Section d'erreurs & messages -->
	</form>

	<!-- Fin formulaire d'inscription -->


	


<?php include $tpl.'footer.php'; ?>