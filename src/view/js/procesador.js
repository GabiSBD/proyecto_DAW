$(function(){

    window.addEventListener("load",getHistory,false);
    

     //coloca el editor de texto
    let editor = $("#userText").Editor();

    $("body").on("mouseover",function(){

        document.getElementById("save").addEventListener("mouseup",getHistory,false);
        document.getElementById("delete").addEventListener("mouseup",getHistory,false);

        //devuelve a la pagina pricipal al pulsar en el logo
        document.getElementById("logo").addEventListener("click",function(){
            window.location = "index.php";
        },false);

        //cuando el raton se pose sobre el boton delete hara una animacion y dejara de hacerla al salir el focus del ratón
        document.getElementById("delete").addEventListener("mouseover", function(){
          $("#delete").addClass("fa-bounce");
        }, false);
        document.getElementById("delete").addEventListener("mouseout", function(){
          $("#delete").removeClass("fa-bounce");
        }, false);
  //--------------------------------------------------------------------------------------------------------------------------
         //cuando el raton se pose sobre el boton save hara una animacion y dejara de hacerla al salir el focus del raton
         document.getElementById("save").addEventListener("mouseover", function(){
          $("#save").addClass("fa-bounce");
        }, false);

        document.getElementById("save").addEventListener("mouseout", function(){
          $("#save").removeClass("fa-bounce");
        }, false);
  //--------------------------------------------------------------------------------------------------------
        //funcion para conexion ajax al guardar texto
        document.getElementById("save").addEventListener("mousedown",saveAjax,false);

        //funcion ajax para traer texto de vuelta al editor
        document.getElementById("textList").addEventListener("change",historyAjax,false);
  
        // funcion ajax para borrar un texto del la bbdd
        document.getElementById("delete").addEventListener("mousedown",deleteAjax , false);
  //------------------------------------------------------------------------------------------------------------
        //funcion para colocar un link a downloadPage.php
        document.getElementById("textList").addEventListener("change",setLink, false);

        if($("#isSetSession").val()=="false"){
          $("#editor").on("keydown", setGuestLink);
          
        }
        //animacion en link a downloadPage
        document.getElementById("iconDload").addEventListener("mouseover",function(){
          $("#downloadButton").addClass("fa-bounce");
        },false);
        document.getElementById("iconDload").addEventListener("mouseout",function(){
          $("#downloadButton").removeClass("fa-bounce");
        },false);

  
    });
    
    function setLink(){

        $("#downloadLink").html(
          "<a href='downloadPage.php?txtTitle="+$("#textList").val()+"' target='_blank'>"+
            "<button class='btn btn-primary rounded-pill shadow' id='downloadButton'><i id='iconDload' class='fa-solid fa-download fa-lg'></i></button>"+
          "</a>"
        );
     
      }
    function setGuestLink(){
      $("#downloadLink").html(
        "<a href='downloadPage.php?txtTitle=GuestDoc"+"&text="+$("#userText").Editor("getText")+"' target='_blank'>"+
          "<button class='btn btn-primary rounded-pill shadow' id='downloadButton'><i id='iconDload' class='fa-solid fa-download fa-lg'></i></button>"+
        "</a>");
    }

});
   
    //--------------------------------------------------------------funciones AJAX------------------------------------------------------------

  
    function saveAjax(){
        let title =$("#title").val();

        if(title==null ||title==""||title==" "){
          $("#ajaxMsg").attr("class","alert alert-danger").html("The file title cannot be blank.");
          return false;
        }

        let formData = {
            title:$("#title").val(),
            text:$("#userText").Editor("getText")
        };

        $.post("../controller/saveText_controller.php", formData, responseSaveText);

    }
    function getHistory(){
      $.post("../controller/history.php",responseGethistory);
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
        let title =$("#title").val();

        if(title==null ||title==""||title==" "){
          $("#ajaxMsg").attr("class","alert alert-danger").html("The file title cannot be blank.");
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
    data=="success"? $("#ajaxMsg").attr("class","alert alert-success").html("saved successfully") : $("#ajaxMsg").attr("class","alert alert-danger").html("failed to save");
  }
  //escribe el texto recuperado del la bbdd en el editor
  function write(data){
    data=="error" ? $("#userText").Editor("setText","") : $("#userText").Editor("setText",data);
  }
  //coloca un mensaje de respuesta del servidor al borrar un texto
  function responseDeleteText(data){
    data == "success" ? $("#ajaxMsg").attr("class","alert alert-success").html("delete successfully") : $("#ajaxMsg").attr("class","alert alert-danger").html("failed to delete");
  }
  function responseGethistory(data){
    $("#textList").html(data);
  }
  //---------------------------------------------------------------------------------------------------------------------------------------------------------