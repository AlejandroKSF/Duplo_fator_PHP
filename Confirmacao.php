<?php
session_start();
require "Authenticator.php";

$Authenticator = new Authenticator();
if (!isset($_SESSION['auth_secret'])) {
    $secret = $Authenticator->generateRandomSecret();
    $_SESSION['auth_secret'] = $secret;
}

$qrCodeUrl = $Authenticator->getQR('Projeto Duplo Fator', $_SESSION['auth_secret']);

if (!isset($_SESSION['failed'])) {
    $_SESSION['failed'] = false;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <title>Projeto Duplo Fator</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />   
   <link rel="stylesheet" href="css/estilo.css" />
   <link rel="shortcut icon" href="img/Icone.png" />
  </head>

<body>
  <div id="register-container">
    <div id="register-banner">
      <div id="banner-layer">
        <h1>Duplo Fator Autenticação OTP</h1>
      </div>
    </div>  
      
    <form action="Verificacao.php" method="post">
      <div style="text-align: center;">
            <?php 
                if ($_SESSION['failed']): 
            ?>
            <div class="CodigoInvalido">Código Inválido !</div>
            <?php
                $_SESSION['failed'] = false;
            ?>
        <?php endif ?>
        <h2>Autenticar QR Code</h2>
          <p>Faça a leitura do código QR abaixo</p>                  
            <img style="text-align: center;" class="img-fluid" src="<?php echo $qrCodeUrl ?>" alt="Verificador Google Authenticator">
            <br>
            <br>        
            <input type="text" class="txtCodigo" name="code" placeholder="Informe o código QR">
            <br>
            <br>    
            <button type="submit" class="btnAutenticar">Confirmar código</button>
        </div>
    </form>
  </body>               
</html>