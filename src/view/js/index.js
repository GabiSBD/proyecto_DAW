$(function(){
    document.getElementById("freeWritter").addEventListener("click", 
    function(){
        window.location = "procesador.php";
    },false);
    document.getElementById("calculator").addEventListener("click", 
    function(){
        window.location = "calculadora.php";
    },false);
    document.getElementById("logo").addEventListener("click",function(){
        window.location = "index.php";
    },false);
});
