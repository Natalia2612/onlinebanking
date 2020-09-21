<div class="wrapper-modal" id="wrapper-modal" style="visibility:hidden">
        <div class="modal cont_transfer">
          <span class="close" onClick="closeModal('wrapper-modal');">
            x
          </span>
          <form method="POST" onsubmit="return validarForm(this,<?php echo $dniUser?>,<?php echo $balanceArg?>,<?php echo $balanceUSD?>)">
             <div class="form-wrapper">
              <h4>
                <span class="step">1</span>Seleccioná la cuenta de orígen
              </h4>
              <div class="my_accounts">
                <label for='ars' id='labelArs' onclick='comprobarSeleccionado();' style='border-color:#EC0000'>
                  <p class="account_title">Cuenta ARS</p>
                  <input
                    type='radio'
                    name='cuenta'
                    id='ars'
                    value="ars"
                    checked
                  />
                  <span><?php echo $cbuArg ?></span>
                  <p class="account_balance">$ <?php echo $balanceArg?></p>
                </label>

                <label for='usd' id='labelUsd' onclick='comprobarSeleccionado();'>
                  <p class="account_title">Cuenta USD</p>
                  <input
                    type="radio"
                    name="cuenta"
                    id='usd'
                    value="usd"/>
                  <span><?php echo $cbuUSD ?></span>
                  <p class="account_balance">u$s <?php echo $balanceUSD?></p>
                </label>
              </div>
            </div>

            <div>
              <h4>
                <span class="step">2</span>Ingresá el DNI de cuenta destino y
                el importe
            </h4>
              <div class="input_container">
                <input
                  id="dni"
                  name="dni"
                  type="number"
                  value="<?php if(isset($_POST['dni'])) echo $_POST['dni']?>"
                  placeholder="Nro. DNI destinatario"
                  onkeyup="activarButton()"
                />
                <input
                  id="importe"
                  name="importe"
                  type="number"
                  value="<?php if(isset($_POST['importe'])) echo $_POST['importe']?>"
                  placeholder="Importe a transferir"
                  onkeyup="activarButton()"
                />
              </div>
              <button name='submit' type="submit" id='button'
              <?php
                  if(!empty($_POST['dni']) && !empty($_POST['importe'])) echo "style='background:#123807'";
              ?>
              >
                  <span>Transferir</span>
              </button>
              <p id='message' class='message'></p>
              <?php
                if(isset($_POST['submit'])){
                      $dniDestino=$_POST['dni'];
                      $tipoTransaccion=$_POST['cuenta'];
                      $importe=$_POST['importe'];
                      $fecha=date('d/m/Y');
                      $sql=mysqli_query($conexion,"SELECT nroCBU, fk_dni, monto FROM cuentabancaria c1, cliente c WHERE c.dni=c1.fk_dni and c1.fk_dni=".$dniDestino);
                      $num_rows = mysqli_num_rows($sql);
                      if($num_rows==0){
                        echo "<script> 
                                document.getElementById('message').innerHTML='DNI de cuenta destino no fue encontrado, vuelta a intentar..'
                                document.getElementById('wrapper-modal').style.visibility='visible';
                             </script>";
                      }
                      else{
                           if($tipoTransaccion=='ars'){
                                         $cbuDestinoArg=$dniDestino.'001';
                                          $balanceArgDestino="";
                                          while($fila=mysqli_fetch_array($sql)){
                                            if($fila['nroCBU']==$cbuDestinoArg){
                                              $balanceArgDestino=$fila['monto'];
                                            }
                                          }
                                          $balanceArg=$balanceArg-$importe;
                                          $balanceArgDestino=$balanceArgDestino+$importe;
                                          $updateTitular=mysqli_query($conexion,"UPDATE cuentabancaria SET monto=".$balanceArg." WHERE nroCBU=".$cbuArg);//actuliza balance de cliente origen
                                          $updateDestino=mysqli_query($conexion,"UPDATE cuentabancaria SET monto=".$balanceArgDestino." WHERE nroCBU=".$cbuDestinoArg);//actualiza balance de cliente destino
                                          $insertarTransaccion=mysqli_query($conexion,"INSERT INTO transacciones(fk_dniOrigen, fk_dniDestino, tipoDeTransaccion, monto, fecha) VALUES ('$dniUser','$dniDestino','$tipoTransaccion','$importe','$fecha')");//registra la transacccion
                                          echo "<script> 
                                                    document.getElementById('message').innerHTML='Transferencia realizada con éxito';
                                                    document.getElementById('wrapper-modal').style.visibility='visible';
                                                </script>";
                                          echo"<html>
                                                <head>
                                                    <meta http-equiv='REFRESH' content='0;url=home.php'>
                                                </head>
                                              </html>";
                           }
                           else{
                                          $cbuDestinoUsd=$dniDestino.'002';
                                          $balanceUsdDestino="";
                                          while($fila=mysqli_fetch_array($sql)){
                                            if($fila['nroCBU']==$cbuDestinoUsd){
                                              $balanceUsdDestino=$fila['monto'];
                                            }
                                          }
                                          $balanceUSD=$balanceUSD-$importe;
                                          $balanceUsdDestino=$balanceUsdDestino+$importe;
                                          $updateTitular=mysqli_query($conexion,"UPDATE cuentabancaria SET monto=".$balanceUSD." WHERE nroCBU=".$cbuUSD);//actuliza balance de cliente origen
                                          $updateDestino=mysqli_query($conexion,"UPDATE cuentabancaria SET monto=".$balanceUsdDestino." WHERE nroCBU=".$cbuDestinoUsd);//actualiza balance de cliente destino
                                          $insertarTransaccion=mysqli_query($conexion,"INSERT INTO transacciones(fk_dniOrigen, fk_dniDestino, tipoDeTransaccion, monto, fecha) VALUES ('$dniUser','$dniDestino','$tipoTransaccion','$importe','$fecha')");//registra la transacccion
                                          echo "<script> 
                                                  document.getElementById('message').innerHTML='Transferencia realizada con éxito';
                                                  document.getElementById('wrapper-modal').style.visibility='visible';
                                                </script>";
                                           echo"<html>
                                                  <head>
                                                     <meta http-equiv='REFRESH' content='0;url=home.php'>
                                                  </head>
                                                </html>";
                          }
                      }
                 }
              ?>
            </div>
          </form>
        </div>
      </div>