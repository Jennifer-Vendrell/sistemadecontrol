<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtnombre"])) {
        $nombre=$_POST["txtnombre"];
        $verificarNombre=$conexion->query(" select count(*) as 'total' from cargo where nombre='$nombre' ");
        if ($verificarNombre->fetch_object()->total > 0) { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR!",
                    type: "error",
                    text: "El Cargo <?= $nombre ?> Ya Existe",
                    styling: "bootstrap3"
                })
            })
        </script>
        <?php } else {
            $sql=$conexion->query(" insert into cargo(nombre)values('$nombre')");
            if ($sql==true) { ?>
            <script>
            $(function notificacion() {
                new PNotify({
                    title: "CORRECTO!",
                    type: "success",
                    text: "El Cargo Se Regsitro Correctamente",
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
                    text: "El Cargo  No Se Regsitro Correctamente",
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