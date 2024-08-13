<?php

$urlVenddeoresNacionales = constant('URL') . 'Principal/ConsultarVentasvendedores/';


?>

<script>
    var url = '<?php echo $urlVenddeoresNacionales ?>';
    var StartDate;
    var FechaExcel;

    function ValidarVendedoresNacional() {

        var Start = moment().subtract(1, 'month').startOf('month').format('YYYY-MM-DD');
        var End = moment().subtract(1, 'month').endOf('month').format('YYYY-MM-DD');


        var f1 = moment().subtract(1,"day").format('YYYY-MM-DD');
        var MEsACtual = moment().startOf("month").format('YYYY-MM-DD');
        StartDate = f1;


        var data = {
            fechaIni: MEsACtual,
            fechaFin: f1
        }
        console.log(data);
        Get_vendoresNacionales(url, data);

    }

    function Get_vendoresNacionales(url, data) {
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

                var datan = data;
                var datarest = data.reverse();

                //let unique = [...new Set(data.map(item => parseFloat(item.scoreFinal)))];
                let unique = [];
                for (var i = 0; i < datan.length; i++) {
                    if (datan[i]["superScore"] != null) {
                        unique.push(parseFloat(datan[i]["superScore"]));
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

                var suc1 = "";
                var suc2 = "";
                var suc3 = "";

                var ven1 = "";
                var ven2 = "";
                var ven3 = "";

                for (var i = 0; i < datan.length; i++) {
                    var Nombre = datan[i]["Nombre"];
                    var s = datan[i]["NombreSucursal"];


                    if (resultado[0] == parseFloat(datan[i]["superScore"])) {
                        top1 = Nombre;
                        suc1 = s;
                        ven1 = datan[i]["value"];
                    } else if (resultado[1] == parseFloat(datan[i]["superScore"])) {
                        top2 = Nombre;
                        suc2 = s;
                        ven2 = datan[i]["value"];

                    } else if (resultado[2] == parseFloat(datan[i]["superScore"])) {
                        top3 = Nombre;
                        suc3 = s;
                        ven3 = datan[i]["value"];

                    }
                }


                $("#Top1text").text(top1);
                $("#SucTop1").text(suc1);
                $("#Top1val").text(parseFloat(resultado[0]).toFixed(2));
                $("#Top1venta").text("$"+ven1);

                $("#Toptext2").text(top2);
                $("#SucTop2").text(suc2);
                $("#Topval2").text(parseFloat(resultado[1]).toFixed(2));
                $("#Top2venta").text("$"+ven2);

                $("#Toptext3").text(top3);
                $("#SucTop3").text(suc3);
                $("#Topval3").text(parseFloat(resultado[2]).toFixed(2));
                $("#Top3venta").text("$"+ven3);

                moment.locale('es');


                var starDate = moment(StartDate).format('MMMM  YYYY');
                FechaExcel = StartDate;
                $("#TablaFechaD").text("MES: " + starDate);
                $("#TablaFecha").text("MES: " + starDate);



                datarest.pop();
                datarest.pop();
                datarest.pop();
                console.log(datarest);
                Tablalocales(datarest.reverse());

                $("#cardtop1").show(500);
                $("#cardtop2").show(700);
                $("#cardtop3").show(900);

                $("#cardtablalocales").show();


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

    function Tablalocales(data) {
        var format = $.fn.dataTable.render.number(',', '.', 2, '$');

        var table = $('#TbRankingLocales').DataTable({
            destroy: true,
            data: data,
            dom: 'rtip',
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
                title: 'Top Vendedores a nivel nacional',
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
                [3, "desc"]
            ],
            "columnDefs": [{
                "width": "40%",
                "targets": 1
            }],
            columns: [{
                    data: null,
                    title: "#",
                    render: function(data, type, row, meta) {
                        var d;
                        d = (meta.row + 3) + meta.settings._iDisplayStart + 1;

                        return d

                    }
                }, {
                    data: "Nombre",
                    title: "NOMBRE"
                },
                {
                    data: "NombreSucursal",
                    title: "SUCURSAL",
                    //render: $.fn.dataTable.render.number('.', ',', 2, '')
                },
                {
                    data: "superScore",
                    title: "CALIFICACION",
                    render: $.fn.dataTable.render.number('.', ',', 2, '', '')
                },
                {
                    data: "value",
                    title: "VENTA",
                    render: format
                }
            ],
            "createdRow": function(row, data, index, cell) {

                // $('td', row).eq(2).addClass('bg-white');
                $('td', row).eq(4).addClass('bg-mt2');
                $('td', row).eq(0).addClass('bg-venta');


                if (parseFloat(data["superScore"]) >= 8) {
                    $('td', row).eq(3).addClass('text-success');

                }
                if (parseFloat(data["superScore"]) >= 5 && parseFloat(data["superScore"]) < 8) {
                    $('td', row).eq(3).addClass('text-warning');
                }
                if (parseFloat(data["superScore"]) < 5) {
                    $('td', row).eq(3).addClass('text-danger');
                }




            }

        });
        setTimeout(function() {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
        }, 500);

    }
</script>