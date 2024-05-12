<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
header('location:login/login.php');
}

?>
<style>
ul li:nth-child(2) .activo{
    background: rgb(11, 150, 214) !important;
}
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class="text-center text-secondary">REGISTRO DE ALUMNOS</h4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_registrar_horario.php"
    ?>

    <div class="row">
        <form action="" method="POST">
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="text" placeholder="alumno_id" class="input input__text" name="txtalumno_id">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="text" placeholder="dia_semana" class="input input__text" name="txtdia_semana">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="text" placeholder="hora_inicio" class="input input__text" name="txthora_inicio">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="text" placeholder="hora_fin" class="input input__text" name="txthora_fin">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="text" placeholder="clase" class="input input__text" name="txtclase">
            </div>
            <div class="text-right p-2">
                <a href="horario.php" class="btn btn-secondary btn-rounded">Atras</a>
                <button type="submit" value="ok" name="btnregistrar" class="btn btn-primary btn-rounded">Registrar</button>
            </div>
        </form>
    </div>
</div>
</div>

<!-- fin del contenido principal -->



<?php require('./layout/footer.php'); ?>