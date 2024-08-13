<?php

$urlVentasVendedores = constant('URL') . 'Topvendedores/ConsultarVentasVendedores/';

?>


<script>
    var NombreTienda;
    var FechaExcel;

    function MEnsajeError(texto) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: texto
        })
    }

    function ValidarTopVendedores(starDate, endDate, suc) {
        var url = '<?php echo $urlVentasVendedores ?>';
        StartDate = starDate;
        EndDate = endDate;
        var Tienda = $("#Sucursales option:selected").text();
        NombreTienda = Tienda;


        var data = {
            fechaIni: StartDate,
            fechaFin: EndDate,
            sucursal: suc
        }



        ObtenerVendedoresVentas(url, data);
    }
    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 0
    })


    function ObtenerVendedoresVentas(url, data) {
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
                if (data[1] != 8134) {
                    var datan = data;


                    var resultado = [];
                    let unique = [...new Set(data.map(item => parseFloat(item.ScoreTotal)))];

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

                        if (resultado[0] == parseFloat(datan[i]["ScoreTotal"])) {
                            top1 = Nombre;

                        } else if (resultado[1] == parseFloat(datan[i]["ScoreTotal"])) {
                            top2 = Nombre;
                        } else if (resultado[2] == parseFloat(datan[i]["ScoreTotal"])) {
                            top3 = Nombre;
                        }
                    }





                    var res1 = (resultado[0]);
                    var res2 = (resultado[1]);
                    var res3 = (resultado[2]);

                    if (top1 == "") {
                        top1 = "Vacio"
                        res1 = "-";
                    }
                    if (top2 == "") {
                        top2 = "Vacio"
                        res2 = "-";
                    }
                    if (top3 == "") {
                        top3 = "Vacio"
                        res3 = "-";
                    }


                    $("#Top1text").text(top1);
                    $("#Top1val").text(res1);

                    $("#Toptext2").text(top2);
                    $("#Topval2").text(res2);

                    $("#Toptext3").text(top3);
                    $("#Topval3").text(res3);

                    moment.locale('es');

                    var starDate = moment(StartDate).format('D MMMM  YYYY');
                    var endDate = moment(EndDate).format('D MMMM  YYYY');
                    $("#TablaFecha").text("Periodo: " +starDate + "   -  -  " + endDate);

                    FechaExcel = starDate + "   - to -  " + endDate;


                    $("#cardtop1").show(500);
                    $("#cardtop2").show(700);
                    $("#cardtop3").show(900);

                    TablaVendedores(data, resultado);
                    $("#cardtablalocales").show(500);


                    var meta = [...new Set(data.map(item => parseFloat(item.Meta)))];

                    GraficoVendedores(data, meta);
                    $("#PeridoGrafico").text("Periodo: "+FechaExcel);
                    $("#textMetaG").text("" + formatter.format(meta));
                    $("#textMetaG2").text("" + formatter.format(meta));

                    $("#cardGrafico").show(500);


                } else {


                    MEnsajeError("Error al cargar los datos, posiblemente no hayan datos disponibles");
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

    function TablaVendedores(data, toparray) {
        var i = 0

        data.sort(function(a, b) {
            if (a.ScoreTotal > b.ScoreTotal) {
                return 1;
            }
            if (a.ScoreTotal < b.ScoreTotal) {
                return -1;
            }
            // a must be equal to b
            return 0;
        });
        var format = $.fn.dataTable.render.number(',', '.', 2, '$');
        var count = 0;
        var table = $('#TbRankingLocales').DataTable({
            destroy: true,
            data: data.reverse(),
            dom: 'Bfrtip',
            responsive: true,
            deferRender: true,
            buttons: [{
                extend: 'excel',
                text: 'Excel',
                title: 'Sucursal: ' + NombreTienda,
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
                title: 'Sucursal: ' + NombreTienda,
                messageTop: FechaExcel,
                header: true
            }, ],
            "order": [
                [0, "asc"]
            ],
            "columnDefs": [{
                "width": "10%",
                "targets": 3
            }],
            columns: [{
                    data: null,
                    title: "#",
                    render: function(data, type, row, meta) {
                        count = count + 1;
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }, {
                    data: "Nombre",
                    title: "NOMBRE DEL VENDEDOR"
                },
                {
                    data: "ScoreTotal",
                    title: "Score Total ",
                    //render: format
                },{
                    data: "value",
                    title: "VENTA ",
                    render: format
                },
                {
                    data: "SatisfaccionCliente",
                    title: " SCORE <br>SASTISFACCION <br>AL CLIENTE ",
                    render: $.fn.dataTable.render.number(',', '.', 0, '')
                }, {
                    data: "PorcentajeMeta",
                    title: "% META ",
                    render: $.fn.dataTable.render.number(',', '.', 2,'', '%')
                },
                {
                    data: "Meta",
                    title: "META ",
                    render: format
                }
            ],
            "createdRow": function(row, data, index) {
                var top1 = toparray[0];
                var top2 = toparray[1];
                var top3 = toparray[2];


                $('td', row).eq(3).addClass('bg-venta');
                $('td', row).eq(6).addClass('bg-mt2');


                if (parseFloat(data["ScoreTotal"]) == top1) {
                    $('td', row).eq(0).addClass('font-weight-bolder top1');
                    $('td', row).eq(1).addClass('font-weight-bolder top1');

                }
                if (parseFloat(data["ScoreTotal"]) == top2) {
                    $('td', row).eq(0).addClass('font-weight-bolder top2');
                    $('td', row).eq(1).addClass('font-weight-bolder top2');

                }
                if (parseFloat(data["ScoreTotal"]) == top3) {
                    $('td', row).eq(0).addClass('font-weight-bolder top3');
                    $('td', row).eq(1).addClass('font-weight-bolder top3');

                }
                //  $('td', row).eq(0).addClass('font-weight-bolder bg-success');
                if (parseInt(data["SatisfaccionCliente"]) >= 80) {
                    $('td', row).eq(4).addClass('font-weight-bold text-success');

                }
                if (parseInt(data["SatisfaccionCliente"]) >= 50 && parseInt(data["SatisfaccionCliente"]) < 80) {
                    $('td', row).eq(4).addClass('text-warning');

                }
                if (parseInt(data["SatisfaccionCliente"]) >= 0 && parseInt(data["SatisfaccionCliente"]) < 50) {
                    $('td', row).eq(4).addClass('text-danger');

                }

                
                if ((data["ScoreTotal"]) >= 8) {
                    $('td', row).eq(2).addClass('bg-10');
                    $('td', row).eq(2).html("<span>"+parseFloat(data["ScoreTotal"]).toFixed(2)+"</span>");

                }
                if ((data["ScoreTotal"]) >= 5 && (data["ScoreTotal"]) < 8) {
                    $('td', row).eq(2).addClass('bg-5');
                    $('td', row).eq(2).html("<span>"+parseFloat(data["ScoreTotal"]).toFixed(2)+"</span>");

                }
                if ((data["ScoreTotal"]) < 5) {
                    $('td', row).eq(2).addClass('bg-0');
                    $('td', row).eq(2).html("<span>"+parseFloat(data["ScoreTotal"]).toFixed(2)+"</span>");

                }

            }

        });
        /* table.on('order.dt search.dt', function() {
             table.column(0).nodes().each(function(cell, i) {
                 cell.innerHTML = i + 1;
             });
         }).draw();*/
        setTimeout(function() {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
        }, 500);

    }

    function GraficoVendedores(data, meta) {
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            var insterfaceColors = new am4core.InterfaceColorSet();
            var lineColor = insterfaceColors.getFor("background");

            var chart = am4core.create("chartdiv", am4plugins_timeline.CurveChart);
            chart.curveContainer.padding(20, 20, 20, 20);
            chart.responsive.enabled = true;
            chart.data = data.reverse();

            var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "NombreGrafico";
            categoryAxis.renderer.minGridDistance = 10;
            categoryAxis.renderer.innerRadius = 5;
            categoryAxis.renderer.radius = 145;
            categoryAxis.renderer.line.stroke = lineColor;
            categoryAxis.renderer.line.strokeWidth = 5;
            categoryAxis.renderer.line.strokeOpacity = 1;

            /***texto nombre empleados */
            var labelTemplate = categoryAxis.renderer.labels.template;
            labelTemplate.fill = lineColor;
            labelTemplate.fontWeight = 1000;
            labelTemplate.fontSize = 20;

            var gridTemplate = categoryAxis.renderer.grid.template;
            gridTemplate.strokeWidth = 1;
            gridTemplate.strokeOpacity = 1;
            gridTemplate.stroke = lineColor;
            gridTemplate.location = 0;
            gridTemplate.above = true;

            var fillTemplate = categoryAxis.renderer.axisFills.template;
            fillTemplate.disabled = false;
            fillTemplate.fill = am4core.color("#FF841E"); //color de fondo
            fillTemplate.fillOpacity = 1;

            categoryAxis.fillRule = function(dataItem) {
                dataItem.axisFill.__disabled = false;
                dataItem.axisFill.opacity = 1;
            }

            var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
            valueAxis.min = 0;
            valueAxis.max = meta[0]; //*** meta */
            valueAxis.renderer.points = [{
                x: 0,
                y: -100
            }, {
                x: 200,
                y: -100
            }, {
                x: 200,
                y: 100
            }, {
                x: 0,
                y: 100
            }, {
                x: -200,
                y: 100
            }, {
                x: -200,
                y: -100
            }, {
                x: 0,
                y: -100
            }];
            valueAxis.renderer.polyspline.tensionX = 0.4;
            valueAxis.renderer.line.strokeOpacity = 0.1;
            valueAxis.renderer.line.strokeWidth = 10;
            valueAxis.renderer.maxLabelPosition = 0.98;
            valueAxis.renderer.minLabelPosition = 0.02;

            // Flag bullet
            var flagRange = valueAxis.axisRanges.create();
            flagRange.value = 0;
            var flagBullet = new am4plugins_bullets.FlagBullet();
            flagBullet.label.text = "START";
            flagRange.bullet = flagBullet;
            //flagBullet.dy = -145;
            flagBullet.adapter.add("dy", function(dy, target) {
                return -categoryAxis.renderer.radius;
            })

            var valueLabelTemplate = valueAxis.renderer.labels.template;
            valueLabelTemplate.fill = lineColor;
            valueLabelTemplate.fontSize = 20;
            valueLabelTemplate.fontWeight = 600;
            valueLabelTemplate.fillOpacity = 1;
            valueLabelTemplate.label = valueLabelTemplate.fill = am4core.color("#00000");
            valueLabelTemplate.horizontalCenter = "left";
            valueLabelTemplate.verticalCenter = "bottom";
            valueLabelTemplate.padding(0, 10, 0, 0);
            valueLabelTemplate.adapter.add("rotation", function(rotation, target) {
                var value = target.dataItem.value;
                var position = valueAxis.valueToPosition(value);

                var angle = valueAxis.renderer.positionToAngle(position);
                return angle;
            })

            var valueGridTemplate = valueAxis.renderer.grid.template;
            valueGridTemplate.strokeOpacity = 0.3;
            valueGridTemplate.stroke = lineColor;


            // SERIES
            var series = chart.series.push(new am4plugins_timeline.CurveColumnSeries());
            series.dataFields.categoryY = "NombreGrafico";
            series.stroke = lineColor;
            series.fill = lineColor;
            series.dataFields.valueX = "value";
            series.defaultState.transitionDuration = 4000;

            /**** tamaño de los valores value */
            var columnTemplate = series.columns.template;
            columnTemplate.fill = lineColor;
            columnTemplate.strokeOpacity = 0;
            columnTemplate.fillOpacity = 0.3;
            columnTemplate.height = am4core.percent(100);

            var hoverState = columnTemplate.states.create("hover");
            hoverState.properties.fillOpacity = 0.9;

            var bullet = series.bullets.push(new am4charts.CircleBullet())
            bullet.fill = lineColor;

            // LEGEND
            chart.legend = new am4charts.Legend();
            chart.legend.data = chart.data;
            chart.legend.parent = chart.curveContainer;
            chart.legend.width = 500;
            chart.legend.horizontalCenter = "middle";
            chart.legend.verticalCenter = "middle";

            var markerTemplate = chart.legend.markers.template;
            markerTemplate.width = 10;
            markerTemplate.height = 10;

            chart.legend.itemContainers.template.events.on("over", function(event) {
                series.dataItems.each(function(dataItem) {
                    if (dataItem.dataContext == event.target.dataItem.dataContext) {
                        dataItem.column.isHover = true;
                    } else {
                        dataItem.column.isHover = false;
                    }
                })
            })

            chart.legend.itemContainers.template.events.on("hit", function(event) {
                series.dataItems.each(function(dataItem) {
                    if (dataItem.dataContext == event.target.dataItem.dataContext) {
                        if (dataItem.visible) {
                            dataItem.hide(1000, 0, 0, ["valueX"]);
                        } else {
                            dataItem.show(1000, 0, ["valueX"]);
                        }
                    }
                })
            })

            var rect = markerTemplate.children.getIndex(0);
            rect.cornerRadius(20, 20, 20, 20);

            var as = markerTemplate.states.create("active");
            as.properties.opacity = 0.5;

            /*  var image = markerTemplate.createChild(am4core.Image)
             image.propertyFields.href = "file";
             image.width = 30;
             image.height = 30;
             image.filters.push(new am4core.DesaturateFilter());

             image.events.on("inited", function(event) {
                 var image = event.target;
                 var parent = image.parent;
                 image.mask = parent.children.getIndex(0);
             })*/

        }); // end am4core.ready()
    }
</script>