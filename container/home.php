<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Online banking</title>
    <link rel="stylesheet" href="../css/styles.css"/>
    <script type='text/javascript' language='javasript' src='../js/validaciones.js'></script>
    
  </head>
  <body>
    <?php
          session_start();
          $dniUser=$_SESSION['dni'];
          include "conexion.php";
          include "header.php";
          $sql=mysqli_query($conexion,"SELECT nroCBU,fk_dni, monto FROM cliente c, cuentabancaria a WHERE c.dni=a.fk_dni and fk_dni=".$dniUser);
          //$fila=mysqli_fetch_array($sql);
          $cbuArg=$dniUser.'001';
          $cbuUSD=$dniUser.'002';
          $balanceArg="";
          $balanceUSD="";
          while($fila=mysqli_fetch_array($sql)){
            if($fila['nroCBU']==$cbuArg){
              $balanceArg=$fila['monto'];
            }
            if($fila['nroCBU']==$cbuUSD){
              $balanceUSD=$fila['monto'];
            }
          }
    ?>
<div class="Home">
      <section class="info-top">
        <div class="info-top__wrapper">
          <div class="text__wrapper">
            <p class="title">Pagá online y ganá en comodidad</p>
            <p class="subtitle">
              tus servicios e impuestos en un solo lugar, accedé a tus
              comprobantes y recibí recordatorios por mail antes del
              vencimiento.
            </p>
            <button>Consultar</button>
          </div>
        </div>
      </section>
      <section class="info-main">
        <h3>Tus productos</h3>
        <div class="cont__products" onclick="mostrar('wrapper-modal')">
          <div class="cont__product_card">
              <p class="title">Cuentas</p>
              <p class="subtitle">Saldos totales</p>
              <div class="balance-wrapper">
                <p>
                  $ <span className="balance"><?php echo $balanceArg; ?></span>
                </p>
                <p>
                  u$s <span className="balance"><?php echo $balanceUSD;?></span>
                </p>
              </div>
            </div>
        </div>
      </section>    
  </div>
  <?php
      include "transferModal.php"
  ?>
    </body>
</html>