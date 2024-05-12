<?php

$conexion=new mysqli("localhost", "root", "", "sis_asistencia", "3306");
$conexion->set_charset("utf8");
// Verificar si se ha enviado el formulario
if(isset($_POST['txtalumno_id'])) {
    // Obtener el ID del alumno enviado por el formulario
    $alumno_id = $_POST['txtalumno_id'];

    // Consulta SQL para obtener el horario del alumno con el ID proporcionado
    $sql = "SELECT * FROM horario WHERE alumno_id = '$alumno_id'";
    $resultado = $conexion->query($sql);
    

    // Verificar si se encontraron resultados
    if ($resultado->num_rows > 0) {
        echo "<h2>Horario del Alumno ID: $alumno_id</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Día de la Semana</th>
                    <th>Hora de Inicio</th>
                    <th>Hora de Fin</th>
                    <th>Clase</th>
                </tr>";
        // Mostrar los resultados en una tabla
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['dia_semana'] . "</td>";
            echo "<td>" . $fila['hora_inicio'] . "</td>";
            echo "<td>" . $fila['hora_fin'] . "</td>";
            echo "<td>" . $fila['clase'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontró ningún horario para el alumno con ID: $alumno_id";
    }
}
?>
