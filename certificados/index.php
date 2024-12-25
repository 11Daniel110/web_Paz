<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mail Form</title>
  <link rel="stylesheet" href="css/styl.css">
</head>
<body>
  <center>
    <form method="post" action="" id="certificadoForm"> 
      <br>
      <label> Digite el documento del estudiante: </label>
      <br>
      <input type="text" placeholder="Documento" name="dni" id="dni" required>
      <br>
      <br>
      <label>Seleccione el Certificado solicitado</label>
      <br>
      <select name="pdf" id="pdf" required>
        <option value="">Seleccione uno</option>
        <option value="dupli_diploma.php">Duplicado de Diploma</option>
        <option value="constancia.php">Constancia</option>
        <option value="permisos.php">Permisos</option>
      </select>
      <br>
      <br>
      <div id="datosDiploma" style="display:none;">
        <label for="dia">Día:</label>
        <br>
        <input type="text" id="dia" name="dia" min="1" max="31">
        <br>
        <label for="mes">Mes:</label>
        <br>
        <input type="text" id="mes" name="mes" min="1" max="12">
        <br>
        <label for="año">Año:</label>
        <br>
        <input type="text" id="año" name="año" min="1900">
        <br><br>
      </div>

      <div id="datosAdicionales" style="display:none;">
        <label for="primerNombre">Primer Nombre:</label>
        <br>
        <input type="text" id="primerNombre" name="primerNombre">
        <br>
        <label for="segundoNombre">Segundo Nombre:</label>
        <br>
        <input type="text" id="segundoNombre" name="segundoNombre">
        <br>
        <label for="primerApellido">Primer Apellido:</label>
        <br>
        <input type="text" id="primerApellido" name="primerApellido">
        <br>
        <label for="segundoApellido">Segundo Apellido:</label>
        <br>
        <input type="text" id="segundoApellido" name="segundoApellido">
        <br>
       <div id="periodo-input" style="display:none;">
       <label for="periodo">Periodo:</label>
       <input type="text" id="periodo" name="periodo">
  </div>
        <br>
        <label for="horaEntrada">Hora de Entrada:</label>
        <br>
        <input type="time" id="horaEntrada" name="horaEntrada">
        <br>
        <label for="horaSalida">Hora de Salida:</label>
        <br>
        <input type="time" id="horaSalida" name="horaSalida">
        <br><br>
      </div>

      <div id="datosPermisos" style="display:none;">
        <label for="diaPermiso">Día:</label>
        <br>
        <input type="text" id="diaPermiso" name="diaPermiso" min="1" max="31">
        <br>
        <label for="mesPermiso">Mes:</label>
        <br>
        <input type="text" id="mesPermiso" name="mesPermiso" min="1" max="12">
        <br>
        <label for="motivoPermiso">Motivo:</label>
        <br>
        <input type="text" id="motivoPermiso" name="motivoPermiso">
        <br><br>
      </div>
      
      <input type="submit" value="Enviar">
      <a href="../index.php" class="btn btn-secondary ml-2">Salir</a>
    </form>
  </center>

  <script>
    document.getElementById('pdf').addEventListener('change', function() {
      var selectedValue = this.value;
      var datosDiploma = document.getElementById('datosDiploma');
      var datosAdicionales = document.getElementById('datosAdicionales');
      var datosPermisos = document.getElementById('datosPermisos');
      var periodoInput = document.getElementById('periodo-input'); // Obtener el campo de periodo

      if (selectedValue === 'dupli_diploma.php') {
        datosDiploma.style.display = 'block';
        datosAdicionales.style.display = 'none';
        datosPermisos.style.display = 'none';
        periodoInput.style.display = 'none'; // Ocultar campo de periodo
      } else if (selectedValue === 'constancia.php') {
        datosAdicionales.style.display = 'block';
        datosDiploma.style.display = 'none';
        datosPermisos.style.display = 'none';
        periodoInput.style.display = 'block'; // Mostrar campo de periodo
      } else if (selectedValue === 'permisos.php') {
        datosPermisos.style.display = 'block';
        datosDiploma.style.display = 'none';
        datosAdicionales.style.display = 'none';
        periodoInput.style.display = 'none'; // Ocultar campo de periodo
      } else {
        datosDiploma.style.display = 'none';
        datosAdicionales.style.display = 'none';
        datosPermisos.style.display = 'none';
        periodoInput.style.display = 'none'; // Ocultar campo de periodo
      }
    });

    document.getElementById('certificadoForm').addEventListener('submit', function(event) {
      event.preventDefault(); 

      var dniInput = document.getElementById('dni');
      var selectElement = document.getElementById('pdf');
      var selectedValue = selectElement.value;

      // Obtener valores de los campos adicionales
      var primerNombre = document.getElementById('primerNombre').value;
      var segundoNombre = document.getElementById('segundoNombre').value;
      var primerApellido = document.getElementById('primerApellido').value;
      var segundoApellido = document.getElementById('segundoApellido').value;
      var periodo = document.getElementById('periodo').value; // Obtener el periodo
      var horaEntrada = document.getElementById('horaEntrada').value;
      var horaSalida = document.getElementById('horaSalida').value;

      // Obtener valores de día, mes y año
      var dia = document.getElementById('dia').value;
      var mes = document.getElementById('mes').value;
      var año = document.getElementById('año').value;

      // Obtener valores de día, mes y motivo para permisos
      var diaPermiso = document.getElementById('diaPermiso').value;
      var mesPermiso = document.getElementById('mesPermiso').value;
      var motivoPermiso = document.getElementById('motivoPermiso').value;

      if (dniInput.value === "" || isNaN(dniInput.value)) {
        alert("Por favor, ingrese un número de documento válido.");
        return;
      }

      if (selectedValue !== "") {
        let url = selectedValue + "?dni=" + dniInput.value;

        // Agrega los datos adicionales a la URL si se seleccionó "Constancia"
        if (selectedValue === 'constancia.php') {
          url += "&primerNombre=" + encodeURIComponent(primerNombre) +
                 "&segundoNombre=" + encodeURIComponent(segundoNombre) +
                 "&primerApellido=" + encodeURIComponent(primerApellido) +
                 "&segundoApellido=" + encodeURIComponent(segundoApellido) +
                 "&periodo=" + encodeURIComponent(periodo) + // Agregar periodo a la URL
                 "&horaEntrada=" + encodeURIComponent(horaEntrada) + 
                 "&horaSalida=" + encodeURIComponent(horaSalida);
        }

        // Agrega los datos de día, mes y año a la URL si se seleccionó "Duplicado de Diploma"
        if (selectedValue === 'dupli_diploma.php') {
          url += "&dia=" + encodeURIComponent(dia) +
                 "&mes=" + encodeURIComponent(mes) +
                 "&año=" + encodeURIComponent(año);
        }

        // Agrega los datos de día, mes y motivo para permisos a la URL si se seleccionó "Permisos"
        if (selectedValue === 'permisos.php') {
          url += "&diaPermiso=" + encodeURIComponent(diaPermiso) +
                 "&mesPermiso=" + encodeURIComponent(mesPermiso) +
                 "&motivoPermiso=" + encodeURIComponent(motivoPermiso);
        }

        window.location.href = url;
      } else {
        alert("Por favor, seleccione un tipo de certificado del menú desplegable.");
      }
    });
  </script>
</body>
</html>






