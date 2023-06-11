<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pruebas</title>
    <?php
        session_start();
    ?>

</head>
<body>
    <div>
        <form action="controller.php" method="post">
            <input type="text" name="name" id="name" placeholder="user">
            <input type="text" name="passwrd" id="passwrd" placeholder="passwrd">
            <input type="submit" value="send"><input type="reset" value="reset">
        </form>
    </div>
    <?php
        
        if(isset($_SESSION["usuario"])){
            echo "usuario: ".$_SESSION["usuario"]["name"]."  id: ".$_SESSION["usuario"]["id"]."  isAdmin: ".$_SESSION["usuario"]["isAdmin"];
        }else{echo "session usuario es null";}
        
    ?>
</body>
</html>