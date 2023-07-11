$(function(){
    window.addEventListener("load",adminTable);
  });
//----------------------funciones AJAX------------------------------------------------
  function adminTable(){
    $.post("../controller/adminTable.php",drawTable);
  }
//----------------------Respuestas AJAX----------------------------------------------------
  function drawTable(data){
    $("#adminTable").html(data);
    $(".fa-check").css("color", "#127990");
    $(".fa-x").css("color", "red");  
  }