<?php

declare(strict_types = 1);

class TypeAccount
{
    protected   $id_type,
                $name;


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
    public function setId_type($id_type)
    {
        $id_type = (int) $id_type;
        $this->id_type = $id_type;

        return $this;
    }


    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId_type()
    {
        return $this->id_type;
    }

        /**
         * Set the value of name
         * @param string $name
         * @return  self
         */ 
        public function setName(string $name)
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of name
         * @return string
         */ 
        public function getName()
        {
                return $this->name;
        }


}
