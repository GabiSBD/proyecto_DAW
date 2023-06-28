$(function(){
    
        document.getElementById("typeWriter").addEventListener("click",toProcesador,false);
        document.getElementById("calculator").addEventListener("click",toCalculator,false);
        document.getElementById("logo").addEventListener("click",toIndex,false);
        document.getElementById("galery").addEventListener("click",toGalery,false);
    
    
  });
  function toProcesador(){ window.location = "procesador.php"; }
  function toCalculator(){ window.location = "calculadora.php"; }
  function toIndex(){ window.location = "index.php"; }
  function toGalery(){ window.location = "galery.php";}
