<?php  
require("Connection_Const.php");

class MyConnection{
    protected $db_connection;

    public function __construct(){
        try{
            $this->db_connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWRD);

            $this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //SI HAY ERROR AL GUARDAR BLOBS probar a cambiar por SET CHARACTER SET utf8 pero deberia ser mejor asi
            $this->db_connection->exec("SET NAMES utf8");
        }catch(PDOException $e){
            die("Error: " . $e->getMessage() ." Codigo PDOException: " . $e->getCode() ." En la linea " . $e->getLine());
        }
    }
    public function get_connect(){
       
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