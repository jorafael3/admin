<?php



require 'views/header.php';
require 'funciones/toplocalesjs.php';

?>

<div class="row small-spacing">
    <div class="col-xs-12">
        <div class="box-content bordered ">
            <!-- /.box-title -->

            <div class="card-body">
                <div class="row d-flex align-items-end">
                    <div class="col-md-4 col-12">
                        <label for="txtNombre">Seleccione Mes</label>
                        <div class="input-group mb-3">

                            <input type="text" class="form-control" name="datepicker" id="datepicker" />

                        </div>
                        <div class="input-group mb-3" style="display: none;" id="cardFehas">
                            <h6>Dia o Rango de dias en el mes seleccionado</h6>
                            <!--
                            <input style="" autocomplete="off" type="text" class="form-control flatpickr-range" name="datetime" id="datetimes2" />
-->
                            <input type="text" class="form-control" name="datepicker" id="datepicker2" />


                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="txtNombre"></label>
                        <div class="input-group mb-3">
                            <button id="btnbuscarF" style="display: none;" onclick="BtnAceptarlocales(this.value)" type="button" class="btn btn-icon btn-icon-left btn-success  waves-effect waves-light">
                                <i class="ico fa fa-check"></i>Aceptar
                            </button>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-xs-12" style="display: none;" id="cardtop1">
        <div class="box-content bordered warning bak" style="font-weight: bold;">
            <div class="statistics-box with-icon">
                <i class="text-warning ico fas fa-medal"></i>
                <div class="col-lg-12">
                    <h4 id="Top1text" style="font-size: 20px;" class="text-warning font-weight-bolder">CONDADO SHOPPING</h4>
                </div>
                <span>calificacion</span>
                <h4 id="Top1val" style="font-size: 20ox;" class="counter">$72943</h4>
            </div>
        </div>
        <!-- /.box-content -->
    </div>
    <div class="col-lg-4 col-md-12 col-xs-12" style="display: none;" id="cardtop2">
        <div class="box-content bordered silver" style="font-weight: bold;">
            <div class="statistics-box with-icon">
                <i class="text-silver ico fas fa-medal"></i>
                <h4 style="font-size: 20px;" id="Toptext2" class="font-weight-bolder">Computron Kenedy</h4>
                <span>calificacion</span>

                <h4 id="Topval2" class="counter">$72943</h4>
            </div>
        </div>
        <!-- /.box-content -->
    </div>
    <div class="col-lg-4 col-md-12 col-xs-12" style="display: none;" id="cardtop3">
        <div class="box-content bordered bronze" style="font-weight: bold;">
            <div class="statistics-box with-icon">
                <i class="text-bronze ico fas fa-medal"></i>
                <h4 style="font-size: 20px;" id="Toptext3" class="text-bronze font-weight-bolder">Computron Kenedy</h4>
                <span>calificacion</span>

                <h4 id="Topval3" class="counter">$72943</h4>
            </div>
        </div>
        <!-- /.box-content -->
    </div>
    <div class="col-xs-12" id="cardtablalocales" style="display: none;">
        <div class="box-content bordered ">
            <h4 id="TablaFecha" class="box-title">Locales</h4>


            <div class="card-body">
                <div class="table-responsive">
                    <table id="TbRankingLocales" style="width: 100%; font-size: 14px; font-weight: bold;" class="table-bordered table-striped table-hover">

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/footer.php'; ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link href="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/style.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/index.js"></script>
<script>
    var fi = moment().startOf('month').format('MMMM YYYY');
    var MesActual = moment().startOf('month').format('YYYY-MM-DD');
    var Hoy = moment().format('YYYY-MM-DD');



    var dtpini;
    var dtpfin;
    var starDate;
    var endDate;

    $("#datepicker").flatpickr({
        maxDate: "today",
        defaultDate: "today",
        onChange: (selectedDates, dateStr, instance) => {
            $("#cardFehas").show(500);
            $("#btnbuscarF").show(500);

            dtpini = moment(selectedDates[0]).format('YYYY-MM-DD');
            dtpfin = moment(dtpini).endOf("month").format('YYYY-MM-DD');

            if (MesActual == dtpini)
                dtpfin = moment().subtract(1, "days").format('YYYY-MM-DD')

            $("#datepicker2").val("");

            $("#datepicker2").flatpickr({
                mode: "range",
                //dateFormat: "m",
                maxDate: dtpfin,
                //  noCalendar: true,
                minDate: dtpini,
                //defaultDate: [dtpini,dtpfin],
                onChange: ([start, end]) => {
                    if (start && end) {

                        var s = moment(start).format('YYYY-MM-DD');
                        var e = moment(end).format('YYYY-MM-DD');

                        starDate = s;
                        endDate = e;




                    }
                },
            });


        },
        plugins: [
            new monthSelectPlugin({
                shorthand: true,
                dateFormat: "M Y",
                altFormat: "F Y",
                theme: "material_blue",
                maxDate: "today",

            })
        ]
    });




    $("#datepicker").on("changeMonth", function(e) {
        var f = $("#datepicker").val();
        $("#datetimes2").show(500);

    });

    $("#page-title").text("Top Locales Computron");
    $('#datetimes2').daterangepicker({
        "showDropdowns": true,
        "opens": "rigth",
        format: 'yyyy-mm-dd',
        maxDate: moment(),
        ranges: {
            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
            'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
            'Este Mes': [moment().startOf('month'), moment().endOf('month')],
            'Mes Pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Año Pasado': [moment().subtract(1, "year").startOf('year'), moment().subtract(1, "year").endOf("year")],
            'Este Año': [moment().startOf('year'), moment()]

        }
    });

    function LocalesOnload() {
        var starDate = moment().startOf("month").format('YYYY-MM-DD');
        var endDate = moment().subtract(1, "day").format('YYYY-MM-DD');

        //var starDate = moment().format('YYYY-MM-DD');
        //var endDate = moment().format('YYYY-MM-DD');


        if (Hoy == MesActual) {
            console.log("iguales");
            starDate = moment().subtract(1, "month").startOf("month").format('YYYY-MM-DD');
            endDate = moment().subtract(1, "month").endOf("month").format('YYYY-MM-DD');
        }
        console.log(starDate);
        console.log(endDate);
        ValidarToplocales(starDate, endDate);

    }
    LocalesOnload();

    function BtnAceptarlocales(id) {
        var s = $('.flatpickr-monthDropdown-months').val();
        // var starDate = $("#datetimes2").data('daterangepicker').startDate.format('YYYY-MM-DD');
        //var endDate = $("#datetimes2").data('daterangepicker').endDate.format('YYYY-MM-DD');
        if ($("#datepicker2").val() == "") {

            var hoy = moment(dtpini).format('YYYY-MM-DD');
            var mesact = moment().startOf("month").format('YYYY-MM-DD');
            if (hoy == mesact) {
                starDate = moment().startOf("month").format('YYYY-MM-DD');
                endDate = moment().subtract(1, "day").format('YYYY-MM-DD');
            } else {
                starDate = moment(dtpini).format('YYYY-MM-DD');
                endDate = moment(dtpini).endOf("month").format('YYYY-MM-DD');
            }
        }
        console.log(hoy);
        console.log(mesact);

        ValidarToplocales(starDate, endDate);



    }
</script>