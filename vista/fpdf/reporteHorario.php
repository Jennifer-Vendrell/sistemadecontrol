<?php

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      include '../../modelo/conexion.php'; // Incluimos la conexión a la base de datos

      $consulta_info = $conexion->query("SELECT * FROM escuela"); // Consultamos información de la escuela
      $dato_info = $consulta_info->fetch_object();

      $this->Image('../../public/img-inicio/logo_escuela.png', 270, 5, 20); // Logo de la escuela
      $this->SetFont('Arial', 'B', 19);
      $this->Cell(95);
      $this->SetTextColor(0, 0, 0);
      $this->Cell(110, 15, utf8_decode($dato_info->nombre_escuela), 0, 1, 'C', 0); // Nombre de la escuela
      $this->Ln(3);
      $this->SetTextColor(103);

      // Ubicación
      $this->Cell(85);
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Ubicación : " . $dato_info->ubicacion), 0, 0, '', 0);
      $this->Ln(5);

      // Teléfono
      $this->Cell(85);
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : " . $dato_info->telefono), 0, 0, '', 0);
      $this->Ln(5);

      // Título del reporte
      $this->Cell(85);
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE HORARIOS DE ALUMNOS"), 0, 1, 'C', 0);
      $this->Ln(7);

      // Encabezado de la tabla
      $this->SetFillColor(125, 173, 221);
      $this->SetTextColor(0, 0, 0);
      $this->SetDrawColor(163, 163, 163);
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(15, 10, utf8_decode('N°'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('Grado'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('Hora de Entrada'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('Hora de Salida'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15);
      $this->SetFont('Arial', 'I', 8);
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
      $this->SetY(-15);
      $this->SetFont('Arial', 'I', 8);
      $hoy = date('d/m/Y');
      $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C');
   }
}

include '../../modelo/conexion.php';

$pdf = new PDF();
$pdf->AddPage("landscape");
$pdf->AliasNbPages();

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163);

// Consulta de horarios de alumnos
$consulta_horarios = $conexion->query("SELECT alumno.nombre, alumno.apellido, alumno.grado, horario.hora_entrada, horario.hora_salida 
                                       FROM horario 
                                       INNER JOIN alumno ON horario.id_alumno = alumno.id_alumno");

while ($datos_horario = $consulta_horarios->fetch_object()) {
   $i = $i + 1;
   // Filas de la tabla
   $pdf->Cell(15, 10, utf8_decode($i), 1, 0, 'C', 0);
   $pdf->Cell(50, 10, utf8_decode($datos_horario->nombre . " " . $datos_horario->apellido), 1, 0, 'C', 0);
   $pdf->Cell(40, 10, utf8_decode($datos_horario->grado), 1, 0, 'C', 0);
   $pdf->Cell(40, 10, utf8_decode($datos_horario->hora_entrada), 1, 0, 'C', 0);
   $pdf->Cell(40, 10, utf8_decode($datos_horario->hora_salida), 1, 1, 'C', 0);
}

$pdf->Output('Reporte Horarios de Alumnos.pdf', 'I');
?>
