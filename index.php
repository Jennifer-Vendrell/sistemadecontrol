
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Bienvenida</title>
    <link rel="stylesheet" href="public/estilos/estilos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">

    <!-- pNotify -->
    <link href="public/pnotify/css/pnotify.css" rel="stylesheet" />
    <link href="public/pnotify/css/pnotify.buttons.css" rel="stylesheet" />
    <link href="public/pnotify/css/custom.min.css" rel="stylesheet" />

    <!-- pnotify -->
    <script src="public/pnotify/js/jquery.min.js">
    </script>
    <script src="public/pnotify/js/pnotify.js">
    </script>
    <script src="public/pnotify/js/pnotify.buttons.js">
    </script>

</head>
<body>
    <h1>BIENVENIDOS Al INSTITUTO TÉCNOLOGICO DE TUXTEPEC</h1>
    <h2 id="fecha"></h2>
    <?php
    include "modelo/conexion.php";
    include "controlador/controlador_registrar_asistencia.php";
    ?>
    <div class="container">
        <a class="acceso" href="vista/login/login.php">Ingresar al Sistema</a>
        <p class="num_control">Ingrese su Numero de Control</p>
        <form action="" method="POST">
            <input type="number" placeholder="20350250" name="txtdni" id="txtdni">
            <div class="botones">
            
                <button id="entrada" class="entrada" type="submit" name="btnentrada" value="ok">Entrada</button>
                <button id="salida" class="salida" type="submit" name="btnsalida" value="ok">Sálida</button>
            </div>
        </form>
    </div>

    <script>
        setInterval(() => {
            let fecha = new Date();
            let fechaHora = fecha.toLocaleString();
            document.getElementById("fecha").textContent = fechaHora;
        }, 1000);
    </script>

    <script>
        let dni = document.getElementById("txtdni");
        dni.addEventListener("input", function() {
            if (this.value.length > 8) {
                this.value = this.value.slice(8,8)
            }
        })


        //Eventos para la entrada y salida con teclas//


        document.addEventListener("keyup", function(event){
            if (event.code == "ArrowLeft") {
                document.getElementById("entrada").click()
            } else {
                if (event.code == "ArrowRight") {
                    document.getElementById("salida").click()
                }
            }
        })

    </script>
</body>
</html>
