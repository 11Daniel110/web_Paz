<?php
require('fpdf/fpdf.php'); 
include("connect.php");

// Obtiene el DNI
$dni = isset($_GET["dni"]) ? $_GET["dni"] : "";
$dia = isset($_GET["dia"]) ? $_GET["dia"] : "";
$mes = isset($_GET["mes"]) ? $_GET["mes"] : "";
$año = isset($_GET["año"]) ? $_GET["año"] : "";

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
        $this->Cell(-50,30,'NIT 811.039.784-7',0,0,'C');
        $this->SetFont('Arial','',10);
        $this->Cell(50,40,utf8_decode('Resolución y aprobacion y modificatorias N°.00527 de enero 23 de 2003'),0,0,'C');
        $this->Cell(-50,50,'25226 de diciembre 4 de 2007 y S 2019060153382 de septiembre 11 de 2019',0,0,'C');
        $this->SetFont('Arial','B',13);
        $this->Cell(50,60,utf8_decode('NÚCLEO EDUCATIVO 619'),0,0,'C');
        $this->SetFont('Arial','',10);
        $this->Cell(-50,70,'La Ceja del Tambo',0,0,'C');
        //Contenido
        $this->Ln(15);
        $this->SetFont('Arial','B',12);
        $this->Cell(210,80,utf8_decode('RESOLUCIÓN NRO 001'),0,0,'C');
        $this->SetFont('Arial','B',10);
        $this->Cell(-210,90,utf8_decode('(26 de septiembre 2024)'),0,0,'C');
        $this->Ln(15);
        $this->SetFont('Arial','B',12);
        $this->Cell(210,100,utf8_decode('POR MEDIO DE LA CUAL SE AUTORIZA UN DUPLICADO DE DIPLOMA'),0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',10);
        $this->Cell(0,110,utf8_decode('El Rector de la Institución Educativa La Paz, en ejercicio de sus facultades legales y'),0,0,'C');
        $this->SetFont('Arial','',10);
        $this->Cell(-240,120,utf8_decode('estatutarias conferidas en el Decreto 180 de 1981, y'),0,0,'C');
        $this->Ln(20);

        // Continuar el contenido en la misma página
        $this->SetFont('Arial','B',12);
        $this->Cell(210,100,utf8_decode('CONSIDERANDO'),0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',10);
    }
    
    
    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',11);
        $this->Cell(0,10,utf8_decode('CALLE 19 N°.17-49 TELÉFONO: 44487 18 LA CEJA - ANT '),1,0,'C');
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
    $pdf->AddPage(); // Solo una llamada a AddPage
    $pdf->SetFont('Times','',12);

    // Continuar agregando contenido al PDF
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(160,110,utf8_decode('Que el señor(a) '.$name." ".$second_name." ".$apell." ".$second_apell.' solicitó en secretaria de la'),0,0,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(-126,120,utf8_decode('institución educativa La Paz, se le expidiera copia del diploma de Bachiller Académico'),0,0,'C');
    $pdf->Ln(25);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(210,100,utf8_decode('RESUELVE'),0,0,'C');
    $pdf->Ln(5);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(0,110,utf8_decode('ARTICULO PRIMERO: Expedir duplicado del diploma de bachiller Ácademico al señor'),0,0,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(-194,120,utf8_decode($name." ".$second_name." ".$apell." ".$second_apell.' ,egresado de la institución y a quién se le ótorgo el título de'),0,0,'C');
    $pdf->Ln(5);
    $pdf->Cell(165,120,utf8_decode('Bachiller Académico el '.$dia.' de '.$mes.' del año '.$año.'. Acta General No.'),0,0,'C');
    $pdf->Ln(5);
    $pdf->Cell(94,120,utf8_decode('043. Folio No. Orden 023'),0,0,'C');
    $pdf->Ln(20);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(210,100,utf8_decode('COMUNÍQUESE Y CÚMPLASE'),0,0,'C');
    $pdf->Ln(5);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(0,110,utf8_decode('Dada en la Ceja, a los veintiseís dias del mes de septiembre de dos mil veinticuatro'),0,0,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(-302,120,utf8_decode('(26/09/2024)'),0,0,'C');
    $pdf->Ln(25);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(210,100,utf8_decode('RUBEN DARIO CARDONA RIOS'),0,0,'C');
    $pdf->Ln(5);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(210,110,utf8_decode('Rector'),0,0,'C');
    $pdf->Output(); 
} else {
    echo "No se encontraron resultados para el DNI proporcionado.";
}

?>
