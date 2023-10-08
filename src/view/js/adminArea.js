$(function(){
 
    window.addEventListener("load",adminTable,false);

    $("body").on("mouseover",function(){
      let deleteBtn = document.querySelectorAll(".delete-btn");
      for(let i=0; i<deleteBtn.length;i++) deleteBtn[i].addEventListener("click",dropUser,false);

      let isAdminBtn = document.querySelectorAll(".isAdmin-btn");
      for(let i=0; i<isAdminBtn.length;i++) isAdminBtn[i].addEventListener("click",changeAdmin,false);

      document.getElementById("logo").addEventListener("click",toIndex,false);

      document.getElementById("submit").addEventListener("click",submit,false);

    });
    

  });
  function toIndex(){ window.location = "index.php"; }
  function submit(){$("#formIndex").submit();}
//----------------------funciones AJAX------------------------------------------------
  function adminTable(){
    $.post("../controller/adminTable.php",drawTable);
  }
  function dropUser(){
    let formdata = { id: $(this).attr("id")};
    $.post("../controller/dropUser.php",formdata,drawTable);
  }
  function changeAdmin(){
    let formdata = { id: $(this).attr("id").substr(6,this.length)};
    $.post("../controller/changeAdmin.php",formdata,drawTable);
  }
//----------------------Respuestas AJAX----------------------------------------------------
  function drawTable(data){
    $("#adminTable").html(data);
    $(".fa-check").css("color", "#127990");
    $(".fa-x").css("color", "red");  
  }