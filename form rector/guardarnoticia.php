<?php
include("conexion.php");
$date=$_POST["date"];
$user=$_POST["user"];
$title=$_POST["title"];
$content=$_POST["content"];
$image=$_POST["image"];

mysqli_query($conexion,"insert into  values('$date' , '$user' , '$title' , '$content' , '$image')") or die ("problemas al ingresar".mysqli_error($conexion));
echo "ingreso exitoso";



?>