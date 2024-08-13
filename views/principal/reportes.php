<?php
require 'views/header.php';

date_default_timezone_set('America/Guayaquil');
$current= date("Y-m-01");

$currentDateTime = date("Y-m-d");
?>

<div class="col-xs-12">
    <div class="box-content bordered ">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <input id="fecha_ini" type="date" class="form-control" value="<?php echo $current ?>">
                </div>
                <div class="col-3">
                    <input id="fecha_fin" type="date" class="form-control" value="<?php echo $currentDateTime ?>">
                </div>
                <div class="col-3">
                    <button onclick="Cargar_Consultas()" class="btn btn-primary">Cargar</button>
                </div>
               
                <div class="col-12 pt-3">
                    <div class="table-responsive">
                        <table id="Tabla_reporte" style="width: 100%; font-size: 14px; font-weight: bold;" class="table-hover table-bordered table-striped">

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src='funciones/functions.js'></script>
<?php require 'views/footer.php'; ?>
<?php require 'funciones/reportes_js.php'; ?>