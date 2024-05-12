<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtnombre"])) {
        $nombre=$_POST["txtnombre"];
        $id=$_POST["txtid"];
        $verificarNombre=$conexion->query(" select count(*) as 'total' from cargo where nombre='$nombre' and id_cargo!=$id ");
        if ($verificarNombre->fetch_assoc()->total > 0) { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR!",
                    type: "error",
                    text: "El Nombre <?= $nombre ?> Ya Existe",
                    styling: "bootstrap3"
                })
            })
        </script>
        <?php } else {
            $sql=$conexion->query(" update cargo set nombre='$nombre' where id_cargo=$id ");
            if ($sql == true) { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "CORRECTO!",
                    type: "success",
                    text: "Cargo Modificado Correctamente",
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
                    text: "Cargo  No Modificado Correctamente",
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
