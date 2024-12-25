<?php
include("connect.php");

$fname = $_POST['first_name'];
$sname = $_POST['second_name'];
$ffname = $_POST['first_family_name'];
$sfname = $_POST['second_family_name'];
$dni = $_POST['dni'];
$email = $_POST['email'];
$password = $_POST['password'];

mysqli_query($connect, "update usuarios set firts_name=$fname , second_name=$sname, firts_last_name=$ffname, second_last_name=$sfname, dni=$dni, email=$email, password=$password") or die("Problemas en el select:" . mysqli_error($connect));
echo "El archivo fue modificado con exito";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="mostraruser.php">Usuarios</a>
</body>

</html>