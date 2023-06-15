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

            

            if($resultSet) echo "sucess";
            else echo "fail";

        }

    }

?>