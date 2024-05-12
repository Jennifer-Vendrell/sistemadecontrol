<?php

if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtcargo"])) {
        $nombre = $_POST["txtnombre"];
        $apellido = $_POST["txtapellido"];
        $cargo = $_POST["txtcargo"];
        $sql=$conexion->query(" insert into empleado(nombre,apellido,cargo) values('$nombre', '$apellido', $cargo)");
        if ($sql==true) { ?>
            <script>
            $(function notificacion() {
                new PNotify({ 
                    title: "CORRECTO!",
                    type: "success",
                    text: "Empleado regsitrado correctamente",
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
                    text: "Empleado  NO Regsitrado",
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