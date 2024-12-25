<?php
  $conexion = mysqli_connect("localhost" , "root" , "" , "colegio") or die("problemasen conectar a la base de datos");
  mysqli_set_charset($conexion,"uft8");