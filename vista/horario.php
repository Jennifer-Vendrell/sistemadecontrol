<?php
session_start();
if (empty($_SESSION['nombre']) && empty($_SESSION['apellido'])) {
    header('location:login/login.php');
}
?>

<style>
    ul li:nth-child(2) .activo {
        background: rgb(11, 150, 214) !important;
    }
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

   <!-- Agrega el formulario de búsqueda aquí -->
   <h2 class="text-center text-secondary mt-3">Buscar Horario</h2>
    <form action="buscar_horario.php" method="post" class="mb-3">
        <div class="form-group">
            <label for="txtalumno_id">ID del Alumno:</label>
            <input type="text" id="txtalumno_id" name="txtalumno_id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    
    <?php 
    // Tu código existente para mostrar la lista de horarios de los alumnos
    ?>



    <h4 class="text-center text-secondary">LISTA DE HORARIOS DE ALUMNOS</h4>

    <?php 
    include "../modelo/conexion.php";
    include "../controlador/controlador_registrar_horario.php";
    

    // Consulta SQL para seleccionar los horarios de los alumnos
    $sql = $conexion->query("SELECT * FROM horario");

    ?>
    <a href="registro_horario.php" class="btn btn-primary btn-rounded mb-3"><i class="fa-solid fa-plus"></i> &nbsp;Registrar Horario</a>
    <div class="text-right mb-2">
        <a href="fpdf/reporteHorarios.php" target="_blank" class="btn btn-primary"><i class="far fa-file-pdf"></i> Generar Reporte </a>
    </div>
    <table class="table table-bordered table-hover w-100" id="example">
        <thead>
            <tr>
                <th scope="col">alumno_id</th>
                <th scope="col">dia_semana</th>
                <th scope="col">hora_inicio</th>
                <th scope="col">hora_fin</th>
                <th scope="col">clase</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($datos = $sql->fetch_object()) { ?>
                <tr>
                    <td><?= $datos->alumno_id ?></td>
                    <td><?= $datos->dia_semana ?></td>
                    <td><?= $datos->hora_inicio ?></td>
                    <td><?= $datos->hora_fin ?></td>
                    <td><?= $datos->clase ?></td>
                    <td>
                        <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->alumno_id ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="horario.php?id=<?= $datos->alumno_id ?>" onclick="advertencia(event)" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal<?= $datos->alumno_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $datos->alumno_id ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-flex justify-content-between">
                                <h5 class="modal-title w-100" id="exampleModalLabel<?= $datos->alumno_id ?>">Modificar Horario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="modificar_horario.php" method="POST">
                                    <div hidden class="fl-flex-label mb-4 px-2 col-12 ">
                                        <input type="text" placeholder="alumno_id" class="input input__text" name="txtid" value="<?= $datos->alumno_id ?>">
                                    </div>
                                    <div class="fl-flex-label mb-4 px-2 col-12 ">
                                        <input type="text" placeholder="dia_semana" class="input input__text" name="txtnombre" value="<?= $datos->dia_semana ?>">
                                    </div>
                                    <div class="fl-flex-label mb-4 px-2 col-12 ">
                                        <input type="text" placeholder="hora_inicio" class="input input__text" name="txtcurso" value="<?= $datos->hora_inicio ?>">
                                    </div>
                                    <div class="fl-flex-label mb-4 px-2 col-12 ">
                                        <input type="time" placeholder="Hora_fin" class="input input__text" name="txthora_inicio" value="<?= $datos->hora_fin ?>">
                                    </div>
                                    <div class="fl-flex-label mb-4 px-2 col-12 ">
                                        <input type="time" placeholder="clase" class="input input__text" name="txthora_fin" value="<?= $datos->clase ?>">
                                    </div>
                                    <div class="text-right p-2">
                                        <a href="usuario.php" class="btn btn-secondary btn-rounded">Atras</a>
                                        <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Modificar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </tbody>
    </table>

</div>
</div>

<!-- fin del contenido principal -->
<?php require('./layout/footer.php'); ?>