<?php
include("conexion.php");
$pass=$_POST["password"];

mysqli_query($conexion,"insert into usuario(password) values('$pass')") or die ("problemas al ingresar".mysqli_error($conexion));
echo "ingreso exitoso";


?>