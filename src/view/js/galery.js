$(function(){
    
        //$("#formImage").submit(uploadAjax);
        $("#logo").click(toIndex);
        //$(".delete-btn").click(ajaxDelete);
    
});
function toIndex(){
    window.location = "index.php";
}
//-----------------------------Funciones AJAX----------------------------------------------------
//no funcionan queda pendienteimplementacion correcta de momento se hara de manera sincrona
function uploadAjax(){
    
    // let dato_archivo = $('#picture').prop("files")[0];

    //  let datosForm = new FormData();
    //  datosForm.append("picture",new Blob([JSON.stringify(dato_archivo)],{type: 'application/json'}));

    let datosForm =$(this).serialize();

   // $.post("../controller/upload_controller.php", datosForm, uploadResponse);
    $.ajax({
        //La url que se encargara de procesar la subida del archivo
        url: '../controller/upload_controller.php',
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

function uploadResponse(data){
    //respuesta temporal falta desarrollar
    data == "success" ? $("#ajaxMsg").attr("class","text-success").html("saved successfully") : $("#ajaxMsg").attr("class","text-danger").html("failed to save");
}
