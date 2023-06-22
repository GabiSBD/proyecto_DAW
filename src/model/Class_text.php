<?php
    include("Class_Connection.php");
    Class Text{
        private $title;
        private $text;

        private $id_user;

        public function __construct($title, $text, $id_user){
            $this->title = $title;
            $this->text = $text;
            $this->id_user = $id_user;
        }

        public function saveText(){
            $myConnect = new MyConnection();

            $conn = $myConnect->get_connect();

            $resultSet = $conn->prepare("insert into texts (id_user,title,text) values (:user, :title, :text);");

            $resultSet->execute(array(":user"=>$this->id_user, ":title"=>$this->title, ":text"=>$this->text));

            

            if($resultSet) echo "success";
            else echo "fail";

        }
        public static function getTitles($id){
          try{  
                $myConnect = new MyConnection();

                $conn = $myConnect->get_connect();

                $resultSet = $conn->prepare("select title from texts where id_user = :id ;");
                
                $resultSet->execute(array(":id"=>$id));

                while($row = $resultSet->fetch(PDO::FETCH_ASSOC)){
                    echo "<option value='".$row["title"]."'>".$row["title"]."</option>";
                }

            }catch(PDOException $e){
                echo "notfound";
            }


        }
        public function getText(){
            try{
                $myConnect = new MyConnection();

                $conn = $myConnect->get_connect();

                $resultSet = $conn->prepare("select text from texts where id_user = :id and title=:title ;");

                $resultSet->execute(array(":id"=>$this->id_user, ":title"=>$this->title));

                if($resultSet->rowCount()>0){
                    $row = $resultSet->fetch(PDO::FETCH_ASSOC);

                    session_start();

                    $text =$row["text"];
                    
                    echo $text;

                }
                else{
                    echo "error";
                }
            }catch(PDOException $e){
                echo "error";
                

            }
        }

    }

?>