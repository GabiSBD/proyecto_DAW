$(function(){

    window.addEventListener("load",getPictures,false);

    $("body").on("mouseover",function(){
        let deleteBtns = document.querySelectorAll(".delete-btn");
        for(let i=0; i<deleteBtns.length; i++) deleteBtns[i].addEventListener("click",deletePic,false);

        document.getElementById("upload").addEventListener("click",uploadAjax,false);
       
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
function deletePic(){
    let formdata = {title: $(this).attr("id")};
    $.post("../controller/deletePic_controller.php",formdata,deleteResponse);
}

function uploadAjax(){
    
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

   
}

//-------------------------------Respuestas AJAX------------------------------------------------
function responsePaintGalery(data){
    $("#album").html(data);
}
function uploadResponse(data){
    if(data=="success") $("#ajaxMsg").attr("class","alert alert-success").html("saved successfully");
    else if(data == "notValid") $("#ajaxMsg").attr("class","alert alert-danger").html("failed to save, invalid file format");
    else $("#ajaxMsg").attr("class","alert alert-danger").html("failed to save");
    getPictures();
}
function deleteResponse(data){
    data == "success" ? $("#ajaxMsg").attr("class","alert alert-success").html("delete successfully") : $("#ajaxMsg").attr("class","alert alert-danger").html("failed to delete");
    getPictures();
}
