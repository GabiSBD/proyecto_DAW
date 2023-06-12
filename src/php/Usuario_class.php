<?php
    include("Conexion_class.php");
    class User{
        private $name;
        private $passwrd;

        

        public function __construct($name,$passwrd){
            $this->name = $name;
            $this->passwrd = $passwrd;
        }

        public function isUser(){
             $myConnection = new MyConnection();

             $resultSet = $myConnection->get_connect()->prepare("select name from users where name = :name and passwrd=AES_ENCRYPT(:pass,'key');");

             $resultSet->execute(array(":name"=>$this->name,":pass"=>$this->passwrd));
            
             $isUser = $resultSet->rowCount()>0;

             $resultSet->closeCursor();

             $myConnection->close_connect();

             return $isUser;
        }
        public function getUser(){

            if($this->isUser()){
                $myConnection = new MyConnection();
                $conn = $myConnection->get_connect();
                $resultSet = $conn->prepare("select id, name, isAdmin from users where name = :name and passwrd=AES_ENCRYPT(:pass,'key');");
                $resultSet->execute(array(":name"=>$this->name,":pass"=>$this->passwrd));

                while($row = $resultSet->fetch(PDO::FETCH_ASSOC)){
                    session_start();
                   $_SESSION["usuario"]= array("id"=>$row["id"],
                                                "name"=>$row["name"],
                                                "isAdmin"=>$row["isAdmin"]);
                }
                $resultSet->closeCursor();

                $myConnection->close_connect();

                header("location:../index.php");

            }else{
                //aqui añadir cookie para volver a index y añadir texto de usu no encontrado debajo del form de login
                echo "no encontrado";
                
            }
        }
        
        public function setUser(){
            if(!$this->isUser()){
                $myConnection = new MyConnection();
                $conn = $myConnection->get_connect();
                // persistimos el usuario nuevo
                $resultSet = $conn->prepare("insert into users (name,passwrd) values (:name, AES_ENCRYPT(:pass,'key'));");
                $resultSet -> execute(array(":name"=>$this->name , ":pass"=>$this->passwrd));

                //Comprobamos que se haya persistido y en caso afirmativo iniciamos session con el usuario
                $isOK = $conn->prepare("select name, passwrd from users where name = :name and passwrd=AES_ENCRYPT(:pass,'key');");
                $isOK -> execute(array(":name"=>$this->name , ":pass"=>$this->passwrd));
                if($isOK->rowCount()>0){
                    $this->getUser();
                }else{
                    echo "error al insertar registro";
                }

            }else{
                echo "ya existe ";
            }
        }


    }

?>