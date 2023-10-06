$(function(){
      
        $("#typeWriter").click(toProcesador);
        $("#logo").click(toIndex);
        $("#galery").click(toGalery);
        $("#adminArea").click(toAdminArea);
        $("#submit").click(submit);
        $("#reset").click(clear);

        
      
    
  });
  function toProcesador(){ window.location = "procesador.php"; }
  function toIndex(){ window.location = "index.php"; }
  function toGalery(){ window.location = "galery.php"; }
  function toAdminArea(){ window.location = "adminArea.php"; }
  function submit(){$("#formIndex").submit();}
  function clear(){ 
      $("#username").val("");
      $("#password").val("");
  }
