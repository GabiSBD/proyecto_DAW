<?php
    include("Class_Connection.php");
    Class Text{
        private $title;
        private $text;

        private $id_user;
        private $myConnect;

        public function __construct($title, $text, $id_user){
            $this->title = $title;
            $this->text = $text;
            $this->id_user = $id_user;
            $this->myConnect = new MyConnection();
        }

        // verifica si un texto ya existe en la bbdd  devolviendo un booleano
        private function isExist(){

            $conn = $this->myConnect->get_connect();

            $resultSet = $conn->prepare("select id from texts where id_user= :id and title= :title;");
            $resultSet->execute(array(":id"=>$this->id_user, ":title"=>$this->title));

           
            $isExist = $resultSet->rowCount() > 0 ? true : false;

            $resultSet->closeCursor();
            

            return $isExist;
        }

        //guarda o modifica un texto persistido en la bbdd
        public function saveText(){
            try{

                $conn = $this->myConnect->get_connect();

                $this->isExist() ? $resultSet = $conn->prepare("update texts set text= AES_ENCRYPT(:text, 'txtKey') where id_user= :user and title= :title;") :
                                    $resultSet = $conn->prepare("insert into texts (id_user,title,text) values (:user, :title, AES_ENCRYPT(:text, 'txtKey'));");             
                    

                $resultSet->execute(array(":user"=>$this->id_user, ":title"=>$this->title, ":text"=>$this->text));               

                if($resultSet) echo "success";
                else echo "fail";

            }catch(PDOException $e){
                echo "fail";
                $this->myConnect->close_connect();
            }

            
            $resultSet->closeCursor();
            $this->myConnect->close_connect();

        }
        /**
         * borra el texto indicado en el cuadro de texto de procesador.php usando e titulo y el id asociado a la sesion de usuario activa
        */
        public function deleteText(){
           try{

            $conn = $this->myConnect->get_connect();

            $resultSet = $conn->prepare("delete from texts where id_user= :id and title= :title ;");
            $resultSet->execute(array(":id"=>$this->id_user, ":title"=>$this->title));

            if($resultSet) echo "success";
            else echo "fail";
           }catch(PDOException $e){
                echo "fail";
           }

           $resultSet->closeCursor();
           $this->myConnect->close_connect();
        }

        //configura el menu desplegable del historial de procesador.php
        public static function getTitles($id){
          try{  
                $myConnect = new MyConnection();

                $conn = $myConnect->get_connect();

                $resultSet = $conn->prepare("select title from texts where id_user = :id ;");
                
                $resultSet->execute(array(":id"=>$id));

                echo "<option value='' selected>History</option>";

                while($row = $resultSet->fetch(PDO::FETCH_ASSOC)){
                    echo "<option value='".$row["title"]."'>".$row["title"]."</option>";
                }

            }catch(PDOException $e){
                echo "notfound";
            }

            
            $resultSet->closeCursor();
            $myConnect->close_connect();

        }
        //obtiene un texto persistido en la bbdd y lo escribe donde es devuelto
        public function getText(){
            try{
                $conn = $this->myConnect->get_connect();

                $resultSet = $conn->prepare("select AES_DECRYPT(text,'txtKey') as text from texts where id_user = :id and title=:title ;");

                $resultSet->execute(array(":id"=>$this->id_user, ":title"=>$this->title));

                if($resultSet->rowCount()>0){
                    $row = $resultSet->fetch(PDO::FETCH_ASSOC);

                    $text =$row["text"];
                    
                    echo $text;

                }
                else{
                    echo "error";
                }
            }catch(PDOException $e){
                echo "error";
                

            }

            
            $resultSet->closeCursor();
            $this->myConnect->close_connect();
        }

        //devuelve el texto persistido en BBDD
        public function getFile(){
            try{

                $conn = $this->myConnect->get_connect();

                $resultSet = $conn->prepare("select AES_DECRYPT(text,'txtKey') as text from texts where id_user = :id and title=:title ;");

                $resultSet->execute(array(":id"=>$this->id_user, ":title"=>$this->title));

                if($resultSet->rowCount()>0){
                    $row = $resultSet->fetch(PDO::FETCH_ASSOC);

                    $text =$row["text"];
                    
                    return $text;

                }
                else{
                    echo "error";
                }
            }catch(PDOException $e){
                echo "error";
                

            }

            
            $resultSet->closeCursor();
            $this->myConnect->close_connect();
        }

    }

?>