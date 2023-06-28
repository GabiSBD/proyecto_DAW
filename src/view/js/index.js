$(function(){
      
        $("#typeWriter").click(toProcesador);
        $("#logo").click(toIndex);
        $("#calculator").click(toCalculator);
        $("#galery").click(toGalery);
      
    
  });
  function toProcesador(){ window.location = "procesador.php"; }
  function toCalculator(){ window.location = "calculadora.php"; }
  function toIndex(){ window.location = "index.php"; }
  function toGalery(){ window.location = "galery.php";}
