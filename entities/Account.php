<?php

declare(strict_types = 1);

class Account
{
    protected   $id,
                $balance,
                $user_id,
                $typeAccount;


/**
     * constructor
     *
     * @param array $array
     */
    public function __construct(array $array)
    {
        $this->hydrate($array);
    }

    /**
     * Hydratation
     *
     * @param array $donnees
     */
        public function hydrate(array $donnees)
        {
            foreach ($donnees as $key => $value)
            {
                
                $method = 'set'.ucfirst($key);
                    
                // if setter exists.
                if (method_exists($this, $method))
                {
                    
                    $this->$method($value);
                }
            }
        }


    /**
     * Set the value of id
     * @param int $id
     * @return  self
     */ 
    public function setId($id)
    {
        $id = (int) $id;
        $this->id = $id;

        return $this;
    }

    /**
     * set the value of user id
     * @param int $user_id
     * @return self
     */
    public function setUser_id($user_id){
		$user_id = (int) $user_id;
        
        if($user_id > 0){
		    $this->user_id = $user_id;
		}
    }
    
    /**
     * set type of account
     * @param string $type_account
     * @return self
     */
    public function setTypeAccount(string $typeAccount){
        $this->typeAccount = $typeAccount; 
    }

    /**
     * Set the value of balance
     * @param int $balance
     * @return  self
     */ 
    public function setBalance($balance)
    {
        $balance = (int) $balance;
        $this->balance = $balance;
    
        return $this;
    }

    /**
     * get user id
     * @param int
     * 
     */
    public function getUserId(){
    return $this->user_id;
    }

    /**
     * get the name of the account
     *
     * @return string
     */
    public function getTypeAccount()
    {
        return $this->typeAccount;
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * get the value of the balance
     *
     * @return int
     */
    public function getBalance()
    {
        return $this->balance;
    }
        
        
    /**
     * get balance when its debited
     *
     * @param int $debit
     * @return int
     */
    public function calculDebit($debit)
    {
        $newBalance = $this->getBalance() - $debit;
        $this->setBalance($newBalance);

    }

    /**
     * get balance when its credited
     *
     * @param int $credit
     * @return int
     */
    public function calculCredit($credit)
    {
        $newBalance = $this->getBalance() + $credit;
        $this->setBalance($newBalance);
    }

}
