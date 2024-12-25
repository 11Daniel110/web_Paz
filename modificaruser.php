<?php
include('connect.php');
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION["id"])) {
    $_SESSION['intended_url'] = $_SERVER['REQUEST_URI']; 
    header("Location: form/login.html"); 
    exit();
}

$id = $_SESSION["id"];

// Obtiene los datos del usuario de la base de datos
$result = mysqli_query($connect, "SELECT * FROM user WHERE id = $id");

// Verifica si se encontraron resultados
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
} else {
    die("Error: No se encontró el usuario.");
}

// Procesa el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['first_name'];
    $sname = $_POST['second_name'];
    $ffname = $_POST['first_family_name'];
    $sfname = $_POST['second_family_name'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];
    // No obtengas la contraseña directamente del POST

    // Manejo de la imagen de perfil (El código se mantiene igual)
    // ... (Asegúrate de tener el código para manejar la imagen aquí) ...

    // Actualiza los datos del usuario en la base de datos
    $sql = "UPDATE user SET 
            first_name = '$fname',
            second_name = '$sname',
            first_family_name = '$ffname',
            second_family_name = '$sfname',
            dni = '$dni',
            email = '$email'";

    // Agrega la contraseña solo si se proporciona una nueva
    if (!empty($_POST['password'])) {
        $password = hash('sha512', $_POST['password']); // Hashea la nueva contraseña
        $sql .= ", password = '$password'"; 
    }

    $sql .= " WHERE id = $id";

    if (mysqli_query($connect, $sql)) {
        echo "Datos actualizados correctamente.";

        // Actualiza los datos de la sesión
        $_SESSION['name'] = $fname . " " . $sname . " " . $ffname . " " . $sfname;
        $_SESSION['email'] = $email;
        // Si se actualizó la contraseña, también actualiza la sesión
        if (!empty($_POST['password'])) {
            $_SESSION['password'] = $password; 
        }

        // Redirige a la página de perfil o a donde desees
        header("Location: index.php"); 
        exit();
    } else {
        echo "Error al actualizar los datos: ".mysqli_error($connect);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="css/modificar.css">
</head>
<body>
    <center>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <br>
        <label for="first_name">Primer Nombre:</label>
        <br>
        <input type="text" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>" required><br><br>

        <label for="second_name">Segundo Nombre:</label>
        <br>
        <input type="text" id="second_name" name="second_name" value="<?php echo $row['second_name']; ?>"><br><br>

        <label for="first_family_name">Primer Apellido:</label>
        <br>
        <input type="text" id="first_family_name" name="first_family_name" value="<?php echo $row['first_family_name']; ?>" required><br><br>

        <label for="second_family_name">Segundo Apellido:</label>
        <br>
        <input type="text" id="second_family_name" name="second_family_name" value="<?php echo $row['second_family_name']; ?>"><br><br>

        <label for="dni">DNI:</label>
        <br>
        <input type="text" id="dni" name="dni" value="<?php echo $row['dni']; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>

        <label for="password">Nueva Contraseña (dejar en blanco para mantener la actual):</label><br>
        <input type="password" id="password" name="password"><br><br>

        <input type="submit" value="Actualizar">
    </form>
  </center>
</body>
</html>
