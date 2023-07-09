$(function(){
    window.addEventListener("beforeunload",function(){
        $.post("../controller/deleteAssets.php");
    });
});
