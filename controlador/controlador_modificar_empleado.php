<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtid"]) and !empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtcargo"])) {
        $id=$_POST["txtid"];
        $nombre=$_POST["txtnombre"];
        $apellido=$_POST["txtapellido"];
        $cargo=$_POST["txtcargo"];
        $sql=$conexion->query(" update empleado set nombre='$nombre', apellido='$apellido', cargo=$cargo where id_empleado=$id");
        if ($sql==true) { ?>
            <script>
            $(function notificacion() {
                new PNotify({
                    title: "CORRECTO!",
                    type: "success",
                    text: "El Empleado Se A Modificado correctamente",
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
                    text: "El Empleado No Se A Modificado",
                    styling: "bootstrap3"
                })
            })
        </script>
        <?php }
        
    } else {  ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR!",
                    type: "error",
                    text: "Los Campos Estan Vacios",
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