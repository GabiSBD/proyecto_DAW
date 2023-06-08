<?php  
require("datos_conexion.php");

class MyConnection{
    protected $db_connection;

    public function get_connect(){
        try{
            $this->db_connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWRD);

            $this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db_connection->exec("SET CHARACTER SET utf8");
        }catch(PDOException $e){
            die("Error: " . $e->getMessage() ." Codigo PDOException: " . $e->getCode() ." En la linea " . $e->getLine());
        }
        return $this->db_connection;
    }


    public function get_dbConnection(){
        return $this->db_connection;
    }
    public function close_connect(){
        $this->db_connection=null;
    }
}

?>