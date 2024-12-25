<?php
include("connect.php");


//Guardar datos

$first_name=$_POST['first_name'];
$second_name=$_POST['second_name'];
$first_family_name=$_POST['first_family_name'];
$second_family_name=$_POST['second_family_name'];
$role_id=$_POST['role_id'];
$dni=$_POST['dni'];
$dni_id=$_POST['dni_id'];
$email=$_POST['email'];
$password=$_POST['password'];

//Hasheo

$password=hash('sha512', $password);

//Enviar datos del formulario a la base de datos

mysqli_query($connect,"INSERT INTO user(first_name, second_name, first_family_name, second_family_name, role_id, dni, dni_type_id, email, password) VALUES ('$_POST[first_name]','$_POST[second_name]','$_POST[first_family_name]', '$_POST[second_family_name]','$_POST[role_id]','$_POST[dni]','$_POST[dni_id]','$_POST[email]','$password')") or die ("Problemas en el select".mysqli_error($connect));

echo "<script>alert('Se a registrado correctamente')</script>";

header("Location: ../form/login.html");

?>