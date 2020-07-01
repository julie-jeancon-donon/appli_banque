<?php
session_start();

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

// instantiates usermanager
$userManager = new UserManager();


if($_POST){


	// if form is correctly filled
	if((isset($_POST['mail']) && !empty($_POST['mail'])) && (isset($_POST['password']) && !empty($_POST['password']))){
	
		$mail = htmlspecialchars($_POST['mail']);
		$password = htmlspecialchars($_POST['password']);

		// instantiates user object with sent informations
		$user = new User([
			'mail' => $mail,
			'password' => $password
		]);
	}

		// if this account doesn't exist
		if($userManager->checkIfExist($user) == 0){
			$error_message = "L'adresse e-mail et/ou le mot de passe ne correspondent pas.";
		} 
					 
			else {
				// if pw doesn't match with this account
				if($userManager->checkPassword($user) == false){
					$error_message = "L'adresse e-mail et/ou le mot de passe ne correspondent pas.";
				}
					//if verifications are correct
					else {
						// instantiates user objects with sent informations in db
						$user = $userManager->getUser($user);
						// session variables 
						$_SESSION['id'] = $user->getId();
						$_SESSION['name'] = $user->getName();
						// redirection to accounts page
						header('location: account.php');
					}
			}
}


include('../views/indexView.php');