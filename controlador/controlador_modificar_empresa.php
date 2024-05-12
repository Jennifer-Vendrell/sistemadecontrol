<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtid"])) {
        $id=$_POST["txtid"];
        $nombre=$_POST["txtnombre"];
        $telefono=$_POST["txttelefono"];
        $ubicacion=$_POST["txtubicacion"];
        $ruc=$_POST["txtruc"];
        $sql=$conexion->query("UPDATE empresa SET nombre='$nombre', telefono='$telefono', ubicacion='$ubicacion', ruc='$ruc' WHERE id_empresa=$id ");
        if ($sql) { ?>
            <script>
                $(document).ready(function() {
                    new PNotify({
                        title: "CORRECTO!",
                        type: "success",
                        text: "Se Ha Modificado Correctamente",
                        styling: "bootstrap3"
                    });
                });
            </script>
        <?php } else { ?>
            <script>
                $(document).ready(function() {
                    new PNotify({
                        title: "ERROR!",
                        type: "error",
                        text: "Error al Modificar los datos",
                        styling: "bootstrap3"
                    });
                });
            </script>
        <?php }
        
    } else { ?>
        <script>
            $(document).ready(function() {
                new PNotify({
                    title: "ERROR!",
                    type: "error",
                    text: "No Se Ha Enviado El Identificador",
                    styling: "bootstrap3"
                });
            });
        </script>
    <?php } ?>
    
    <script>
        setTimeout(() => {
            window.history.replaceState(null,null,window.location.pathname);
        }, 0);
    </script>

<?php }
?>
