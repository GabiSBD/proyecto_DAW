<?php
    include("Class_Connection.php");
    class User{
        private $name;
        private $passwrd;
        private $myConnect;

        

        public function __construct($name,$passwrd){
            $this->name = $name;
            $this->passwrd = $passwrd;
            $this->myConnect = new MyConnection();
        }

        //comprueba la existencia de un usuario con los datos dados en el constructor
        public function isUser(){
            //comprueba si existe un usuario en la bbdd

            
            $conn = $this->myConnect->get_connect();
            
            $resultSet = $conn->prepare("select name from users where name = :name;");

            $resultSet->execute(array(":name"=>$this->name));
        
            $isUser = $resultSet->rowCount()>0;

            $resultSet->closeCursor();

            //$this->myConnect->close_connect();

            return $isUser;
        }

        //recupera un usuario de la BBDD para poder iniciar una sesion en la app
        public function getUser(){

            if($this->isUser()){
               // $Conection = new MyConnection();
                $conn = $this->myConnect->get_connect();
                $resultSet = $conn->prepare("select id, name, isAdmin from users where name = :name and passwrd=AES_ENCRYPT(:pass,'key');");
                $resultSet->execute(array(":name"=>$this->name,":pass"=>$this->passwrd));

                while($row = $resultSet->fetch(PDO::FETCH_ASSOC)){
                    session_start();
                   $_SESSION["usuario"]= array("id"=>$row["id"],
                                                "name"=>$row["name"],
                                                "isAdmin"=>$row["isAdmin"]);
                }
                $resultSet->closeCursor();

                //$Conection->close_connect();
                $this->myConnect->close_connect();
                header("location:../view/index.php");

            }else{
               //devolvemos por url un mensaje de error que servira para mostrar un mensaje en el form de index.php
                
               header("location:../view/index.php?error=sorry,+username+or+password+not+correspond+to+any+user.");
               $this->myConnect->close_connect(); 
            }
        }
        
        //ñade un usuario a la BBDD
        public function setUser(){
            if(!$this->isUser()){
                
                $conn = $this->myConnect->get_connect();

                // persistimos el usuario nuevo
                $resultSet = $conn->prepare("insert into users (name,passwrd) values (:name, AES_ENCRYPT(:pass,'key'));");
                $resultSet -> execute(array(":name"=>$this->name , ":pass"=>$this->passwrd));

                //Comprobamos que se haya persistido y en caso afirmativo iniciamos session con el usuario
                $isOK = $conn->prepare("select name, passwrd from users where name = :name and passwrd=AES_ENCRYPT(:pass,'key');");
                $isOK -> execute(array(":name"=>$this->name , ":pass"=>$this->passwrd));
                if($isOK->rowCount()>0){
                    $this->getUser();
                }else{
                    header( "location: ../view/index.php?error=error+al+insertar+registro");
                }

                $resultSet->closeCursor();
                $this->myConnect->close_connect();

            }else{
                header("location:../view/index.php?error=el+usuario+ya+existe");
            }
        }

        public static function setIsAdmin($id){
           try{
                $myConnection = new MyConnection();
                $conn = $myConnection->get_connect();

                $isAdminSet =$conn->prepare("select isAdmin from users where id= :id ;");
                $isAdminSet->execute(array(":id"=>$id));

                $isAdmin = $isAdminSet->fetch(PDO::FETCH_ASSOC);

                if($isAdmin["isAdmin"] == 1){
                    $setAdmin = $conn->prepare("update users set isAdmin= 0 where id= :id ;");
                    $setAdmin->execute(array(":id"=>$id));
                }else{
                    $setAdmin = $conn->prepare("update users set isAdmin= 1 where id= :id ;");
                    $setAdmin->execute(array(":id"=>$id));
                }
                

            }catch(PDOException $e){
                return false;
            }

            $setAdmin->closeCursor();
            $isAdminSet->closeCursor();
            $myConnection->close_connect();

            return true;
        }

        public function deleteUser(){
            //borrara un usuario pero primero borrar los textos e imagenes  asociados a su id
            try{
            
                $conn = $this->myConnect->get_connect();

           

                //selecionamos el id del usuario en sesion
                
                $id_user = $_SESSION["usuario"]["id"];
                
                // iniciamos una transaccion y quitamos el seguro de actualizaciones de la bbdd temporalmente
                $conn->exec("SET SQL_SAFE_UPDATES = 0;");

           
                //borramos los textos asociados al id del usuario
                $deleteTexts = $conn->prepare("delete from texts where id_user= :id_user;");
                $deleteTexts->execute(array(":id_user"=>$id_user));

                //borramos las imaganes asociadas al is del usuario
                $deletePics = $conn->prepare("delete from pictures where id_user= :id_user;");
                $deletePics->execute(array(":id_user"=>$id_user));

                //establecemos el borrado seguro de nuevo
                $conn->exec("SET SQL_SAFE_UPDATES = 1;");

                //borramos el usuario
                $deleteUser = $conn->prepare("delete from users where id=:id;");
                $deleteUser->execute(array(":id"=>$id_user));

                //reiniciamos y configuramos de nuevo los indices de auto increment de ambas tablas
                //$this->setAutoIncrement();

                $_SESSION["usuario"]=null;
                session_destroy();

                // cerramos transacion o la deshacemos, ademas liberamos memoria
               
                $deleteTexts->closeCursor();
                $deletePics->closeCursor();
                $deleteUser->closeCursor();
                $this->myConnect->close_connect();
                header("location:../view/index.php");
            }catch(PDOException $e){
                
                $deleteTexts->closeCursor();
                $deleteUser->closeCursor();
                $this->myConnect->close_connect();
                header("location:../view/index.php?error=Error,+contacte+con+servicio+tecnico");
            
            }
        }
        //borra un usuario desde el panel de control del admin
        public  static function dropUser($id){
            try{
                $MyConnection = new MyConnection();
                $conn = $MyConnection->get_connect();

                $id_user = $id;
                
                //borramos los textos asociados al id del usuario
                $deleteTexts = $conn->prepare("delete from texts where id_user= :id_user;");
                $deleteTexts->execute(array(":id_user"=>$id));

                //borramos las imaganes asociadas al is del usuario
                $deletePics = $conn->prepare("delete from pictures where id_user= :id_user;");
                $deletePics->execute(array(":id_user"=>$id));

                //borramos el usuario
                $deleteUser = $conn->prepare("delete from users where id=:id;");
                $deleteUser->execute(array(":id"=>$id_user));

                
                
            }catch(PDOException $e){
                return false;
            }
            
            $deleteTexts->closeCursor();
            $deletePics->closeCursor();
            $deleteUser->closeCursor();
            $MyConnection->close_connect();

            return true;


        }

        //dibuja la tabla de control del area de administrador
        public static function adminTable(){
            try{
                $Connection = new MyConnection();
                $conn = $Connection->get_connect();

                $resultSet = $conn->query("select id, name,isAdmin from users");

                echo "<table>
                        <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Admin</th>
                        <th>Options</th>
                        
                    </tr>";
                // usaremos esta informacion para deshabilitar las acciones sobre el usuario que ingresa en el area de admin
                $id_usuarioActual = $_SESSION["usuario"]["id"];

                while($row = $resultSet->fetch(PDO::FETCH_ASSOC)){
                    echo " <tr>
                            <td>".$row["id"]."</td>
                            <td>".$row["name"]."</td>
                            <td>".($row["isAdmin"]==1?"<i class='fa-solid fa-check'></i>":"<i class='fa-solid fa-x'></i>")."</td>
                            <td>
                                <button class='btn btn-danger rounded-pill shadow delete-btn' id='".$row["id"]."' ".($id_usuarioActual==$row["id"] ? "disabled":"").">
                                    <i class='fa-solid fa-user-slash'></i>
                                </button>
                                <button class='btn btn-info rounded-pill shadow isAdmin-btn' id='admin-".$row["id"]."' ". ($id_usuarioActual==$row["id"] ? "disabled":"").">
                                    <i class='fa-solid fa-check'></i>/<i class='fa-thin fa-x'></i>
                                </button>
                            </td>
                            </tr>";
                    
                }
                echo "</table>";
            }catch(PDOException $e){
                echo $e->getMessage().$e->getCode();
            }

                $resultSet->closeCursor();
                $Connection->close_connect();


        }


    }

?>