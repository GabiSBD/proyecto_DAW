<?php
include("Class_Connection.php");
Class Picture{
    private $title;
    private $type;
    private $picture;

    private $id_user;

    public function __construct($title,$type, $picture, $id_user){
        $this->title = $title;
        $this->type = $type;
        $this->picture = $picture;
        $this->id_user = $id_user;
    }

    // verifica si una imagen ya existe en la bbdd  devolviendo un booleano
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

            $this->isExist() ? $resultSet = $conn->prepare("update pictures set picture= :picture and type= :type where id_user= :user and title= :title;") :
                                $resultSet = $conn->prepare("insert into pictures (id_user,title,picture,type) values (:user, :title, :picture, :type);");             
                

            $resultSet->execute(array(":user"=>$this->id_user, ":title"=>$this->title, ":picture"=>$this->picture, ":type"=>$this->type));               

            
            if($resultSet) echo "success";
             else echo "fail";

        }catch(PDOException $e){
            echo "fail";

        }


        
        $resultSet->closeCursor();
        $myConnect->close_connect();

    }
    public function deletePicture(){
       try{
        $myConnect = new MyConnection();

        $conn = $myConnect->get_connect();

        $resultSet = $conn->prepare("delete from pictures where id_user= :id and title= :title ;");
        $resultSet->execute(array(":id"=>$this->id_user, ":title"=>$this->title));

        if($resultSet) header("location:../view/galery.php?response=deleted+successfully+");
        else header("location:../view/galery.php?badResponse=failed+to+delete");
       }catch(PDOException $e){
            header("location:../view/galery.php?badResponse=failed+to+save");
       }

       $resultSet->closeCursor();
       $myConnect->close_connect();
    }

    public static function getPictures($id_user){
        try{
            $myConnect = new MyConnection();

            $conn = $myConnect->get_connect();

            $resultSet = $conn->prepare("select title, picture from pictures where id_user = :id ;");

            $resultSet->execute(array(":id"=>$id_user));

            if($resultSet->rowCount()>0){
                $cont=0;
                echo "<table><tr>";
                
                 while($row = $resultSet->fetch(PDO::FETCH_ASSOC)){
                   
                    echo "<td>
                            <a href='downloadPage.php?title=".$row["title"]."'  target='_blank'>
                                <img width='210' height:'210' title='click me to dowload :)' src='data:application/octet-stream;base64,".base64_encode($row["picture"]) ." '>
                            </a>
                            <br>
                            <div class='dropdown'>
                                <button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
                                    <span>".$row["title"]."</span>
                                    <span class='caret'></span>
                                </button>
                                <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                    <li class='picFooter'>
                                        <form action='../controller/deletePic_controller.php' method='get'>
                                            <div class='input-group'>
                                                <span class='input-group-addon' id='basic-addon1'><i class='fa-solid fa-trash' style='color: #ff0000;'></i></span>
                                                <input type='text' class='notVisible' value='".$row["title"]."' name='title'>
                                                <input type='submit' value='delete' class=' form-control btn btn-default rounded-pill shadow'>
                                            </div>
                                        </form>   
                                        
                                    </li>
                                </ul>
                            </div>
                        </td>";
      
                    $cont++;
                    if($cont==3){
                        $cont=0;
                        echo "</tr><tr>";
                    }

                 }
                 echo "</tr></table>";
            }
            else{
                echo "empty";
            }
        }catch(PDOException $e){
            echo "Upps, something is wrong with server, try later";
            

        }

        $resultSet->closeCursor();
        $myConnect->close_connect();
    }
    public  function getPicture(){

       try{
        $myConnect = new MyConnection();

        $conn = $myConnect->get_connect();

        if($this->isExist()){
            $resultSet = $conn->prepare("select picture from pictures where id_user = :id and title= :title ;");

            $resultSet->execute(array(":id"=>$this->id_user, ":title"=>$this->title));

            while($row = $resultSet->fetch(PDO::FETCH_ASSOC)){
                //echo "<img src='data:application/octet-stream;base64,".base64_encode($row["picture"]) ." '>";
              return $row["picture"];
               
            }
        
        }else{
            echo "<h1>picture not found in database</h1>";
        }

       }catch(PDOException $e){
        echo "<h1>Upps, something is wrong with server, try later</h1>";
       }
       $resultSet->closeCursor();
       $myConnect->close_connect();

    }
    
}



?>