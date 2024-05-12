<?php

if (!empty($_POST["btnregistra"])) {
    if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtusuario"]) and !empty($_POST["txtpassword"])) {
        $nombre = $_POST["txtnombre"];
        $apellido = $_POST["txtapellido"];
        $usuario = $_POST["txtusuario"];
        $password = md5($_POST["txtpassword"]);

        $sql=$conexion->query(" SELECT count(*) as 'total' from usuario where usuario='$usuario' ");
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
            $registro=$conexion->query(" insert into usuario(nombre,apellido,usuario,password)values('$nombre', '$apellido', '$usuario', '$password')");
            if ($registro==true) { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "CORRECTO",
                    type: "success",
                    text: "El Usuario Se Ha Registrado Correctamente",
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
                    text: "Error Al Registrar Usuario",
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
