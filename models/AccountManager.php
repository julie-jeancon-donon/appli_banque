<?php


declare(strict_types = 1);

// create model class for account
class AccountManager
{
    private $_db;

    /**
     * constructor
     *
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }

    /**
     * Get the value of _db
     */ 
    public function getDb()
    {
        return $this->_db;
    }

    /**
     * Set the value of _db
     *
     * @param PDO $db
     * @return  self
     */ 
    public function setDb(PDO $db)
    {
        $this->_db = $db;

        return $this;
    }

    /**
     * get accounts
     *
     * @return Account
     */
    public function getArrayAccounts()
    {
        $arrayOfAccounts = [];
    
        $query = $this->getDb()->execute('SELECT * FROM type_account');
        $dataAccounts = $query->fetchAll(PDO::FETCH_ASSOC);
        
    
        foreach ($dataAccount as $typeAccount) {
            $arrayOfAccounts[] = new Account($typeAccount);
        }
        
        return $arrayOfAccounts;
    }

    /**
     * Add new account in DB
     *
     * @param Account $account
     * @return void
     */
    public function add(Account $account)
    { 
        $query = $this->getDb()->prepare('INSERT INTO bank_account(balance, user_id, typeAccount) VALUES (:balance, :user_id, :typeAccount)');
        $query->bindValue('balance', $account->getBalance(), PDO::PARAM_INT);
        $query->bindValue('user_id', $account->getUserId(), PDO::PARAM_INT);
        $query->bindValue('typeAccount', $account->getTypeAccount(), PDO::PARAM_INT);

        $query->execute();
    }

    public function getAll($id){
        $type_account = []; 
        $accounts = [];
        $arrayAllAccounts = [];
		$query = $this->_db->prepare('SELECT * FROM bank_account LEFT JOIN type_account ON bank_account.typeAccount = type_account.id_type WHERE bank_account.user_id = :user_id');
		$query->execute([
			"user_id" => $id
		]);

		$data = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $result) {
        $accounts[] = new Account($result);
        $type_account[] = new TypeAccount($result);

        }
        $arrayAllAccounts[] = $accounts;
        $arrayAllAccounts[] = $type_account;

		return $arrayAllAccounts;
    }
    
    public function checkIfExists($type_account)
    {
        $query = $this->getDb()->prepare('SELECT * FROM bank_account WHERE typeAccount = :typeAccount AND user_id = :user_id');
        $query->bindValue('typeAccount', $type_account, PDO::PARAM_INT);
        $query->bindValue('user_id', $_SESSION['id'], PDO::PARAM_INT);
        $query->execute();
    
        // if the result is >o this account exists 
        if ($query->rowCount() > 0)
        {
            return true;
        }

        return false;
    }

    /**
     * Delete account from DB
     *
     * @param Account $account
     */
    public function delete(Account $account)
    {
        $query = $this->getDb()->prepare('DELETE FROM bank_account WHERE id = :id AND user_id = :user_id');
        $query->bindValue('id', $account->getId(), PDO::PARAM_INT);
        $query->bindValue('user_id', $account->getUserId(), PDO::PARAM_INT);
        $query->execute();
    }

    /**
     * get one account by ID
     *
     * @param $id_account
     * @return Account
     */
    public function getAccount($id_account)
    {
        $query = $this->getDb()->prepare('SELECT * FROM bank_account WHERE id = :id AND user_id = :user_id');
        $query->bindValue('id', $id_account, PDO::PARAM_INT);
        $query->bindValue('user_id', $_SESSION['id'], PDO::PARAM_INT);
        $query->execute();

        $dataAccount = $query->fetch(PDO::FETCH_ASSOC);

        return new Account($dataAccount);
    }

    /**
     * update account's data
     *
     * @param Account $account
     * @return void
     */
    public function update(Account $account)
    {
        $query = $this->getDb()->prepare('UPDATE bank_account SET balance = :balance WHERE id = :id AND user_id = :user_id');
        $query->bindValue('balance', $account->getBalance(), PDO::PARAM_INT);
        $query->bindValue('id', $account->getId(), PDO::PARAM_INT);
        $query->bindValue('user_id', $account->getUserId(), PDO::PARAM_INT);
        $query->execute();
    }

}

    







