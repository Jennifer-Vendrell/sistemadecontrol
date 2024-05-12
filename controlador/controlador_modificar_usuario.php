<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtusuario"])) {
        $nombre = $_POST["txtnombre"];
        $apellido = $_POST["txtapellido"];
        $usuario = $_POST["txtusuario"];
        $id = $_POST["txtid"];
        $sql = $conexion->query(" SELECT count(*) as 'total' from usuario where usuario='$usuario' and id_usuario!=$id "); 

        if ($sql->fetch_object()->total > 0) { ?>
            <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR!",
                    type: "error",
                    text: "El Usuario <?= $usuario ?> Ya Existe",
                    styling: "bootstrap3"
                })
            })
        </script>
        <?php } else {
            $modificar=$conexion->query(" update usuario set nombre='$nombre', apellido='$apellido', usuario='$usuario' where id_usuario");
            if ($modificar==true) { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "CORRECTO",
                    type: "success",
                    text: "El Usuario Se Ha Modificado Correctamente",
                    styling: "bootstrap3"
                })
            })
        </script>
            '<?php } else { ?>
                <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR!",
                    type: "error",
                    text: "Error Al Modificar Usuario",
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