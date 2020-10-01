<?php

function validar_rut($rut,$digito_v){

 if ($rut == ""){
    $verificado=false;
    return $verificado;
 }

 $x=2;
 $sumatorio=0;
  for ($i=strlen($rut)-1;$i>=0;$i--){
     if ($x>7){$x=2;}
      $sumatorio=$sumatorio+($rut[$i]*$x);
      $x++;
  }

  $digito=$sumatorio%11;
  $digito=11-$digito;

   switch ($digito){
     case 10:
        $digito="k";
       break;
     case 11:
        $digito="0";
       break;
   }

  if (strtolower($digito_v)==$digito){
   $verificado=true;

   } else {

   $verificado=false;

  }

   return $verificado;
}

?>