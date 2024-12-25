<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <center>
    <form class="formulario" action="formrector.html" method="post" enctype="multipart/form-data">
        <h2>SOLICITA TU CERTIFICADO!</h2>
        <?php
            $fecha_actual = date("Y-m-d");
            echo $fecha_actual; 
        ?>
         
         <br>
         <br>
         <label>Ingrese el nombre del estudiante: </label>
         <input type="text" placeholder="name" name="name">
         <br>
         <br>
         <label>Ingrese el grado del estudiante: </label>
         <input type="text" placeholder="grade" name="grade">
         <br>
         <br>
         <label>Seleccione el tipo de documento del estudiante: </label>
         <select name="type" id="type">
             <option value="Registro civil">Registro civil</option>
             <option value="Documento de identidad">Documento de identidad</option>
             <option value="Cédula de ciudadania">Cédula de ciudadania</option>
             <option value="Cédula extranjería">Cédula extranjería</option>
             <option value="Pasaporte">Pasaporte</option>
         </select>
         <br>
         <br>
         <label>Ingrese el documento de identidad del estudiante: </label>
         <input type="text" placeholder="dni" name="dni">
         <br>
         
         <br>
      
         <input type="submit" value="subir">
     </form>

     <?php 
?>
    </center>
</body>
</html>