<?php
require('fpdf/fpdf.php'); 
include("connect.php");

// Obtiene el DNI
$dni = isset($_GET["dni"]) ? $_GET["dni"] : "";
$diaPermiso = isset($_GET["diaPermiso"]) ? $_GET["diaPermiso"] : "";
$mesPermiso = isset($_GET["mesPermiso"]) ? $_GET["mesPermiso"] : "";
$motivoPermiso = isset($_GET["motivoPermiso"]) ? $_GET["motivoPermiso"] : "";

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
        $this->Ln(15);
        $this->SetFont('Arial','',10);
        $this->Cell(200,40,utf8_decode('RESOLUCIONES DE APROBACIÒN Y MODIFICATORIAS NRO. 00527 DE ENERO 23 DE 2003'),0,0,'C');
        $this->Cell(-200,50,utf8_decode('RESOLUCIÓN 255226 DE DICIEMBRE 4 DE 2007 Y S 2019060153382 DE SEPTIEMBRE 11 DE 2019'),0,0,'C');

        //Contenido
        $this->Ln(2);
        $this->SetFont('Arial','B',12);
        $this->Cell(210,80,utf8_decode('RESOLUCIÓN NRO. 014'),0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','B',12);
        $this->Cell(210,100,utf8_decode('POR MEDIO DE LA CUAL SE CONCEDE PERMISO A UN(A) DOCENTE'),0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',10);
        $this->Cell(172,110,utf8_decode('El Rector de la Institución Educativa La Paz, en ejercicio de sus facultades legales y en'),0,0,'C');
        $this->SetFont('Arial','',10);
        $this->Cell(-168,120,utf8_decode('particular las conferídas por la ley 715 de diciembre 21 de 2001, artículo 10, numeral 10.7'),0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',10);
        $this->Cell(173,120,utf8_decode('en lo referido a la administración del personal asignado a la institución en lo relacionado'),0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',10);
        $this->Cell(92,120,utf8_decode('con las novedades y los permisos, y'),0,0,'C');
        $this->Ln(17);

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
    }
}

if (mysqli_num_rows($consulta) > 0){
    $fila = mysqli_fetch_row($consulta);
    $name = $fila[1];
    $second_name = $fila[2];
    $apell = $fila[3];
    $second_apell = $fila[4];
    $fechaActual = date("d/m/Y"); // Formato día/mes/año

    // Crea la instancia de la clase PDF 
    $pdf = new PDF(); 
    $pdf->AliasNbPages();
    $pdf->AddPage(); // Solo una llamada a AddPage
    $pdf->SetFont('Times','',12);

    // Continuar agregando contenido al PDF
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(160,110,utf8_decode('Que el(la) Docente '.$name." ".$second_name." ".$apell." ".$second_apell.' solicitó permiso para ausentarse de'),0,0,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(-128,120,utf8_decode('sus actividades curriculares el dia '.$diaPermiso." de ".$mesPermiso.' del presente, con el fin de asistir a '.$motivoPermiso),0,0,'C');
    $pdf->Ln(25);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(210,100,utf8_decode('RESUELVE'),0,0,'C');
    $pdf->Ln(5);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(160,110,utf8_decode('ARTICULO PRIMERO: Conceder permiso a la Docente '.$name." ".$second_name." ".$apell." ".$second_apell),0,0,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(-166,120,utf8_decode('para el dia '.$diaPermiso." de ".$mesPermiso.' del presente año, por los motivos antes expuestos.'),0,0,'C');
    $pdf->Ln(5);
    $pdf->Cell(99,120,utf8_decode('Bachiller Académico el  Acta General No.'),0,0,'C');
    $pdf->Ln(5);
    $pdf->Cell(74,120,utf8_decode('043. Folio No. Orden 023'),0,0,'C');
    $pdf->Ln(20);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(210,100,utf8_decode('COMUNÍQUESE Y CÚMPLASE'),0,0,'C');
    $pdf->Ln(5);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(210,110,utf8_decode('Dada en la Ceja, el '.$fechaActual),0,0,'C');
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(-210,120,utf8_decode('(26/09/2024)'),0,0,'C');
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