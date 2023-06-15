$(function(){
    $("#userText").Editor();

    document.getElementById("logo").addEventListener("click",function(){
        window.location = "index.php";
    },false);

    //funcion para conexion ajax al guardar texto
    $("#save").click(function(){

       // $("#saveSucess").html("entró en el met ajax");

       let formData = {
            title:$("#title").val(),
            text:$("#userText").Editor("getText")
        };

        $.post("../php/saveText_controller.php", formData, responseSaveText);

        

    });
    function responseSaveText(data){
        data=="sucess"? $("#saveSucess").html("guardado con exito") : $("#saveSucess").html("error al guardar");
    }
});