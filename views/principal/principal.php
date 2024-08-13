<?php



require 'views/header.php';
require 'funciones/toplocalesjs.php';

?>

<div class="row small-spacing">
    <div class="col-lg-12 col-md-12 col-xs-12 bg-white" style="margin-bottom: 20px;">
        <h2></h2>
    </div><br>
  
</div>



<?php require 'views/footer.php'; ?>


<script>
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
            'trimestre en Curso': [moment().quarter(moment().quarter()).startOf('quarter'), moment().quarter(moment().quarter()).endOf('quarter')],
            'trimestre Pasado': [moment().subtract(1, 'quarter').startOf('quarter'), moment().subtract(1, 'quarter').endOf('quarter')],
            '1 er trimestre Año Pasado': [moment().subtract(1, 'year').quarter(1).startOf('quarter'), moment().subtract(1, 'year').quarter(1).endOf('quarter')],
            '2 do trimestre Año Pasado': [moment().subtract(1, 'year').startOf('quarter'), moment().subtract(1, 'year').endOf('quarter')],
            '3 er trimestre Año Pasado': [moment().subtract(1, 'year').quarter(2).startOf('month'), moment().subtract(1, 'year').quarter(3).endOf('month')],
            '4 to Trimestre Año Pasado': [moment().subtract(1, 'year').quarter(3).startOf('month'), moment().subtract(1, 'year').quarter(4).endOf('month')],
            'Año Pasado': [moment().subtract(1, "year").startOf('year'), moment().subtract(1, "year").endOf("year")],
            'Este Año': [moment().startOf('year'), moment()]

        }
    });

    function LocalesOnload() {
        var endDate = moment().format('YYYY-MM-DD');
        var starDate = moment().subtract(30, "days").format('YYYY-MM-DD');

        var a = moment().subtract(1, 'month').startOf('month').format('YYYY-MM-DD');
        var b = moment().subtract(1, 'month').endOf('month').format('YYYY-MM-DD');

        var f1 = moment().subtract(1, "day").format('YYYY-MM-DD');
        var MEsACtual = moment().startOf("month").format('YYYY-MM-DD');
        console.log(f1, MEsACtual);


        ValidarToplocales(MEsACtual, f1);

    }
    LocalesOnload();

    function BtnAceptarlocales(id) {

        var starDate = $("#datetimes2").data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDate = $("#datetimes2").data('daterangepicker').endDate.format('YYYY-MM-DD');
        ValidarToplocales(starDate, endDate);
    }
</script>
<script>
    $("#page-title").text("Home");
</script>