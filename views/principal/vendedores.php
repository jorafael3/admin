<?php



require 'views/header.php';
require 'funciones/topvendedoresnacionaljs.php';

?>
<div class="row small-spacing">
    <div class="col-lg-12 col-md-12 col-xs-12 bg-white" style="margin-bottom: 20px;">
        <h2>Top Vendedores a nivel nacional</h2>
    </div><br>
<hr>
    <h3 id="TablaFechaD" class="box-title"></h3>
    <div class="col-lg-12 col-md-12 col-xs-12" style="display: none; margin-top: 20px;" id="cardtop1">
        <div class="box-content bordered warning bak">
            <div class="statistics-box with-icon">
                <i class="text-warning ico fas fa-medal"></i>
                <h2 id="Top1text" class="text-warning font-weight-bolder"></h2>
                <h4 id="SucTop1">asd</h4>
                <h5>Calificacion</h5>
                <h3 id="Top1val" class="counter"></h3>
                <h5>Venta</h5>
                <h4 id="Top1venta" class="counter"></h4>
            </div>
        </div>
        <!-- /.box-content -->
    </div>
    <div class="col-lg-12 col-md-12 col-xs-12" style="display: none;" id="cardtop2">
        <div class="box-content bordered silver">
            <div class="statistics-box with-icon">
                <i class="text-silver ico fas fa-medal"></i>
                <h2 id="Toptext2" class="font-weight-bolder"></h2>
                <h4 id="SucTop2">asd</h4>

                <h5>Calificacion</h5>

                <h3 id="Topval2" class="counter"></h3>
                <h5>Venta</h5>
                <h4 id="Top2venta" class="counter"></h4>
            </div>
        </div>
        <!-- /.box-content -->
    </div>
    <div class="col-lg-12 col-md-12 col-xs-12" style="display: none;" id="cardtop3">
        <div class="box-content bordered bronze">
            <div class="statistics-box with-icon">
                <i class="text-bronze ico fas fa-medal"></i>
                <h2 id="Toptext3" class="text-bronze"></h2>
                <h5 id="SucTop3">asd</h5>

                <h5>Calificacion</h5>

                <h3 id="Topval3" class="counter"></h3>
                <h5>Venta</h5>
                <h4 id="Top3venta" class="counter"></h4>
            </div>
        </div>
        <!-- /.box-content -->
    </div>

    <div class="col-xs-12" id="cardtablalocales" style="display: none;">
        <div class="box-content bordered ">
            <h4 id="TablaFecha" class="box-title">Locales</h4>


            <div class="card-body">
                <div class="table-responsive">
                    <table id="TbRankingLocales" style="width: 100%; font-size: 18px; font-weight: bold;" class="table-bordered table-striped table-hover">

                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require 'views/footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/datatables.min.css" />

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/locale/es.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    function LocalesOnload() {

        ValidarVendedoresNacional();

    }
    LocalesOnload();
</script>
<script>
    $("#page-title").text("Top vendedores a nivel nacional");
</script>