<?php
class Database
{

    private $host;
    private $user;
    private $password;
    private $db;
    public $mysqli;
    


    /**
    * This function is for database configuration
    *
    * @param 
    * @return If Success then return database connect, else return Error
    * @author Tonmoy Deb
    * @version 2018-03-28
    */
    function __construct() {
        $ini_array = parse_ini_file("db.ini");

        $this->host     = $ini_array['host_name'];
        $this->user     = $ini_array['db_username'];
        $this->pass     = $ini_array['db_password'];
        $this->data     = $ini_array['db_name'];
        $this->mysqli   = new mysqli($this->host, $this->user, $this->pass, $this->data);

        if ($this->mysqli->connect_error)
        {
            echo "Error In Connection";
            exit();
        }
    }



    /**
    * This function is for sql run query
    *
    * @param sql query
    * @return If Success then return query
    * @author Tonmoy Deb
    * @version 2018-03-28
    */
    public function query($query)
    {
        return $this->mysqli->query($query);
    }


    /**
    * This function is get last insert id
    *
    * @param
    * @return If Success then return id
    * @author Tonmoy Deb
    * @version 2018-03-28
    */
    public function insert_id(){
        return $this->mysqli->insert_id;
    }

    /**
    * This function is for prepare query
    *
    * @param
    * @return If Success then return true
    * @author Tonmoy Deb
    * @version 2018-03-28
    */
    public function prepare($query){
        return $this->mysqli->prepare($query);
    }

    /**
    * This function is for beginTransaction
    *
    * @param  
    * @return If Success then return 
    * @author Tonmoy Deb
    * @version 2020-04-26
    */
    function trans_begin()
    {
        $this->mysqli->autocommit(FALSE);
        return $this->mysqli->begin_transaction();
    }

    /**
    * This function is for Transaction Commit
    *
    * @param  
    * @return If Success then return 
    * @author Tonmoy Deb
    * @version 2020-04-26
    */
    function trans_commit()
    {
        return $this->mysqli->commit();
    }

    /**
    * This function is for Transaction Rollback
    *
    * @param  
    * @return If Success then return 
    * @author Tonmoy Deb
    * @version 2020-04-26
    */
    function trans_rollback()
    {
        echo "rollback";
        return $this->mysqli->rollback();
    }
    


}


?>