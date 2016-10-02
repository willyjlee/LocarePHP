<?php
 
/**
 * A class file to connect to database
 */
class DB_CONNECT {
 
    // constructor
    function __construct() {
        // connecting to database
        $this->connect();
    }
 
    // destructor
    function __destruct() {
        // closing db connection
        $this->close();
    }
 
    /**
     * Function to connect with database
     */
    function connect() {
        // import database connection variables
        require_once __DIR__ . '/db_config.php';
 
        // Connecting to mysql database
        //$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);

        // Selecing database
        //$db = mysql_select_db(DB_DATABASE) or die(mysql_error()) or die(mysql_error());
 
        // returing connection cursor
        return $con;
    }

    function selectDB(){
        require_once __DIR__ . '/db_config.php';
        $db = mysqli_select_db(DB_DATABASE);
        return $db;
    }
 
    /**
     * Function to close db connection
     */
    function close() {
        // closing db connection
        mysqli_close();
    }
 
}
 
?>
