<?php



require 'views/header.php';
require 'funciones/topvendedoresjs.php';

?>

<div class="row small-spacing">
    <div class="col-xs-12">
        <div class="box-content bordered ">
            <!-- /.box-title -->

            <div class="card-body">
                <div class="row d-flex align-items-end">
                    <div class="col-md-4 col-12">
                        <label for="txtNombre">Sucursal</label>
                        <div class="input-group mb-3">
                            <select onchange="CbOnchange(this.value)" name="Sucursales" id="Sucursales" class="select2 form-control select2-size-md">
                                <option value=""></option>
                                <?php
                                foreach ($this->suc as $row) {

                                ?>
                                    <option value=<?php echo ($row["ID"]); ?>><?php echo ($row["Nombre"]); ?></option>

                                <?php
                                }
                                ?>


                            </select>
                        </div>

                        <div class="row d-flex align-items-end">
                            <div class="col-md-9 col-12 " id="CardFecha" style="display: none;">
                                <label for="txtNombre">Fecha</label>
                                <div class="input-group mb-3">
                                    <input autocomplete="off" style="font-size: 12px;" type="text" class="form-control" name="datetime" id="datetimes2" />
                                </div>
                            </div>
                            <d iv class="col-md-3 col-12" id="CardButonF" style="display: none;">
                                <label for="txtNombre"></label>
                                <div class="input-group mb-3">
                                    <button onclick="BtnAceptarlocales()" type="button" class="btn btn-icon btn-icon-left btn-success  waves-effect waves-light">
                                        <i class="ico fa fa-check"></i>Aceptar
                                    </button>
                                </div>
                            </d>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-12 col-xs-12" style="display: none;" id="cardtop1">
        <div class="box-content bordered warning bak">
            <div class="statistics-box with-icon">
                <i class="text-warning ico fas fa-medal"></i>
                <div class="col-lg-12">
                    <h4 id="Top1text" class="text-warning font-weight-bolder">CONDADO SHOPPING</h4>
                </div>
                <h4 id="Top1val" class="counter">$72943</h4>
            </div>
        </div>
        <!-- /.box-content -->
    </div>
    <div class="col-lg-4 col-md-12 col-xs-12" style="display: none;" id="cardtop2">
        <div class="box-content bordered silver">
            <div class="statistics-box with-icon">
                <i class="text-silver ico fas fa-medal"></i>
                <h4 id="Toptext2" class="font-weight-bolder">Computron Kenedy</h4>
                <h4 id="Topval2" class="counter">$72943</h4>
            </div>
        </div>
        <!-- /.box-content -->
    </div>
    <div class="col-lg-4 col-md-12 col-xs-12" style="display: none;" id="cardtop3">
        <div class="box-content bordered bronze">
            <div class="statistics-box with-icon" style="font-weight: bold;">
                <i class="text-bronze ico fas fa-medal"></i>
                <h4 id="Toptext3" class="text-bronze font-weight-bolder">Computron Kenedy</h4>
                <h4 id="Topval3"" class=" counter font-weight-bolder">$72943</h4>
            </div>
        </div>
        <!-- /.box-content -->
    </div>
    <div class="col-xs-12" id="cardGrafico" style="display: none;">
        <div class="box-content bordered js__card">
            <h4 id="PeridoGrafico" class="box-title with-control">
                Grafico
                <span class="controls">
                    <button type="button" class="control fa fa-minus js__card_minus"></button>
                </span>
                <!-- /.controls -->
            </h4>
            <div class="js__card_content">
                <h3 id="">Meta de Venta del Período Seleccionado : </h3>

                <h2 class="text-success" id="textMetaG">meta</h2>
                <div id="chartdiv" style="height: 600px;"></div>
            </div>
        </div>
    </div>
    <div class="col-xs-12" id="cardtablalocales" style="display: none;">
        <div class="box-content bordered ">
            <h4 id="TablaFecha" class="box-title">Locales</h4>

            <!-- /.box-title -->
            <div class="dropdown js__drop_down">

            </div>
            <div class="card-body">
                <h4 id="">Meta de Venta del Período Seleccionado : </h4>

                <h3 class="text-success" id="textMetaG2">meta</h3>
                <div class="table-responsive">
                    <table id="TbRankingLocales" style="width: 100%; font-size: 14px; font-weight: bold;" class="table-hover table-bordered table-striped">

                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require 'views/footer.php'; ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.js"></script>

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


<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/plugins/timeline.js"></script>
<script src="https://cdn.amcharts.com/lib/4/plugins/bullets.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $("#page-title").text("Top Locales Computron");
    $('#datetimes22').daterangepicker({
        "showDropdowns": true,
        "opens": "rigth",
        format: 'yyyy-mm-dd',
        maxDate: moment().subtract(1, 'days'),
        ranges: {
            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
            // 'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
            'Este Mes': [moment().startOf('month'), moment().endOf('month')],
            'Mes Pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            //'Este Año': [moment().startOf('year'), moment()]

        }
    });
    var dtpini = moment().startOf("month").format('YYYY-MM-DD');
    var dtpfin = moment().subtract(1, "day").format('YYYY-MM-DD');
    var starDate;
    var endDate;
    console.log(dtpini);
    console.log(dtpfin);


    $("#datetimes2").flatpickr({
        mode: "range",
        //dateFormat: "m",
        maxDate: dtpfin,
        //  noCalendar: true,
        // minDate: dtpini,
        dateFormat: "Y/m/d",
        defaultDate: [dtpini, dtpfin],
        onChange: ([start, end]) => {
            if (start && end) {

                var s = moment(start).format('YYYY-MM-DD');
                var e = moment(end).format('YYYY-MM-DD');

                starDate = s;
                endDate = e;
            }
        },
    });

    function CbOnchange(id) {
        console.log(id);
        var endDate = moment().subtract(1, "day").format('YYYY-MM-DD');
        var starDate = moment().startOf("month").format('YYYY-MM-DD');
        $("#CardFecha").show(500);
        $("#CardButonF").show(500);
        ValidarTopVendedores(starDate, endDate, id);


        //$("#datetimes2").val(moment(starDate).format('DD/MM/YYYY')+" - "+moment(endDate).format('DD/MM/YYYY'));
    }
    // LocalesOnload();
    function BtnAceptarlocales(id) {
        var suc = $("#Sucursales").val();
        // var starDate = $("#datetimes2").data('daterangepicker').startDate.format('YYYY-MM-DD');
        //   var endDate = $("#datetimes2").data('daterangepicker').endDate.format('YYYY-MM-DD');


        ValidarTopVendedores(starDate, endDate, suc);
    }

    $('.select2').select2({
        placeholder: "Seleccione Sucursal"
    });
</script>
<script>
    $("#page-title").text("Top Vendedores Computron");
</script>