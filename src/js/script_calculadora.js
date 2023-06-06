$(document).ready(function(){
    $("#display").val("0");

    /*colocamos el registro de eventos uso attr de jquery porque addeventlistener me da problemas al pasarle parametros al metodo
    pero seguimos cumpliendo con el  modelo de W3C de disociar el html del script*/
    $("#button").attr("onclick","operacion('"+$("#button").val()+"')");
    $("#button2").attr("onclick","operacion('"+$("#button2").val()+"')");
    $("#button3").attr("onclick","operacion('"+$("#button3").val()+"')");
    $("#button4").attr("onclick","operacion('"+$("#button4").val()+"')");

    $("#num0").attr("onclick","displayNumbers('"+$("#num0").val()+"')");
    $("#num1").attr("onclick","displayNumbers('"+$("#num1").val()+"')");
    $("#num2").attr("onclick","displayNumbers('"+$("#num2").val()+"')");
    $("#num3").attr("onclick","displayNumbers('"+$("#num3").val()+"')");
    $("#num4").attr("onclick","displayNumbers('"+$("#num4").val()+"')");
    $("#num5").attr("onclick","displayNumbers('"+$("#num5").val()+"')");
    $("#num6").attr("onclick","displayNumbers('"+$("#num6").val()+"')");
    $("#num7").attr("onclick","displayNumbers('"+$("#num7").val()+"')");
    $("#num8").attr("onclick","displayNumbers('"+$("#num8").val()+"')");
    $("#num9").attr("onclick","displayNumbers('"+$("#num9").val()+"')");

    $("#decimal").attr("onclick","displayNumbers('"+$("#decimal").val()+"')");
    $("#igual").attr("onclick","igual('"+$("#igual").val()+"')");
    document.getElementById("reset").addEventListener("click",reset, false);
  })
  var cifra ="";
  var cont = 0;
  var ultValor = 0;
  var ultOperando="";
  var resultado ="";
  
  
  function displayNumbers(num){
     cifra =  cifra + num;
     $("#display").val(cifra);
  }
    //hay que indicar el valor de cifra al final por que no lo lee junto al vaor dado en ultOperando
  function reset(){
    $("#display").val("0")
    cont=0,ultValor=0;
    cifra="",ultOperando = "";
  }

  /*el uso de la recursividad en cada uno de los casos permite concatenar operaciones en la calculadora haciendo que en caso de ocurrir
    la ultima de ellas se vaya realizando sin  dar al simbolo "=", por eso en los case / o *, hubo que realizar a la vuelta  de la 
    recursividad dividir entre 1 o multiplicar por 1,respectivamente,  ya que si no sobresecribia el resultado de la anterior operación 
    con el campo cifra en blanco dando errores en el resultado de la operación previa*/
  function operacion(op){
    switch(op){
      case '+':
      if(ultOperando=="-"||ultOperando=="*"||ultOperando=="/")operacion(ultOperando);
        ultValor += Number(cifra);
        $("#display").val(ultValor);
          
        cifra = "";
        cont++;
        ultOperando = op;
        break;
      case '-':
      if(ultValor==0 && cont==0){
          ultValor= Number(cifra);
        }
      else{
        if(ultOperando=="+"||ultOperando=="*"||ultOperando=="/")operacion(ultOperando);
        ultValor -= Number(cifra);
      }
        $("#display").val(ultValor);
          
        cifra = "";
        cont++;
        ultOperando = op;
        break;
      case '*':
      if(ultValor==0 && cont==0){
          ultValor= Number(cifra);
        }else{
          if(ultOperando=="+"||ultOperando=="-"||ultOperando=="/"){
            operacion(ultOperando);
            ultValor*=1;
          }else{
            ultValor *= Number(cifra);
          }
        }

       $("#display").val(ultValor);

        cifra = "";
        cont++;
        ultOperando = op;
        break;

      case '/':
        if(ultValor==0 && cont==0){
          ultValor= Number(cifra);
        }else{
          if(ultOperando=="+"||ultOperando=="*"||ultOperando=="-"){
            operacion(ultOperando);
            ultValor /= 1;
        }else{
          ultValor /= Number(cifra);
        }
        }
        
        $("#display").val(ultValor);

        cifra = "";
        cont++;
        ultOperando = op;
        break;
    }
  }
  function igual(){
     switch(ultOperando){
        case "+": 
        resultado = ultValor+=Number(cifra)
          $("#display").val(resultado);
          cifra= resultado;
          ultValor=0;
          cont=0;
          ultOperando="";
          break;
        case '-':
        resultado = ultValor-=Number(cifra)
          $("#display").val(resultado);
          cifra= resultado;
          ultValor=0;
          cont=0;
          ultOperando="";
          break;
        case '*':
        resultado = ultValor*=Number(cifra)
          $("#display").val(resultado);
          cifra= resultado;
          ultValor=0;
          cont=0;
          ultOperando="";
          break;
        case '/':
          resultado = ultValor/=Number(cifra)
          $("#display").val(resultado);
          cifra= resultado;
          ultValor=0;
          cont=0;
          ultOperando="";
          break;
      }
  }