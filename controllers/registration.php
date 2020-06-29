<?php
session_start();
// if (empty($_SESSION['token'])) {
//     $_SESSION['token'] = bin2hex(random_bytes(32));
// }
// $token = $_SESSION['token'];

// Chargement automatique des classes
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

// Si la variable $_SESSION['id'] n'existe pas, nous ne sommes pas connectés, on redirige automatiquement vers la page de connexion
// if(!isset($_SESSION['id'])){
// 	header('location: index.php');
// }
$db = Database::Db();
// On instancie notre manager
$manager = new AccountManager($db);
$userManager = new UserManager($db);
// Si un formulaire a été envoyé
if($_POST){

// if(empty($_POST['verif']) && !empty($_POST['token'])){
	//
	// 	  if (hash_equals($_SESSION['token'], $_POST['token'])) {

					if((isset($_POST['name']) && !empty($_POST['name'])) && (isset($_POST['mail']) && !empty($_POST['mail'])) && (isset($_POST['password']) && !empty($_POST['password'])) && (isset($_POST['confirmation']) && !empty($_POST['confirmation']))){

						$name = htmlspecialchars($_POST['name']);
						$mail = htmlspecialchars($_POST['mail']);
						$password = htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT));
						$confirmation = htmlspecialchars($_POST['confirmation']);

						// On instancie un objet $user avec les infos envoyées
						$user = new User([
							'name' => $name,
							'mail' => $mail,
							'password' => $password
						]);

						// Si l'adresse mail existe déjà en BDD
						if($userManager->checkIfExist($user) != 0){
							// On déclare un message d'erreur
							$error_message = 'Cet utilisateur existe déjà. Si c\'est bien vous, <a href="../controllers/index.php">Connectez-vous</a>';
						}
						else {
							// Si le password et la confirmation de password correspondent
							if(password_verify($confirmation, $password)){
								// On ajoute le user en BDD
								$userManager->add($user);
								// On crée une variable de session afin de pré-remplir le formulaire de connexion
								$_SESSION['mail'] = $mail;
								// On redirige vers la page de connexion
                                header('location: index.php');
							}
							// Si le password et la confirmation ne correspondent pas, on déclare un message d'erreur
							else{
								$error_message = 'La confirmation du mot de passe ne correspond pas au mot de passe';
							}
						}
					}
	// 			}
	// 			else
	// 			{
	// 				$error_message = 'Erreur';
	// 			}
	// }
	else
	{
		$error_message = 'Erreur';
	}


}

// La variable $accountAvailabled nous sert à lister les comptes possibles à créer
// $accountAvailabled = Account::ACCOUNT;

// // On récupère tous les comptes dans la BDD
// $accounts = $manager->getAll($_SESSION['id']);

// // La variable $nbAccounts nous sert à savoir combien il y a de comptes en BDD pour afficher ou non le formulaire de tranfert
// $nbAccounts = count($accounts);


// Enfin, on inclut la vue
include "../views/registrationView.php";