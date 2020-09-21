<?php
    $user="root";
    $pass="";
    $server="localhost";
    $db="basebanco";
    //$conexion=mysqli_connect($server,$user,$pass) or die ("error al conectar a la base de datos".mysql_error());
    //mysqli_select_db($conexion,$db);
    $conexion=  mysqli_connect("localhost","root","","basebanco");
    mysqli_set_charset($conexion,"utf8");
?>