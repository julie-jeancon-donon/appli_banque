<?php


declare(strict_types = 1);

// create model class 
class TypeAccountManager
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
     * @return TypeAccount
     */
    public function getArrayAccounts()
    {
        $arrayOfAccounts = [];
    
        $query = $this->getDb()->prepare('SELECT * FROM type_account');
        $query->execute();
        $dataAccounts = $query->fetchAll(PDO::FETCH_ASSOC);
        
    
        foreach ($dataAccounts as $dataAccount) {
            $arrayOfAccounts[] = new TypeAccount($dataAccount);
        }
        
        return $arrayOfAccounts;
    }

        public function checkIfExists($type_account)
    {
        $query = $this->getDb()->prepare('SELECT * FROM type_account WHERE id_type = :id_type AND user_id = :user_id');
        $query->bindValue('id_type', $type_account, PDO::PARAM_INT);
        $query->bindValue('user_id', $_SESSION['id'], PDO::PARAM_INT);
        $query->execute();
        echo $type_account;
        // Si il y a une entrée avec ce nom, c'est qu'il existe
        if ($query->rowCount() > 0)
        {
            echo 'blop';
            return true;
        }
        // Sinon c'est qu'il n'existe pas
        return false;
    }

}

    







