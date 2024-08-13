<?php

$urlVentasLOcales = constant('URL') . 'Toplocales/ConsultarVentaslocales/';

?>

<script>
    var StartDate;
    var EndDate;
    var FechaExcel;

    function MensajeError() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Error al cargar los datos',
            // footer: '<a href="">Why do I have this issue?</a>'
        })
    }

    function ValidarToplocales(starDate, endDate) {
        var url = '<?php echo $urlVentasLOcales ?>';
        StartDate = starDate;
        EndDate = endDate;

        var data = {
            fechaIni: StartDate,
            fechaFin: EndDate
        }



        ObtenerLocalesVentas(url, data);
    }
    const formatter = new Intl.NumberFormat('ec-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 0
    })

    function ObtenerLocalesVentas(url, data) {
        var xmlhttp = new XMLHttpRequest();
        $.blockUI({
            message: '<div class="d-flex justify-content-center align-items-center"><p class="mr-50 mb-0">Cargando ...</p> <div class="spinner-grow spinner-grow-sm text-white" role="status"></div> </div>',
            css: {
                backgroundColor: 'transparent',
                color: '#fff',
                border: '0'
            },
            overlayCSS: {
                opacity: 0.5
            }
        });

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                data = JSON.parse(data);
                console.log(data);

                if (data[0] == "01003") {
                    $("#cardtablalocales").hide();
                    $("#cardtop1").hide();
                    $("#cardtop2").hide();
                    $("#cardtop3").hide();

                    MensajeError();

                } else {
                    var datan = data;
                    //let unique = [...new Set(data.map(item => parseFloat(item.scoreFinal)))];
                    let unique = [];
                    for (var i = 0; i < datan.length; i++) {
                        if (datan[i]["scoreFinal"] != null) {
                            unique.push(parseFloat(datan[i]["scoreFinal"]));
                        }
                    }




                    var resultado = [];

                    for (var i = 0; i < 3; i++) {
                        // buscamos el vamor mas grande
                        max = Math.max.apply(null, unique);
                        // guardamos dicho valor en un nuevo array
                        resultado.push(max);
                        // buscamos el idice del valor en el array
                        index = unique.indexOf(max);
                        // eliminamos dicho valor del array original
                        unique.splice(index, 1);
                    };


                    var top1 = "";
                    var top2 = "";
                    var top3 = "";

                    for (var i = 0; i < datan.length; i++) {
                        var Nombre = datan[i]["Nombre"];

                        if (resultado[0] == parseFloat(datan[i]["scoreFinal"])) {
                            top1 = Nombre;
                        } else if (resultado[1] == parseFloat(datan[i]["scoreFinal"])) {
                            top2 = Nombre;
                        } else if (resultado[2] == parseFloat(datan[i]["scoreFinal"])) {
                            top3 = Nombre;
                        }
                    }
                    top1 = top1.split("COMPUTRON")[1]
                    top2 = top2.split("COMPUTRON")[1]
                    top3 = top3.split("COMPUTRON")[1]



                    $("#Top1text").text(top1);
                    $("#Top1val").text(parseFloat(resultado[0]).toFixed(2));

                    $("#Toptext2").text(top2);
                    $("#Topval2").text(parseFloat(resultado[1]).toFixed(2));

                    $("#Toptext3").text(top3);
                    $("#Topval3").text(parseFloat(resultado[2]).toFixed(2));

                    moment.locale('es');

                    var starDate = moment(StartDate).format('D MMMM  YYYY');
                    var endDate = moment(EndDate).format('D MMMM  YYYY');
                    $("#TablaFecha").text(starDate + "   - to -  " + endDate);
                    FechaExcel = starDate + "   - to -  " + endDate;

                    var starDate = moment(StartDate).format('MMMM  YYYY');
                    $("#TablaFechaD").text("MES: " + starDate);



                    Tablalocales(data, resultado);

                    $("#cardtop1").show(500);
                    $("#cardtop2").show(700);
                    $("#cardtop3").show(900);

                    $("#cardtablalocales").show();

                }
            }
        }
        xmlhttp.onload = () => {
            $.unblockUI();
        };
        xmlhttp.onerror = function() {
            $.unblockUI();
        };
        data = JSON.stringify(data);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);

    }

    function Tablalocales(data, toparray) {
        var format = $.fn.dataTable.render.number(',', '.', 2, '$');

        try {
            var table = $('#TbRankingLocales').DataTable({
                destroy: true,
                data: data,
                dom: 'Bfrtip',
                scrollY: 600,
                scrollX: true,
                scrollCollapse: true,
                paging: false,
                fixedColumns: {
                    leftColumns: 1,
                },
                buttons: [{
                    extend: 'excel',
                    text: 'Excel',
                    title: 'Sucursales Computron',
                    messageTop: FechaExcel,
                    header: true,
                    customize: function(xlsx, data) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];

                        var count = 0;
                        var row = 3;
                        $('row', sheet).each(function(x) {
                            if (x > 1) row++;

                        });


                        var skippedHeader = false;
                        $('row c[r^="B"]', sheet).each(function(data) {
                            if (skippedHeader) {
                                var row = this;
                                // if (x > 1) row++;
                                // 
                                //
                                //
                                //var a = t.cell(':eq(3)')
                                //var colour = $('tbody td:eq(3)').css('background-color');
                                // var colour = $(t.cell(':eq(3)', 3).node()).css('background-color');
                                // 
                                if ($(table.cell(':eq(' + count + ')', 1).node()).hasClass('top1')) {
                                    //
                                    $(this).attr('s', '42');


                                    //$(this).attr('s', '57');

                                } else if ($(table.cell(':eq(' + count + ')', 1).node()).hasClass('top2')) {
                                    // 
                                    $(this).attr('s', '32');
                                } else if ($(table.cell(':eq(' + count + ')', 1).node()).hasClass('top3')) {
                                    // 
                                    $(this).attr('s', '37');
                                }
                                count++;
                            } else {
                                skippedHeader = true;
                            }
                        });
                    }
                }, {
                    extend: 'print',
                    text: 'Imprimir',
                    title: 'Sucursales Computron',
                    messageTop: FechaExcel,
                    header: true
                }, ],
                "order": [
                    [2, "desc"]
                ],
                "columnDefs": [{
                    "width": "40%",
                    "targets": 1
                }],
                columns: [{
                        data: null,
                        title: "#",
                        render: function(data, type, row, meta) {

                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    }, {
                        data: "Nombre",
                        title: "SUCURSAL"
                    },
                    {
                        data: "scoreFinal",
                        title: "CALIFICACION FINAL ",
                        //render: $.fn.dataTable.render.number('.', ',', 2, '')
                    },
                    {
                        data: "NPSsatisfaccionCliente",
                        title: "PROMEDIO SASTISFACCION AL CLIENTE ",
                        render: $.fn.dataTable.render.number('.', ',', 2, '', '%')
                    },
                    {
                        data: "meta",
                        title: "META DEL LOCAL",
                        render: format
                    },
                    {
                        data: "value",
                        title: "VENTA ",
                        render: format
                    },
                    {
                        data: "Porcentajemeta",
                        title: "% META DEL LOCAL",
                        render: $.fn.dataTable.render.number('.', ',', 2, '', '%')
                    },
                    {
                        data: "ventasPorEmpleado",
                        title: "VENTA POR EMPLEADO",
                        render: $.fn.dataTable.render.number('.', ',', 2, '$')
                    },
                    {
                        data: "ventasPorMetro2",
                        title: "VENTA POR MT2 ",
                        render: format
                    },
                    {
                        data: "porcentajeVentasGarantias",
                        title: "% VENTA GARANTIAS",
                        render: $.fn.dataTable.render.number('.', ',', 2, '', '%')
                    },
                    {
                        data: "rotacionDeInventario",
                        title: "ROTACION DE INVENTARIO",
                        render: $.fn.dataTable.render.number('.', ',', 2, '', '%')
                    },
                    {
                        data: "VisitasFantasmas",
                        title: "SCORE VISITA FANTASMA",
                        render: $.fn.dataTable.render.number('.', ',', 2, '', '')
                    }
                ],
                "createdRow": function(row, data, index, cell) {

                    // $('td', row).eq(2).addClass('bg-white');
                    $('td', row).eq(4).addClass('bg-meta');
                    $('td', row).eq(5).addClass('bg-venta');
                    $('td', row).eq(8).addClass('bg-mt2');



                    if (parseFloat(data["NPSsatisfaccionCliente"]) >= 80) {
                        $('td', row).eq(3).addClass('text-success');
                    }
                    if (parseFloat(data["NPSsatisfaccionCliente"]) >= 50 && parseFloat(data["NPSsatisfaccionCliente"]) < 80) {
                        $('td', row).eq(3).addClass('text-warning');
                    }
                    if (parseFloat(data["NPSsatisfaccionCliente"]) < 50) {
                        $('td', row).eq(3).addClass('text-danger');
                    }


                    var top1 = toparray[0];
                    var top2 = toparray[1];
                    var top3 = toparray[2];

                    if (parseFloat(data["scoreFinal"]) == top1) {
                        $('td', row).eq(0).addClass('font-weight-bolder top1');
                        $('td', row).eq(1).addClass('font-weight-bolder top1');

                    }
                    if (parseFloat(data["scoreFinal"]) == top2) {
                        $('td', row).eq(0).addClass('font-weight-bolder top2');
                        $('td', row).eq(1).addClass('font-weight-bolder top2');


                    }
                    if (parseFloat(data["scoreFinal"]) == top3) {
                        $('td', row).eq(0).addClass('font-weight-bolder top3');
                        $('td', row).eq(1).addClass('font-weight-bolder top3');

                    }

                    if ((data["scoreFinal"]) >= 8) {

                        $('td', row).eq(2).addClass('bg-10');
                        $('td', row).eq(2).html("<span>" + parseFloat(data["scoreFinal"]).toFixed(2) + "</span>");

                    }
                    if ((data["scoreFinal"]) >= 5 && (data["scoreFinal"]) < 8) {

                        $('td', row).eq(2).addClass('bg-5');
                        $('td', row).eq(2).html("<span>" + parseFloat(data["scoreFinal"]).toFixed(2) + "</span>");

                    }
                    if ((data["scoreFinal"]) < 5) {

                        $('td', row).eq(2).addClass('bg-0');
                        $('td', row).eq(2).html("<span>" + parseFloat(data["scoreFinal"]).toFixed(2) + "</span>");

                    }


                    if (data["scoreFinal"] == null) {
                        $('td', row).eq(2).html("<span class='text-light'>Sin Datos</span>");
                    }
                    if (data["ventasPorMetro2"] == null) {
                        $('td', row).eq(4).html("<span class='text-danger'>Sin Datos</span>");
                    }
                    if (data["ventasPorMetro2"] == null) {
                        $('td', row).eq(8).html("<span class='text-danger'>Sin Datos</span>");
                    }
                    if (data["pVentaMt2"] == null) {
                        $('td', row).eq(9).html("<span class='text-danger'>Sin Datos</span>");
                    }

                    if (parseInt(data["VisitasFantasmas"]) >= 80) {
                        $('td', row).eq(11).addClass('font-weight-bold text-success');

                    }
                    if (parseInt(data["VisitasFantasmas"]) >= 50 && parseInt(data["VisitasFantasmas"]) < 80) {
                        $('td', row).eq(11).addClass('text-warning');

                    }
                    if (parseInt(data["VisitasFantasmas"]) >= 0 && parseInt(data["VisitasFantasmas"]) < 50) {
                        $('td', row).eq(11).addClass('text-danger');

                    }



                }

            });
            setTimeout(function() {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
            }, 500);

        } catch (error) {
            console.log(error);
            console.log(data);

        }

    }
</script>