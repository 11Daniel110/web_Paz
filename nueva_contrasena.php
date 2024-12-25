<?php
include('connect.php'); // Ajusta la ruta si es necesario

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['token']) && isset($_POST['password'])) {
    $token = $_POST['token'];
    $password = hash('sha512', $_POST['password']); // Hashea la nueva contraseña

    // Buscar al usuario con el token
    $sql = "SELECT * FROM user WHERE token = '$token'";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        // Actualizar la contraseña
        $sql = "UPDATE user SET password = '$password', token = NULL WHERE token = '$token'";
        if ($connect->query($sql)) {
            echo "<script type=\"text/javascript\">alert('Contraseña actualizada correctamente. Ahora puedes iniciar sesión.'); </script>";
        } else {
            echo "Error al actualizar la contraseña: " . $connect->error;
        }
    } else {
        echo "Token inválido.";
    }
} else {
    header("Location: restablecer.php"); // Redirigir si no se accede correctamente
    exit();
}

$connect->close();
?>
