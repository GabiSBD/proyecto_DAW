<?php
include("Class_Connection.php");
Class Picture{
    private $title;
    private $picture;

    private $id_user;

    public function __construct($title, $picture, $id_user){
        $this->title = $title;
        $this->picture = $picture;
        $this->id_user = $id_user;
    }

    // verifica si un texto ya existe en la bbdd  devolviendo un booleano
    private function isExist(){
        $myConnect = new MyConnection();

        $conn = $myConnect->get_connect();

        $resultSet = $conn->prepare("select id from pictures where id_user= :id and title= :title;");
        $resultSet->execute(array(":id"=>$this->id_user, ":title"=>$this->title));

       
        $isExist = $resultSet->rowCount() > 0 ? true : false;

        $resultSet->closeCursor();
        $myConnect->close_connect();

        return $isExist;
    }
    //guarda o modifica un texto persistido en la bbdd
    public function savePicture(){
        try{
            $myConnect = new MyConnection();

            $conn = $myConnect->get_connect();

            $this->isExist() ? $resultSet = $conn->prepare("update pictures set picture= :picture where id_user= :user and title= :title;") :
                                $resultSet = $conn->prepare("insert into pictures (id_user,title,picture) values (:user, :title, :picture);");             
                

            $resultSet->execute(array(":user"=>$this->id_user, ":title"=>$this->title, ":picture"=>$this->picture));               

            if($resultSet) echo "success";
            else echo "fail";

        }catch(PDOException $e){
            echo "fail";

        }

        
        $resultSet->closeCursor();
        $myConnect->close_connect();

    }
    public function deleteText(){
       try{
        $myConnect = new MyConnection();

        $conn = $myConnect->get_connect();

        $resultSet = $conn->prepare("delete from pictures where id_user= :id and title= :title ;");
        $resultSet->execute(array(":id"=>$this->id_user, ":title"=>$this->title));

        if($resultSet) echo "success";
        else echo "fail";
       }catch(PDOException $e){
            echo "fail";
       }

       $resultSet->closeCursor();
       $myConnect->close_connect();
    }
    public function getPictures(){
        try{
            $myConnect = new MyConnection();

            $conn = $myConnect->get_connect();

            $resultSet = $conn->prepare("select picture from pictures where id_user = :id ;");

            $resultSet->execute(array(":id"=>$this->id_user));

            if($resultSet->rowCount()>0){
                while($row = $resultSet->fetch(PDO::FETCH_ASSOC)){
                    //TODO falta implementar esta parte
                }

            }
            else{
                echo "error";
            }
        }catch(PDOException $e){
            echo "error";
            

        }

        
        $resultSet->closeCursor();
        $myConnect->close_connect();
    }
}


?>