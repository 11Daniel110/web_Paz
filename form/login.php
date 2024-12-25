<?php
include("connect.php"); 

// Asegurarse de que la sesión se inicie solo una vez
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$dni = $_POST['document'];
$password = $_POST['password'];

// Hasheo (asegúrate de que este método coincida con el usado durante el registro)
$password = hash('sha512', $password);

// Función para manejar el inicio de sesión exitoso
function handleLoginSuccess($fila) {
    global $password; // Acceder a la variable $password del ámbito global

    $_SESSION['id'] = $fila['id'];
    $_SESSION['name'] = $fila['first_name'] . " " . $fila['second_name'] . " " . $fila['first_family_name'] . " " . $fila['second_family_name'];
    $_SESSION['password'] = $password;
    $_SESSION['image'] = $fila['image'];
    $_SESSION['email'] = $fila['email'];
    $_SESSION['role_id'] = $fila['role_id'];

    // Redireccionar a la URL prevista o a index.php
    if (isset($_SESSION['intended_url'])) {
        header("Location: " . $_SESSION['intended_url']);
        unset($_SESSION['intended_url']); 
    } else {
        header("Location: ../index.php"); 
    }
    exit(); 
}

// Verificar usuario en las tablas (usa OR || en lugar de AND &&)
$user = mysqli_query($connect, "SELECT * FROM user WHERE dni='$dni' AND password='$password'");
$secretary = mysqli_query($connect, "SELECT * FROM user WHERE dni='$dni' AND password='$password'");
$admin = mysqli_query($connect, "SELECT * FROM user WHERE dni='$dni' AND password='$password'");

if (mysqli_num_rows($user) > 0) {
    handleLoginSuccess(mysqli_fetch_assoc($user));
} elseif (mysqli_num_rows($secretary) > 0) {
    handleLoginSuccess(mysqli_fetch_assoc($secretary));
} elseif (mysqli_num_rows($admin) > 0) {
    handleLoginSuccess(mysqli_fetch_assoc($admin));
} else {
    echo "<script>alert('El usuario no existe o las credenciales son incorrectas')</script>";
}
?>


