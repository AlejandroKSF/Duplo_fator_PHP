<?php
session_start();

require "Authenticator.php";
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("location: Confirmacao.php");
    die();
}
$Authenticator = new Authenticator();

$checkResult = $Authenticator->verifyCode($_SESSION['auth_secret'], $_POST['code'], 2);    // 2 = 2*30sec clock tolerance

if (!$checkResult) {
    $_SESSION['failed'] = true;
    header("location: Confirmacao.php");
    die();
} 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Autenticação Concluída</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">   
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/estilo.css" />  
    <link rel="shortcut icon" href="img/Icone.png" />
</head>
    <body>  
    
    <style>
        .MsgAutenticacaoExito{
  text-align: center;
  font-weight: bold;
  font-size: 29px;
  color: #fff;
  padding-top: 300px;
}

.ImgConcluida{
  height: 350px;
  width: 350px;
  margin-left: 550px;
  position: absolute;
  top: 200px;
}

.PosicaoConcluida{
  margin-top: 80px;
}

    </style>
    

        <div class="PosicaoConcluida">
            <img class="ImgConcluida" src="img/AutenticadoConcluido.png">
            <!--<p class="MsgAutenticacaoExito">Autenticação OTP de Duplo Fator concluída com êxito !</p>-->  
        </div>   

       <!-- <img class="ImgConcluida"src="img/AutenticadoConcluido.png"> -->   
    </body>    
</html>