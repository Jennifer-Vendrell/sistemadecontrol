<?php
if (!empty($_GET["id"])) {
    $id=$_GET["id"];
    $sql=$conexion->query(" delete from empleado where id_empleado=$id ");
    if ($sql==true) { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "CORRECTO!",
                    type: "success",
                    text: "Empleado Se A Eliminado Correctamente",
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
                    text: "Empleado No Se A Eliminado",
                    styling: "bootstrap3"
                })
            })
        </script>
    <?php } ?>

<script>
    setTimeout(() => {
        window.history.replaceState(null,null,window.location.pathname);
    }, 0);
</script>

<?php }
?>