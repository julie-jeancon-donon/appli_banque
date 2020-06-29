<?php

// autoload classes
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
session_start();
spl_autoload_register('chargerClasse');

$db = Database::Db();

$manager = new AccountManager($db);
$type_manager = new TypeAccountManager($db);
$errorAccount = false;


// if we click on "ouvrir un nouveau compte", we create a new object Account and add in DB
if(isset($_POST['new']))
{
    // Si le champ name est bien rempli, et n'est pas vide
	if(isset($_POST['name']) && !empty($_POST['name'])){

        $verifAccount = $manager->checkIfExists($_POST['name']);
        if(!$verifAccount) {
            $idAccount = htmlspecialchars($_POST['name']);
            $balance = 80;
            
            $account = new Account([
                'balance'=>$balance,
                'user_id'=>$_SESSION['id'],
                'typeAccount'=>$idAccount
                ]);
                
                $manager->add($account);
                header('location: account.php');
        }
        else{
            $errorAccount = true;
        }
    }

}
    
// if we click on "supprimer", we delete account from DB
if(isset($_POST['delete']))
{
    $id = $_POST['id'];
    $account = $manager->getAccount($id);
    $manager->delete($account);
}


// if we click on "crediter", we credit balance of the account and we update balance in DB
if (isset($_POST['payment']))
{
    $id = $_POST['id'];
    $payment = $_POST['payment'];
    $balance = $_POST['balance'];
    $account = $manager->getAccount($id);
    $account->calculCredit($balance);
    $manager->update($account);
}

// if we click on "debiter", we debit balance of the account and update balance in DB
if (isset($_POST['debit']))
{
    $id = $_POST['id'];
    $debit = $_POST['debit'];
    $balance = $_POST['balance'];
    $account = $manager->getAccount($id);
    $account->calculDebit($balance);
    $manager->update($account);

    // // condition to PEL can't be debited
    // if($account->getName($id) != "PEL")
    // {
    //     $account->calculDebit($balance);
    //     $manager->update($account);
    // } 
}

// if we click on "transferer l'argent", we debit the account, credit the receiver and update in DB
if (isset($_POST['transfer']))
{
$idDebit = $_POST['idDebit'];
$idPayment = $_POST['idPayment'];
$balance = $_POST['balance'];

    $account = $manager->getAccount($idDebit);
    $accountTransfer = $manager->getAccount($idPayment);
    $account->calculDebit($balance);
    $accountTransfer->calculCredit($balance);
    $manager->update($account);
    $manager->update($accountTransfer);

    // // condition to PEL can't be debited
    // if($account->getTypeAccount($idDebit) != )
    // {
    //     $account->calculDebit($balance);
    //     $accountTransfer->calculCredit($balance);
    //     $manager->update($account);
    //     $manager->update($accountTransfer);

    // }

}

if (isset($_POST['logout']))
{
    session_destroy();
    header('location: index.php');
}

if(!isset($_SESSION['name'])){
    header('location: index.php');
}


// get accounts after all updates
$accounts = $manager->getAll($_SESSION['id']);
$account_type = $type_manager->getArrayAccounts();

include "../views/accountsView.php";