<?php
session_start();

// autoloading classes
function chargerClasse($classname)
{
    if(file_exists('../models/'. $classname.'.php'))
    {
        require '../models/'. $classname.'.php';
    }
        else 
        {
            require '../entities/' . $classname . '.php';
        }
}
spl_autoload_register('chargerClasse');


$db = Database::Db();

$manager = new AccountManager($db);
$userManager = new UserManager($db);

if($_POST){

	if((isset($_POST['name']) && !empty($_POST['name'])) && (isset($_POST['mail']) && !empty($_POST['mail'])) && (isset($_POST['password']) && !empty($_POST['password'])) && (isset($_POST['confirmation']) && !empty($_POST['confirmation']))){

		$name = htmlspecialchars($_POST['name']);
		$mail = htmlspecialchars($_POST['mail']);
		$password = htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT));
		$confirmation = htmlspecialchars($_POST['confirmation']);

		// instantiates object user with sent informations
		$user = new User([
			'name' => $name,
			'mail' => $mail,
			'password' => $password
		]);

						// if user exists in db
						if($userManager->checkIfExist($user) != 0){
							// On déclare un message d'erreur
							$error_message = 'Cet utilisateur existe déjà. Si c\'est bien vous, <a href="../controllers/index.php">Connectez-vous</a>';
						}
						else {
							// if pw and confirmation match
							if(password_verify($confirmation, $password)){
								// add user in db
								$userManager->add($user);
								// session variable
								$_SESSION['mail'] = $mail;
								
                                header('location: index.php');
							}
							// if pw and confirmation don't match
							else{
								$error_message = 'La confirmation du mot de passe ne correspond pas au mot de passe';
							}
						}
					}
	else
	{
		$error_message = 'Erreur';
	}
}


include "../views/registrationView.php";