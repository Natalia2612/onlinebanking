<?php
    if(!empty($dniUser)){
      echo"
      <header>
      <nav style='border-Bottom: 2px solid rgba(216, 237, 242, 0.644)'>
        <div class='nav-container'>
              <div class='nav-container__logo'>
                <a href=''><div class='logo'></div></a>
              </div>
              <div class='nav-container__right'>
                <div class='user_info'>
                  <li class='user_info__name'>
                    <b>";
                    
                    $sql=mysqli_query($conexion,"SELECT nomClient FROM cliente where dni=".$dniUser);
                    $fila=mysqli_fetch_array($sql);
                    $name=$fila['nomClient'];
                echo" $name</b>
                  </li>
                  <li>
                    <a class='logout' href='cerrarsesion.php'></a>
                  </li>
                </div>
          </div>
        </nav>
      </header>";
   }
   else{
     echo"
      <header>
        <nav>
        <div class='nav-container'>
            <div class='nav-container__logo'>
              <a href='../'><div class='logo'></div></a>
            </div>
        </div>
        </nav>
      </header>";
   }
?>