<?php
    echo "
    <!DOCTYPE html>
    <html lang='en'>
        <head>
            <meta charset='utf-8' />
            <meta name='viewport' content='width=device-width, initial-scale=1' />
            <title>Online banking</title>
            <link rel='stylesheet' href='../css/styles.css'/>
            <script type='text/javascript' language='javasript' src='../js/validaciones.js'></script>
        </head>
        <body>";
        include "header.php";
?>
<div>
      <form class='register-form' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method='post'>
            <div class='cont'>
                <input
                    id='dni'
                    name='dni'
                    type='number'
                    onkeyup='handleChange()'
                    value="<?php if(isset($_POST['dni'])) echo $_POST['dni']?>"
                    placeholder='Tu número de DNI'
                />
            </div>
            <div class='cont'>
                <input
                    id='password'
                    name='password'
                    type='password'
                    maxlength='20'
                    onkeyup='handleChange()'
                    value="<?php if(isset($_POST['password'])) echo $_POST['password']?>"
                    placeholder='Una contraseña'
                />
            </div>
            <div class='cont'>
                <input
                    id='name'
                    name='name'
                    type='text'
                    maxlength='50'
                    onkeyup='handleChange()'
                    value="<?php if(isset($_POST['name'])) echo $_POST['name']?>"
                    placeholder='Tu nombre y apellido'
                />
            </div>
            <div class='cont'>
                <input
                    id='phone'
                    name='phone'
                    type='number'
                    onkeyup='handleChange()'
                    value="<?php if(isset($_POST['phone'])) echo $_POST['phone']?>"
                    placeholder='Un teléfono de contacto'
                />
            </div>
            <input  type='hidden' name='activarButton' id='activarButton'
                    value="<?php if(isset($_POST['activarButton'])) echo $_POST['activarButton']?>"/>
            <?php
                include "conexion.php";
                if(isset($_POST['submit']))
                 $activar=$_POST['activarButton'];
                 $mensaje="";
                 if(!empty($activar)){
                     $dni=$_POST['dni'];
                     $pass=$_POST['password'];
                     $name=$_POST['name'];
                     $phone=$_POST['phone'];
                     $cbuArg=$dni.'001';
                     $cbuUsd=$dni.'002';
                     $balanceArg=10000;
                     $balanceUsd=300;
                     if(strlen($pass)<6){
                         $mensaje="El campo de contraseña debe ser mayor a 6 caracteres";
                     }

                     if(!empty($mensaje)){
                        echo "<div class='message' style='color:red'>$mensaje</div>";
                     }
                     else{
                        $consulta=mysqli_query($conexion,"SELECT dni FROM cliente c WHERE c.dni=".$dni);
                        $num_rows = mysqli_num_rows($consulta);
                        if($num_rows==1){
                            echo"<div class='message'>Hubo un error. Ya exista un registro con ese DNI.</div>";
                        }
                        else{
                            $insertarCliente = "INSERT INTO cliente(dni, nomClient, telefono) VALUES ('$dni','$name','$phone')";
                            $insertarUsuario="INSERT INTO usuario(fk_dni, pass) VALUES ('$dni','$pass')";
                            $insertarCuentaArg = "INSERT INTO cuentabancaria(nroCBU, fk_dni, monto) VALUES ('$cbuArg','$dni','$balanceArg')";
                            $insertarCuentaUSD = "INSERT INTO cuentabancaria(nroCBU, fk_dni, monto) VALUES ('$cbuUsd','$dni','$balanceUsd')";
                            $r1 = mysqli_query($conexion,$insertarCliente);
                            $r2 = mysqli_query($conexion,$insertarUsuario);
                            $r3 = mysqli_query($conexion,$insertarCuentaArg);
                            $r4 = mysqli_query($conexion,$insertarCuentaUSD);
                            if($r1 && $r2 && $r3 && $r4){
                                echo "
                                    <html>
                                        <head>
                                        
                                        <meta http-equiv='REFRESH' content='0 ; url=../'>
                                        <script>
                                            alert('Se ha registrado al cliente de forma correcta');
                                        </script>
                                        </head>
                                    </html>
                                    ";
                            }
                        } 
                     }
                 }
             ?>
            <button id='button' name='submit' type='submit'
            <?php
                if(isset($_POST['activarButton'])&&!empty($_POST['activarButton'])) echo "style='background:#123807'"
            ?>
            >
            <span>Registrarse</span>
            </button>
            <a class='return' href='../'>Volver a home</a>
        </form>
  </div>
</body>
</html>
