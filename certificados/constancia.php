<?php
require('fpdf/fpdf.php'); 
include("connect.php");

// Obtiene el DNI, la hora de entrada y la hora de salida de la URL
// Obtiene el DNI y los datos adicionales de la URL
$dni = isset($_GET["dni"]) ? $_GET["dni"] : "";
$primerNombre = isset($_GET["primerNombre"]) ? $_GET["primerNombre"] : "";
$segundoNombre = isset($_GET["segundoNombre"]) ? $_GET["segundoNombre"] : "";
$primerApellido = isset($_GET["primerApellido"]) ? $_GET["primerApellido"] : "";
$segundoApellido = isset($_GET["segundoApellido"]) ? $_GET["segundoApellido"] : "";
$periodo = isset($_GET["periodo"]) ? $_GET["periodo"] : ""; // Obtener el periodo si se envió
$horaEntrada = isset($_GET["horaEntrada"]) ? $_GET["horaEntrada"] : "";
$horaSalida = isset($_GET["horaSalida"]) ? $_GET["horaSalida"] : "";

$dni = mysqli_real_escape_string($connect, $dni); 

// Consulta SQL con el DNI escapado
$consulta = mysqli_query($connect, "SELECT * FROM user WHERE dni='$dni'") or die("Problemas en el select:".mysqli_error($connect));

// Define la clase PDF ANTES de instanciarla
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('imagen/escudo-removebg-preview (2).png',10,8,33);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(50,15,utf8_decode('INSTITUCIÓN EDUCATIVA LA PAZ'),0,0,'C');
        $this->SetFont('Arial','B',12);
        $this->Ln(5);
        $this->Cell(210,30,'NIT 811.039.784-7',0,0,'C');
        $this->Ln(8);
        $this->SetFont('Arial','',9);
        //Contenido
        $this->Cell(200,40,utf8_decode('RESOLUCIONES DE APROBACIÒN Y MODIFICATORIAS NRO. 00527 DE ENERO 23 DE 2003'),0,0,'C');
        $this->Cell(-200,50,utf8_decode('RESOLUCIÒN 255226 DE DICIEMBRE 4 DE 2007 Y S 2019060153382 DE SEPTIEMBRE 11 DE'),0,0,'C');
        $this->Ln(5);
        $this->Cell(200,50,'2019.',0,0,'C');
        $this->SetFont('Arial','',9);
           
        $this->SetFont('Arial','B',13);
        
        $this->Ln(35);
        $this->SetFont('Arial','B',12);
        $this->Cell(210,50,utf8_decode('LA AUXILIAR ADMINISTRATIVA DE LA INSTITUCIÒN EDUCATIVA LA PAZ'),0,0,'C');
        $this->Ln(8);
        $this->SetFont('Arial','B',12);
        $this->Cell(210,50,utf8_decode('DEL MUNICIPIO DE LA CEJA ANTIOQUIA'),0,0,'C');
        $this->Ln(25);
        // Salto de línea
        $this->Ln(10);
    }
    
    
    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
    }
}

if (mysqli_num_rows($consulta) > 0){
    $fila = mysqli_fetch_row($consulta);
    $name = $fila[1];
    $second_name = $fila[2];
    $apell = $fila[3];
    $second_apell = $fila[4];

    // Crea la instancia de la clase PDF 
    $pdf = new PDF(); 
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);

    // Format the time with AM/PM
    $horaEntradaFormateada = date("h:i A", strtotime($horaEntrada));
    $horaSalidaFormateada = date("h:i A", strtotime($horaSalida));

    $fechaActual = date("d/m/Y"); // Formato día/mes/año

    //$pdf->Cell() y las variables sin problemas
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(210,50,utf8_decode('HACE CONSTAR'),0,0,'C');
    $pdf->Ln(15);
    $pdf->SetFont('Arial','',13);
    $pdf->Cell(180,50,utf8_decode('Que '.$primerNombre. " ".$segundoNombre." ".$primerApellido." ".$segundoApellido.' estuvo en la institución con el fin de '),0,0,'C');
    $pdf->Ln(6);
    $pdf->SetFont('Arial','',13);
    $pdf->Cell(176,50,utf8_decode('reclamar el '.$periodo.' informe académico de su hij@ '.$name." ".$second_name." ".$apell." ".$second_apell),0,0,'C');
    $pdf->Ln(40);
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(90,20,utf8_decode('HORA DE ENTRADA: '. $horaEntradaFormateada),0,0,'C');
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(-93,50,utf8_decode('HORA DE SALIDA: '. $horaSalidaFormateada),0,0,'C');
    $pdf->SetFont('Arial','',11);
    $pdf->Ln(30);
    $pdf->Cell(90,50,utf8_decode('Dado en La Ceja, el '.$fechaActual),0,0,'C');
    $pdf->Ln(40);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(90,20,utf8_decode('LUZ DARY ALZATE HENAO'),0,0,'C');
    $pdf->Ln(7);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(74,20,utf8_decode('Auxiliar Administrativa'),0,0,'C');
    $pdf->SetFont('Arial','',9);
    $pdf->Output(); 
} else {
    echo "No se encontraron resultados para el DNI proporcionado.";
}

?>
