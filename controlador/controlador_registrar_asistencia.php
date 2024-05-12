<?php
if (!empty($_POST["btnentrada"])) {
    if (!empty($_POST["txtdni"])) {
        $dni = $_POST["txtdni"];
        $consulta = $conexion->query("SELECT count(*) as 'total', id_empleado FROM empleado WHERE dni='$dni'");
        $empleado = $consulta->fetch_assoc();

        if ($empleado['total'] > 0) {
            date_default_timezone_set('America/Mexico_City');
            $fecha = date("Y-m-d");

            // Verificar si ya registró entrada hoy
            $consultaFecha = $conexion->query("SELECT entrada FROM asistencia WHERE id_empleado={$empleado['id_empleado']} AND DATE(entrada) = '$fecha'");
            $entradaHoy = $consultaFecha->fetch_assoc();

            if ($entradaHoy) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "ERROR!",
                            type: "error",
                            text: "Ya has registrado tu entrada hoy",
                            styling: "bootstrap3"
                        })
                    })
                </script>
            <?php } else {
                $sql = $conexion->query("INSERT INTO asistencia(id_empleado, entrada) VALUES ({$empleado['id_empleado']}, NOW())");
                if ($sql) { ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "CORRECTO!",
                                type: "success",
                                text: "¡Hola, bienvenido al ITTUX!",
                                styling: "bootstrap3"
                            })
                        })
                    </script>
                <?php } else { ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "ERROR!",
                                type: "error",
                                text: "Error al registrar entrada",
                                styling: "bootstrap3"
                            })
                        })
                    </script>
                <?php }
            }
        } else { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR!",
                        type: "error",
                        text: "El número de control no existe",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php }
    } else { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR!",
                    type: "error",
                    text: "Ingrese su número de control",
                    styling: "bootstrap3"
                })
            })
        </script>
    <?php } ?>

    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>
<?php } ?>



<!--Registro de Salida-->


<?php
if (!empty($_POST["btnsalida"])) {
    if (!empty($_POST["txtdni"])) {
        $dni = $_POST["txtdni"];
        $consulta = $conexion->query("SELECT count(*) as 'total', id_empleado FROM empleado WHERE dni='$dni'");
        $resultadoConsulta = $consulta->fetch_assoc();

        if ($resultadoConsulta['total'] > 0) {
            $id_empleado = $resultadoConsulta['id_empleado'];
            echo date_default_timezone_set('America/Mexico_City');
            $fecha = date("Y-m-d H:i:s");

            // Buscar la última entrada del empleado
            $busqueda = $conexion->query("SELECT id_asistencia, entrada FROM asistencia WHERE id_empleado=$id_empleado ORDER BY id_asistencia DESC LIMIT 1");

            if ($busqueda->num_rows > 0) {
                $datos = $busqueda->fetch_object();
                $id_asistencia = $datos->id_asistencia;
                $entradaBD = $datos->entrada;

                // Verificar si ya registró salida hoy
                if (substr($entradaBD, 0, 10) != date("Y-m-d")) {
                    ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "ERROR!",
                                type: "error",
                                text: "Primero debes registrar tu entrada",
                                styling: "bootstrap3"
                            })
                        })
                    </script>
                    <?php
                } else {
                    // Verificar si ya se registró la salida hoy
                    $consultaSalida = $conexion->query("SELECT COUNT(*) as 'salida_registrada' FROM asistencia WHERE id_empleado=$id_empleado AND DATE(salida) = CURDATE()");
                    $resultadoSalida = $consultaSalida->fetch_assoc();

                    if ($resultadoSalida['salida_registrada'] > 0) {
                        ?>
                        <script>
                            $(function notificacion() {
                                new PNotify({
                                    title: "ERROR!",
                                    type: "error",
                                    text: "Ya has registrado tu salida hoy",
                                    styling: "bootstrap3"
                                })
                            })
                        </script>
                        <?php
                    } else {
                        // Actualizar la salida del empleado
                        $sql = $conexion->query("UPDATE asistencia SET salida='$fecha' WHERE id_asistencia=$id_asistencia");

                        if ($sql) {
                            ?>
                            <script>
                                $(function notificacion() {
                                    new PNotify({
                                        title: "CORRECTO!",
                                        type: "success",
                                        text: "¡Adiós, vuelve pronto al ITTUX!",
                                        styling: "bootstrap3"
                                    })
                                })
                            </script>
                            <?php
                        } else {
                            ?>
                            <script>
                                $(function notificacion() {
                                    new PNotify({
                                        title: "ERROR!",
                                        type: "error",
                                        text: "Error al registrar la salida",
                                        styling: "bootstrap3"
                                    })
                                })
                            </script>
                            <?php
                        }
                    }
                }
            } else {
                ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "ERROR!",
                            type: "error",
                            text: "Primero debes registrar tu entrada",
                            styling: "bootstrap3"
                        })
                    })
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR!",
                        type: "error",
                        text: "El número de control no existe",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR!",
                    type: "error",
                    text: "Ingrese su número de control",
                    styling: "bootstrap3"
                })
            })
        </script>
        <?php
    }
}
?>

<script>
    setTimeout(() => {
        window.history.replaceState(null, null, window.location.pathname);
    }, 0);
</script>

