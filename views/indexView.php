<?php

include('includes/header.php');

?>

<div class="container">
  <header class="row"> 
	  <p>Connexion</p>
  </header>

	<?php
	// error message if there is an error in sent form
	if(isset($error_message)){
		echo '<p class="error-message col-10 col-md-5 col-lg-4 mx-auto mt-3 text-center">' . $error_message . '</p>';
	}
	?>
	<div class="row connexion text-center mt-5">
		
			<form class="col-12 col-md-5 col-lg-4 mx-auto" action="../controllers/index.php" method="post">
							<label class="col-12 text-left mx-auto p-0">E-mail:</label>
							<input class="col-12 mx-auto" placeholder="E-mail" name="mail" type="email" value="<?php if(isset($_SESSION['mail'])){ echo $_SESSION['mail'] ;}?>" autofocus required>
							<label class="col-12 text-left mt-3 mx-auto p-0">Mot de passe:</label>
							<input class="col-12 mx-auto" placeholder="Mot de passe" name="password" type="password" required>
							<input type="hidden" name="verif" value="">
						
					
							<div class="pt-3">
								<input class="col-12 mt-2 mx-auto mt-4 btnco" class="btnco" type="submit" name="connection" value="Me connecter">
							</div>
					
								 
									<p class="col-10 col-md-10 col-lg-11 mt-2 mx-auto sign pt-5 p-0"><a href="../controllers/registration.php">Vous n'avez pas encore de compte? Inscrivez-vous !</a></p>
								
					
			
			</form>

	</div>
	
</div>
<?php

include('includes/footer.php');

?>