$(function(){

    window.addEventListener("load",getPictures,false);

    $("body").on("mouseover",function(){
        document.getElementById("formImage").addEventListener("submit",uploadAjax,false);
        document.getElementById("logo").addEventListener("click",toIndex,false);
        document.getElementById("upload").addEventListener("mouseover",iconSpin,false);
        document.getElementById("upload").addEventListener("mouseout",iconStop,false);
    });
        
    
});
function toIndex(){ window.location = "index.php"; }
function iconSpin(){ $("#iconSave").addClass("fa-bounce"); }
function iconStop(){ $("#iconSave").removeClass("fa-bounce"); }





//-----------------------------Funciones AJAX----------------------------------------------------
function getPictures(){
    $.post("../controller/paintGalery.php",responsePaintGalery);
}


function uploadAjax(e){
    e.preventDefault();
     let dato_archivo = $('#picture').prop("files")[0];

     let datosForm = new FormData();
     datosForm.append("picture", dato_archivo);
    
    $.ajax({
        //La url que se encargara de procesar la subida del archivo
        url: '../controller/uploadPic_controller.php',
        //El tipo de respuesta que me devolverá la página en mi caso será un texto indicando el estado de la subida
        dataType: 'text',
        processData: false,
        contentType: false,
        //El dato pasado a la solicitud
        data: datosForm,
        //El tipo que será la solicitud
        type: 'post',
        method: 'POST',
        //Si la operación tiene éxito...
        success: uploadResponse
    });

    return false;
}

//-------------------------------Respuestas AJAX------------------------------------------------
function responsePaintGalery(data){
    $("#album").html(data);
}
function uploadResponse(data){
    data == "success" ? $("#ajaxMsg").attr("class","text-success").html("saved successfully") : $("#ajaxMsg").attr("class","text-danger").html("failed to save");
    getPictures();
}
   