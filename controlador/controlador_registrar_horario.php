<?php

if (!empty($_POST["btnregistra"])) {
    if (!empty($_POST["txtalumno_id"]) and !empty($_POST["txtdia_semana"]) and !empty($_POST["txthora_inicio"]) and !empty($_POST["txthora_fin"]) and !empty($_POST["txtclase"])) {
        $nombre = $_POST["txtalumno_id"];
        $apellido = $_POST["txtdia_semana"];
        $usuario = $_POST["txthora_inicio"];
        $usuario = $_POST["txthora_fin"];
        $password = md5($_POST["txtclase"]);

        $sql=$conexion->query(" SELECT count(*) as 'total' from horario where horario='$horario' ");
        if ($sql->fetch_object()->total > 0) { ?>
        <script>
            $(function notificacion() { 
                new PNotify({
                    title: "ERROR!",
                    type: "error",
                    text: "horario <?= $horario ?> Ya Existe",
                    styling: "bootstrap3"
                })
            })
        </script>
            <?php } else {
            $registro=$conexion->query(" insert into horario(alumno_id,dia_semana,hora_inicio,hora_fin,clase)values('$alumno_id', '$dia_semana', '$hora_inicio', '$hora_fin','$clase')");
            if ($registro==true) { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "CORRECTO",
                    type: "success",
                    text: "el horario Se Ha Registrado Correctamente",
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
                    text: "Error Al Registrar horario",
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
