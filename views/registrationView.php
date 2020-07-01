<?php

include('includes/header.php');

//foreach($accounts as $account){
?>

<div class="container">
  <header class="row"> 
	  <p>Inscription</p>
  </header>


<?php
// error message if there is an error in the sent form
if(isset($error_message)){
	echo '<p class="error-message col-10 col-md-5 col-lg-4 mx-auto mt-3 text-center">' . $error_message . '</p>';
}
?>

<div class="row connexion text-center mt-5">

	<form class="col-12 col-md-5 col-lg-4 mx-auto" action="../controllers/registration.php" method="post">
		<label class="col-12 text-left mt-3 mx-auto p-0">E-mail:</label>
		<input class="col-12 mx-auto" type="text" name="mail" placeholder="Votre e-mail" required autofocus>
		<label class="col-12 text-left mt-3 mx-auto p-0">Nom d'utilisateur:</label>
		<input class="col-12 mx-auto" type="text" name="name" placeholder="Votre nom" required>
		<label class="col-12 text-left mt-3 mx-auto p-0">Mot de passe:</label>
		<input class="col-12 mx-auto" type="password" name="password" placeholder="Votre mot de passe" required>
		<label class="col-12 text-left mt-3 mx-auto p-0">Confirmation du mot de passe:</label>
		<input class="col-12 mx-auto" type="password" name="confirmation" placeholder="Confirmez votre mot de passe" required>
		<input class="col-12 mt-2 mt-2 mx-auto" type="hidden" name="verif" value="">
		<div class="pt-3">
			<input class="col-12 mt-2 mx-auto mt-4 btnco" type="submit" name="connection" value="Créer mon compte">
		</div>
	</form>

	<p class="col-10 mt-2 mx-auto sign pt-5"><a href="../controllers/index.php">Vous êtes déjà inscrit? Connectez-vous !</a></p>
</div>


<?php

include('includes/footer.php');

?>