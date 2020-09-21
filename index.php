<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Online banking</title>
    <link rel="stylesheet" href="css/styles.css"/>
    <script type='text/javascript' language='javasript' src='js/validaciones.js'></script>
  </head>
  <body>
      <div class="login">
          <div class="welcome-text">
            <p> Hola :) Bienvenido a <br /> Online Banking </p>
          </div>
          <form class="login-form" method='POST'>
            <h2>Ingresá desde acá para operar</h2>
            <div class="cont">
              <input
                id="dni"
                name="dni"
                type="text"
                onkeyup='verificar()'
                value="<?php if(isset($_POST['dni'])) echo $_POST['dni']?>"
                placeholder="Tu número de documento"
              />
            </div>
            <div class="cont">
              <input
                id="password"
                name="password"
                type="password"
                onkeyup='verificar()'
                value="<?php if(isset($_POST['password'])) echo $_POST['password']?>"
                placeholder="Tu clave"
              />
            </div>
            <?php
                include("container/conexion.php");
                if(isset($_POST['submit']) && !empty($_POST['dni']) && !empty($_POST['password'])){
                  $dni=$_POST['dni'];
                  $pass=$_POST['password'];
                  $consulta=mysqli_query($conexion,"SELECT fk_dni, pass FROM usuario u where u.fk_dni=".$dni." and u.pass='".$pass."'");
                  $num_rows = mysqli_num_rows($consulta);
                  if($num_rows==0){
                    echo "<div class='message'>Credenciales invalidas. Nro. de dni y/o clave son incorrectas.</div>";
                  }
                  else{
                    session_start();
                    $_SESSION['dni']=$dni;
                    echo"
                        <html>
                           <head>
                                <meta http-equiv='REFRESH' content ='0; url=container/home.php'>
                           </head>
                        </html>
                        ";
                  }
                }
            ?>
            <button name='submit' type="submit" id='button'
            <?php
                if(!empty($_POST['dni']) && !empty($_POST['password'])) echo "style='background:#123807'";
            ?>
            ><span>Ingresar</span></button>
            <div class="bot-links">
              <p>Si no tenés tu clave y/o usuario</p>
              <a href="container/register.php">Crear clave y usuario</a>
            </div>
          </form>
    </div>
  </body>
</html>