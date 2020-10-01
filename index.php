<?php

//Valida los datos del login 
include('login/validate_sesion.php'); 

//Si ya se inició la sesión redirecciona
if(isset($_SESSION['login_limited_sys'])){
header("location: view_historial_clinico_ltd.php");

}else if(isset($_SESSION['login_full_sys'])){
header("location: view_administrador.php");
}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Iniciar Sesión</title>

<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="css/fontawesome/css/all.css">
<link rel="stylesheet" type="text/css" href="js/bootstrap/bootstrap.min.css">
 

<!--Formatea RUT-->
<script type="text/javascript">
function formatRut(username)
{username.value=username.value.replace(/[.-]/g, '')
.replace( /^(\d{1,2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4')}
</script>

</head>
<body>

        <h3 class="title"><center style='margin-top: 5%;'><i class="fas fa-file-signature" style="margin-right: 10px;"></i>  SISTEMA SEGUIMIENTO PACIENTES COVID-19</center></h3>
        
        <div class="container">    
            <div id="loginbox"  class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Iniciar Sesión</div>
                        <!--<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="recupera.php">¿Se te olvidó tu contraseña?</a></div>-->
                    </div>     
                    
                    <div id="div_panel-body" class="panel-body" >
                        
                        <form class="form-horizontal" action="" method="POST" autocomplete="off">
                            
                            <div id="input" class="input-group">
                                <span class="input-group-addon"><i class="fas fa-user"></i></span>
                                <input id="username" type="text" class="form-control" name="usuario" value="" required autofocus onkeyup="formatRut(this)">       
                          
                            </div>
                            
                            <div id="input" class="input-group">
                                <span class="input-group-addon"><i class="fas fa-lock"></i></span>
                                <input id="password" type="password" class="form-control" name="contraseña" required>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-12 controls">
                                    <button id="btn-login" type="submit" name="submit" class="btn btn-success">Iniciar Sesión</a>
                                </div>
                            </div>
                             
                        </form>
                    </div>                     
                </div>  
            </div>
        </div>
<div class="copy-rights w3l">           
    <p id="leyenda">© <?php echo date("Y");?></a></p>           
</div>
</body>
</html>