$(function(){
      
        $("#typeWriter").click(toProcesador);
        $("#logo").click(toIndex);
        $("#galery").click(toGalery);
        $("#adminArea").click(toAdminArea);
        
      
    
  });
  function toProcesador(){ window.location = "procesador.php"; }
  function toIndex(){ window.location = "index.php"; }
  function toGalery(){ window.location = "galery.php"; }
  function toAdminArea(){ window.location = "adminArea.php"; }
