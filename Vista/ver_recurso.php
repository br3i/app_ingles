<?php
include_once '../Config/conexion.php';

// Verificar si se ha enviado el formulario de selección de video
if(isset($_POST['video_select'])){
    $selected_video_id = $_POST['video_select'];

    // Realizar una nueva consulta para obtener el video seleccionado
    $selected_query = mysqli_query($con, "SELECT * FROM `recursos` WHERE `id_recurso` = '$selected_video_id'") or die(mysqli_error($con));
    $selected_video = mysqli_fetch_array($selected_query);
}

// Realizar consulta para obtener los videos de la base de datos
$query = mysqli_query($con, "SELECT * FROM `recursos` ORDER BY `id_recurso` ASC") or die(mysqli_error($con));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Detectar cuando se presiona la tecla "Volver"
            $(document).keydown(function(event) {
                if (event.keyCode == 8) {
                    event.preventDefault(); // Prevenir el comportamiento predeterminado de la tecla "Volver"

                    // Redirigir a la página anterior
                    window.location.href = 'panel.php?modulo=recursos';
                }
            });
        });
    </script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <a href="panel.php?modulo=recursos" class="btn btn-primary">Volver</a>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 well">
            <h3 class="text-primary">Videos Disponibles</h3>
            <hr style="border-top:1px dotted #ccc;"/>
            <?php
            // Verificar si se ha enviado el formulario de selección de video
            if(isset($_POST['video_select'])){
                $selected_video_id = $_POST['video_select'];

                // Realizar una nueva consulta para obtener el video seleccionado
                $selected_query = mysqli_query($con, "SELECT * FROM `recursos` WHERE `id_recurso` = '$selected_video_id'") or die(mysqli_error($con));
                $selected_video = mysqli_fetch_array($selected_query);

                // Mostrar el video seleccionado
                if($selected_video){
                    echo '<div class="row">';
                    echo '    <div class="col-md-4" style="word-wrap:break-word;">';
                    echo '        <br />';
                    echo '        <h4>Nombre del Video:</h4>';
                    echo '        <h5 class="text-primary">'.$selected_video['recurso_name'].'</h5>';
                    echo '        <br />';
                    echo '        <h4>Descripcion:</h4>';
                    echo '        <h5 class="text-primary">'.$selected_video['descripcion'].'</h5>';
                    echo '    </div>';
                    echo '    <div class="col-md-8">';
                    echo '        <video width="100%" height="240" controls>';
                    echo '            <source src="'.$selected_video['location'].'">';
                    echo '        </video>';
                    echo '    </div>';
                    echo '</div>';
                    echo '<br>';
                    echo '<hr style="border-top:1px groovy #000;"/>';
                }
            }
            ?>

            <!-- Mostrar la lista de videos -->
            <?php
            // Realizar consulta para obtener los videos de la base de datos
            $query = mysqli_query($con, "SELECT * FROM `recursos` ORDER BY `id_recurso` ASC") or die(mysqli_error($con));
            ?>

            <div class="col-md-12">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="video_select">Seleccionar video:</label>
                        <select class="form-control" name="video_select" id="video_select">
                            <?php
                            while($fetch = mysqli_fetch_array($query)){
                                echo '<option value="'.$fetch['id_recurso'].'">'.$fetch['recurso_name'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cargar video seleccionado</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="form_modal" aria-hidden="true">
    <div class="modal-dialog">
        <form action="save_video.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Archivo de Video</label>
                            <input type="file" name="video" class="form-control-file"/>
                        </div>


                        <div class="form-group">
                            <label >Descripción</label>
                            <input type="text" name="descripcion" class="form-control-file"/>
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
                    <button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>