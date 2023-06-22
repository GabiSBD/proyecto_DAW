<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!--Bootstrap JS-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!--Editor JS-->
    <script src="../view/js/editor.js"></script>
     
    <!--estilos CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="../view/css/editor.css">
    <!--JS-->
    <script>
        /*
        usamos este ejemplo para porner un texto en el editor y recuperarlo en el div contiguo mediante este 
        ejemplo podre implementarlo con bbdd para la funcionabilidad del proyecto.
        
        */
    $(function(){
        $("#editor").Editor();
       
       

        $("#boton").click(function(){
            

            $.post("getText.php",respuesta);

        

        });
        function respuesta(data){
            
                
               $("#editor").Editor("setText",data);
            
        }
    
    });
 
    </script>

    <title>prueba editor</title>
</head>
<body>
    <div id="editor">

    </div>
    <div id="copy">
        
    </div>
    <div><button id="boton">pulsa</button></div>
</body>
</html>