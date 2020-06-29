<?php

include('includes/header.php');

?>

<div class="container">
  <header class="row"> 
	  <p>Connexion</p>
  </header>

	<?php
	// Si il y a une erreur dans le formulaire
	if(isset($error_message)){
		echo '<p class="error-message col-10 col-md-5 col-lg-4 mx-auto mt-3 text-center">' . $error_message . '</p>';
	}
	?>
	<div class="row connexion text-center mt-5">
		
			<form class="col-12 col-md-5 col-lg-3 mx-auto" action="../controllers/index.php" method="post">
			
						<input class="col-12 mt-2 mx-auto" placeholder="E-mail" name="mail" type="email" value="<?php if(isset($_SESSION['mail'])){ echo $_SESSION['mail'] ;}?>" autofocus required>

							<input class="col-12 mt-2 mx-auto" placeholder="Password" name="password" type="password" required>
									<!-- <input type="hidden" name="token" value="<?php echo $token; ?>"> -->
							<input type="hidden" name="verif" value="">
						
					
							<div class="pt-3">
								<input class="col-12 mt-2 mx-auto btnco" class="btnco" type="submit" name="connection" value="Me connecter">
							</div>
					
								 
									<p class="col-12 mt-2 mx-auto sign pt-5"><a href="../controllers/registration.php">Vous n'avez pas encore de compte? <br>Inscrivez-vous !</a></p>
								
					
			
			</form>

	</div>
	
</div>
<?php

include('includes/footer.php');

?>