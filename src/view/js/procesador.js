$(function(){
     //coloca el editor de texto
     $("#userText").Editor();

     /* 
     arreglo necesario para que el DOM se cargara corectamente usando ajax con jquery ya que no cargaba bien los eventos despues de usar una funcion ajax
     la solucion hace que se recarguen todos los eventos de la pagina cada vez que hacemos click en alguno de los elemententos del body con la class clickElement.
     fuente: https://stackoverflow.com/questions/13767919/jquery-event-wont-fire-after-ajax-call?rq=3
     autor:Jason Fingar
     */
    $("body").on("mouseover",function(){
        //devuelve a la pagina pricipal al pulsar en el logo
        document.getElementById("logo").addEventListener("click",function(){
            window.location = "index.php";
        },false);
  
        //cuando el raton se pose sobre el boton delete hara una animacion y dejara de hacerla al salir el focus del ratón
        document.getElementById("delete").addEventListener("mouseover", function(){
          $("#delete").addClass("fa-flip");
        }, false);
        document.getElementById("delete").addEventListener("mouseout", function(){
          $("#delete").removeClass("fa-flip");
        }, false);
  //--------------------------------------------------------------------------------------------------------------------------
         //cuando el raton se pose sobre el boton save hara una animacion y dejara de hacerla al salir el focus del raton
         document.getElementById("save").addEventListener("mouseover", function(){
          $("#save").addClass("fa-flip");
        }, false);

        document.getElementById("save").addEventListener("mouseout", function(){
          $("#save").removeClass("fa-flip");
        }, false);
  //--------------------------------------------------------------------------------------------------------
        //funcion para conexion ajax al guardar texto
        document.getElementById("save").addEventListener("click",saveAjax,false);

        //funcion ajax para traer texto de vuelta al editor
        document.getElementById("textList").addEventListener("change",historyAjax,false);
  
        // funcion ajax para borrar un texto del la bbdd
        document.getElementById("delete").addEventListener("click",deleteAjax , false);
  
    });
   
    //--------------------------------------------------------------funciones AJAX------------------------------------------------------------

  });
    function saveAjax(){
        let title =$("#title").val();

        if(title==null ||title==""||title==" "){
          $("#ajaxMsg").attr("class","text-danger").html("The file title cannot be blank.");
          return false;
        }

        let formData = {
            title:$("#title").val(),
            text:$("#userText").Editor("getText")
        };

        $.post("../controller/saveText_controller.php", formData, responseSaveText);

    }
    function historyAjax(){
  
        let txtTitle = $("#textList").val();
        //colocamos el titulo del texto recuperado en el input de guardar para facilitar su post actualizacion
        $("#title").val(txtTitle);

        let formData = {
          title:txtTitle
        };

        $.post("../controller/getText.php", formData, write);
        
      }
    function deleteAjax(){
  
        if(title==null ||title==""||title==" "){
            $("#ajaxMsg").attr("class","text-danger").html("The file title cannot be blank.");
            return false;
         }

         let formData = {
            title:$("#title").val()
         }

         $.post("../controller/deleteText.php", formData, responseDeleteText);
        
        
      }
      //------------------------------------------------------------------------------------------------------------------------------------

    //-----------------------------------------------------------------Respuestas AJAX---------------------------------------------------------------

    //coloca un mensaje de respuesta del servidor al guardar texto
  function responseSaveText(data){
      data=="success"? $("#ajaxMsg").attr("class","text-success").html("saved successfully") : $("#ajaxMsg").attr("class","text-danger").html("failed to save");
  }
  //escribe el texto recuperado del la bbdd en el editor
  function write(data){
    data=="error" ? $("#userText").Editor("setText","") : $("#userText").Editor("setText",data);
  }
  //coloca un mensaje de respuesta del servidor al borrar un texto
  function responseDeleteText(data){
    data == "success" ? $("#ajaxMsg").attr("class","text-success").html("delete successfully") : $("#ajaxMsg").attr("class","text-danger").html("failed to delete");
  }
  //---------------------------------------------------------------------------------------------------------------------------------------------------------