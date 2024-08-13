<?php

$urlDatosLocales = constant('URL') . 'Administracion/ConsultarDatosLocales/';
$urlactLocales = constant('URL') . 'Administracion/ActualizarDatosLocales/';
$urlVentasVendedores = constant('URL') . 'Topvendedores/ConsultarVentasVendedores/';
$urlUpdateSasVendedores = constant('URL') . 'Administracion/ActualizarSasVendedores/';


?>

<script>
    function Mensajeok() {
        /*Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Datos Actualizados',
            showConfirmButton: false,
            timer: 1000
        })*/
        toastr.success('Datos Actualizados')
    }

    function Mensajeerr() {
        /*  Swal.fire({
              position: 'top-end',
              icon: 'warning',
              title: 'Error al Actualizar',
              showConfirmButton: false,
              timer: 1000
          })*/
        toastr.error('Error Al Actualizar')
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "500",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

    }

    var TextoSucursal;
    var IdSucursal;
    var TextoSucursal2

    function validarAdminDatos(idl, tipo) {
        var url = '<?php echo $urlDatosLocales ?>';
        IdSucursal = idl;
        var data = {
            id: idl
        }
        var suc = $("#Sucursales2 option:selected").text();
        TextoSucursal = suc;
        var suc2 = $("#Sucursales option:selected").text();
        TextoSucursal2 = suc2;
        if (tipo == 1) {
            ObtenerDatoslocales(url, data);

        } else {

            var endDate = moment().format('YYYY-MM-DD');
            var starDate = moment().subtract(30, "day").format('YYYY-MM-DD');
            var data = {
                fechaIni: starDate,
                fechaFin: endDate,
                sucursal: idl
            }
            ObtenerDatosEmpleados(data);
        }
    }


    function ObtenerDatosEmpleados(data) {
        var url = '<?php echo $urlVentasVendedores ?>';
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

                if (data.length > 0) {
                    TablaDvendeores(data);
                    $("#CardUpemp").show(500);
                } else {
                    // Mensajeerr("Error al cargar los datos, posiblemente no hayan datos disponibles");
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

    function TablaDvendeores(data) {
        var format = $.fn.dataTable.render.number(',', '.', 2, '$');
        var buttonCommon = {
            exportOptions: {
                orthogonal: 'export',
            }
        };
        $('#tablaVendedores').empty();
        var table = $('#tablaVendedores').DataTable({
            destroy: true,
            data: data,
            dom: 'Bfrtip',
            responsive: true,
            deferRender: true,
            buttons: [$.extend(!0, {}, buttonCommon, {
                extend: "excel",
                title: TextoSucursal,
                messageTop: "Datos de Empleados Sucursal: " + TextoSucursal,
                exportOptions: {
                    columns: [0, 1]
                }
            })],
            "order": [
                [0, "desc"]
            ],
            "columnDefs": [{
                "width": "60%",
                "targets": 0
            }],
            columns: [{
                    data: "Nombre",
                    title: "NOMBRE DEL VENDEDOR"
                },
                {
                    data: "SatisfaccionCliente",
                    title: "Calificacion Satisfaccion al cliente",
                    className: "dt-center  input-sas",
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            var d = data;
                            if (d != null) {
                                data = '<input type="number" min="0" value="' + d + '" class="form-control input-sas">'
                            }
                        }
                        if (type === 'export') {
                            var d = data;
                            if (d != null) {
                                data = d;
                            }
                        }
                        return data;
                    },
                    //defaultContent: '<input type="number" min="0" class="form-control input-sas">',
                    orderable: false
                }, {
                    data: "ScoreVisitaFantasma",
                    title: "Score Visita Fantasma",
                    className: "dt-center  input-fan",
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            var d = data;
                            if (d != null) {
                                data = '<input type="number" min="0" value="' + d + '" class="form-control input-fan">'
                            }
                        }
                        if (type === 'export') {
                            var d = data;
                            if (d != null) {
                                data = d;
                            }
                        }
                        return data;
                    },
                    //defaultContent: '<input type="number" min="0" class="form-control input-sas">',
                    orderable: false
                },
                {
                    data: null,
                    title: "",
                    className: "dt-center  btn_add",
                    defaultContent: '<button style="display:none;" class="btn btn-success btn_add"> Actualizar</button>',
                    orderable: false
                }
            ],

            "createdRow": function(row, data, index) {}

        }).clear().rows.add(data).draw();

        $("#tablaVendedores tbody").on("keydown", function(event) {
            if (event.which == 13) {
                event.preventDefault();
                $('.btn_add').click();
            }
        });


        /* $("#tablaVendedores tbody").on("change", 'input', function(event) {
             event.preventDefault();
             var val = $(this).val();
             
             $('.btn_add').click();
         });*/

        $('#tablaVendedores tbody').on('click', 'td.btn_add', function(e) {
            e.preventDefault();
            //var data = table.row(this).data();
            var nameInput = $('input-sas').val();
            var data = table.row(this).data();
            var sas = table.row(this).nodes().to$().find('input').val();
            var column0 = table.row(this).nodes().to$().find('input').map(function() {
                return this.value
            }).get();

            //
            var sastifac = column0[0];
            var fantasma = column0[1];

            var a = data["ID"];
            var data2 = {
                ID: a,
                sas: sastifac,
                fantasma: fantasma
            }

            console.log(data2);
            //
            //UpdateData(data);
            UpdateSasVendedor(data2);
        });
    }


    function UpdateSasVendedor(data) {
        //data.SatisfaccionCliente = sas;


        var xmlhttp = new XMLHttpRequest();
        $.blockUI({
            message: '<div class="d-flex justify-content-center align-items-center"><p class="mr-50 mb-0">Guardando ...</p> <div class="spinner-grow spinner-grow-sm text-white" role="status"></div> </div>',
            css: {
                backgroundColor: 'transparent',
                color: '#fff',
                border: '0'
            },
            overlayCSS: {
                opacity: 0.5
            }
        });
        var url = '<?php echo $urlUpdateSasVendedores ?>';

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                data = JSON.parse(data);
                if (data == true) {
                    //  Mensajeok()
                } else {
                    Mensajeerr()
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

    function ObtenerDatoslocales(url, data) {
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
                $("#CardUplocales").hide(100);
                $("#CardUplocales").show(500);

                var meta = parseFloat(data[0]["Meta"]).toFixed(2);

                $("#MetaLocal").val(meta);
                $("#Saslocal").val(data[0]["metaRotacion"]);

                $("#SasFantasma").val(data[0]["VisitasFantasmas"]);

                var data2 = data[0];

                // delete data2.Meta

                // 
                //$("#tablaDSucursales tbody").empty();
                var con = 1;
                var arr = [];



                /* jQuery.each(data[0], function(key, value) {

                     // var text = Object.keys(value);
                     if (key == "Meta" || key == "Sucursalid" || key == "VisitasFantasmas" ||
                         key == "codigo" || key == "metaRotacion") {} else {
                         var mes = key.toString();
                         mes = mes.split("meta")[1]
                         mes = mes.toUpperCase();

                         console.log(key);


                         var valueInput;
                         if (mes == "ENERO") {

                             valueInput = value;

                         } else if (mes == "FEBRERO") {
                             valueInput = value;

                         } else if (mes == "MARZO") {
                             valueInput = value;

                         } else if (mes == "ABRIL") {
                             valueInput = value;

                         } else if (mes == "MAYO") {
                             valueInput = value;

                         } else if (mes == "JUNIO") {
                             valueInput = value;

                         } else if (mes == "JULIO") {
                             valueInput = value;

                         } else if (mes == "AGOSTO") {
                             valueInput = value;

                         } else if (mes == "SEPTIEMBRE") {
                             valueInput = value;

                         } else if (mes == "OCTUBRE") {
                             valueInput = value;

                         } else if (mes == "NOVIEMBRE") {
                             valueInput = value;

                         } else if (mes == "DICIEMBRE") {
                             valueInput = value;

                         }


                         var b = {
                             con: con,
                             Mes: mes,
                             Meta: valueInput
                         }

                         arr.push(b);

                         /*   var tbody = `
                                <tr >
                                    <td>` + con + `</td>
                                    <td>` + mes + `</td>
                                    <td class="dt-center  input-meta">
                                        <input class="form-control input-meta" value="` + valueInput + `" type="number" min="1">
                                    </td>
                                    <td class="dt-center  btn_add">
                                        <button style="display:none;" class="btn btn-success btn_add"> Actualizar</button>
                                    </td>
                                </tr>`*/
                // $("#tablaDSucursales tbody").append(tbody);

                // con = con + 1;
                //}


                // });

                // TablaDSucursales(arr);
                // console.log(arr);
                // 

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

    function TablaDSucursales(data) {
        var format = $.fn.dataTable.render.number(',', '.', 2, '$');
        var buttonCommon = {
            exportOptions: {
                orthogonal: 'export',
            }
        };
        $('#tablaDSucursales').empty();
        var table = $('#tablaDSucursales').DataTable({
            destroy: true,
            data: data,
            dom: 'Brtip',
            responsive: true,
            deferRender: true,
            "pageLength": 12,
            "paging": false,
            buttons: [$.extend(!0, {}, buttonCommon, {
                extend: "excel",
                title: "Metas Mensuales",
                messageTop: "SUCURSAL: " + TextoSucursal2,
                exportOptions: {
                    columns: [0, 1, 2]
                }
            })],
            "order": [
                [0, "asc"],
            ],
            "columnDefs": [{
                "width": "5%",
                "targets": 0
            }, {
                "width": "20%",
                "targets": 1
            }, {
                "width": "1%",
                "targets": 3
            }],
            columns: [{
                    data: "con",
                    title: "#"
                }, {
                    data: "Mes",
                    title: "MES"
                },
                {
                    data: "Meta",
                    title: "META",
                    className: "dt-center  input-sas",
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            var d = data;
                            if (d != null) {
                                data = '<input type="number" min="0" value="' + d + '" class="form-control input-sas">'
                            }
                        }
                        if (type === 'export') {
                            var d = data;
                            if (d != null) {
                                data = d;
                            }
                        }
                        return data;
                    },
                    //defaultContent: '<input type="number" min="0" class="form-control input-sas">',
                    orderable: false
                },
                {
                    data: null,
                    title: "",
                    className: "dt-center  btn_add",
                    defaultContent: '<button style="display:none;" class="btn btn-success btn_add"> Actualizar</button>',
                    orderable: false
                }
            ],

            "createdRow": function(row, data, index) {}

        }).clear().rows.add(data).draw();

        $("#tablaDSucursales tbody").on("keydown", function(event) {
            if (event.which == 13) {
                event.preventDefault();
                $('.btn_add').click();
            }
        });
        /* $("#tablaVendedores tbody").on("change", 'input', function(event) {
             event.preventDefault();
             var val = $(this).val();
             
             $('.btn_add').click();
         });*/

        $('#tablaDSucursales tbody').on('click', 'td.btn_add', function(e) {
            e.preventDefault();
            //var data = table.row(this).data();
            var nameInput = $('input-sas').val();
            var data = table.row(this).data();
            var meta = table.row(this).nodes().to$().find('input').val();
            //
            var mes = data["Mes"];

            var data2 = {
                id: IdSucursal,
                meta: meta,
                mes: mes
            }

            console.log(data2);
            //
            //UpdateData(data);
            ACtualizarDatosLocales(data2);
        });

        setTimeout(function() {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
        }, 500);



    }

    function ACtualizarDatosLocales() {
        var url = '<?php echo $urlactLocales ?>';

        var meta = $("#MetaLocal").val();
        var rotacion = $("#Saslocal").val();
        var Suc = $("#Sucursales").val();
        var fantasma = $("#SasFantasma").val();

        var data = {
            id: Suc,
            meta: meta,
            rotacion: rotacion
        }

        console.log(data);



        var xmlhttp = new XMLHttpRequest();
        $.blockUI({
            message: '<div class="d-flex justify-content-center align-items-center"><p class="mr-50 mb-0">Guardando ...</p> <div class="spinner-grow spinner-grow-sm text-white" role="status"></div> </div>',
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

                if (data == true) {
                    // Mensajeok()
                } else {
                    Mensajeerr()
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
</script>