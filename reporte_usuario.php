<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    //COLORES
    //$this->SetDrawColor(0,80,180);
    //$this->SetFillColor(230,230,0);
    //$this->SetTextColor(220,50,50);
    // Logo
   // $this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'Reporte de Usuarios',0,0,'C');
    // Salto de línea
    $this->Ln(20);
    // posicion de la cabezera
    $this->setX(15);
     // color de fondo de las celdas
    $this->SetFillColor(233,229,235);
    $this->Cell(20, 8, 'id_usuario', 1, 0, 'C',1);
    $this->Cell(40, 8, 'Nombres', 1, 0, 'C',0);
    $this->Cell(40, 8, 'Apellidos', 1, 0, 'C',0);
    $this->Cell(40, 8, 'Email', 1, 0, 'C',0);
    $this->Cell(40, 8, 'Password', 1, 1, 'C',0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

include 'conexionbd.php';
$conexbd=conectar();
$sql="SELECT * FROM usuario";
$sentencia = $conexbd->query($sql);
$usuario = $sentencia->fetch_all(MYSQLI_ASSOC);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
// $pdf->Cell(40,10,utf8_decode('¡Hola, Mundo!'));
    // color de fondo de las celdas
    $pdf->SetFillColor(233,229,235);
    foreach ($usuario as $row)  {
        $pdf->setX(15);
    $pdf->Cell(20, 5, $row["id_usuario"], 1, 0, 'C',1);
    $pdf->Cell(40, 5, $row["nombres"], 1, 0, 'D',0);
    $pdf->Cell(40, 5, $row["apellidos"], 1, 0, 'D',0);
    $pdf->Cell(40, 5, $row["email"], 1, 0, 'D',0);
    $pdf->Cell(40, 5, $row["contrasena"], 1, 1, 'D',0);
}

$pdf->Output();
?>