<?php

include('includes/header.php');

//foreach($accounts as $account){
?>

<div class="container">
  <header class="row"> 
	  <p>Inscription</p>
  </header>


<?php
// Si il y a une erreur dans le formulaire
if(isset($error_message)){
	echo '<p class="error-message col-10 col-md-5 col-lg-4 mx-auto mt-3 text-center">' . $error_message . '</p>';
}
?>

<div class="row connexion text-center mt-5">

	<form class="col-12 col-md-5 col-lg-3 mx-auto" action="../controllers/registration.php" method="post">
		<input class="col-12 mt-2 mx-auto" type="text" name="mail" placeholder="Mon E-mail" required autofocus>
		<input class="col-12 mt-2 mx-auto" type="text" name="name" placeholder="Mon Prénom" required>
		<input class="col-12 mt-2 mx-auto" type="password" name="password" placeholder="Mon mot de passe" required>
		<input class="col-12 mt-2 mx-auto" type="password" name="confirmation" placeholder="Confirmation du mot de passe" required>
		<input class="col-12 mt-2 mx-auto" type="hidden" name="verif" value="">
		<div class="pt-3">
			<input class="col-12 mt-2 mx-auto btnco" type="submit" name="connection" value="Créer mon compte">
		</div>
	</form>

	<p class="col-12 mt-2 mx-auto sign pt-5"><a href="../controllers/index.php">Vous êtes déjà inscrit? Connectez-vous !</a></p>
</div>


<?php

include('includes/footer.php');

?>