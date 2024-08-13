<?php

$url_Cargar_Consultas = constant('URL') . 'reportes/Cargar_Consultas/';

?>
<script>
    var url_Cargar_Consultas = '<?php echo $url_Cargar_Consultas ?>';


    function Cargar_Consultas() {

        AjaxSendReceiveData(url_Cargar_Consultas, [], function(x) {
            console.log('x: ', x);
            if (x.success) {

                Tabla_reporte(x.data)

            }
        });
    }
    Cargar_Consultas();

    function Tabla_reporte(data) {
        $('#Tabla_reporte').empty();
        if ($.fn.dataTable.isDataTable('#Tabla_reporte')) {
            $('#Tabla_reporte').DataTable().destroy();
        }
        var table = $('#Tabla_reporte').DataTable({
            destroy: true,
            data: data,
            dom: 'Brtip',
            // responsive: true,
            deferRender: true,
            "pageLength": 20,
            "paging": true,
            buttons: ['excel'],
            "order": [
                [0, "desc"],
            ],
            // "columnDefs": [{
            //     "width": "5%",
            //     "targets": 0
            // }, {
            //     "width": "20%",
            //     "targets": 1
            // }, {
            //     "width": "1%",
            //     "targets": 3
            // }],
            columns: [{
                    data: "fecha_consulta",
                    title: "fecha consulta"
                }, {
                    data: "cedula",
                    title: "cedula"
                },
                {
                    data: "numero",
                    title: "numero",
                },
                {
                    data: "archivo",
                    title: "terminos",
                    className: "btn_terminos",
                    render: function(x) {
                        if (x != null) {
                            x = "<a target='_blank' href='" + directorio_archivo + x + "'><i class='fa fa-file-pdf-o fs-1 text-danger'></i></a>"
                        } else {
                            x = '<a>GENERAR</a>';
                        }
                        return x;
                    }
                },

            ],

            "createdRow": function(row, data, index) {
                // $('td', row).eq(1).addClass('bg-warning bg-opacity-50');
            }




        }).clear().rows.add(data).draw();

        $('#Tabla_reporte tbody').on('click', 'td.btn_terminos', function(e) {
            var data = table.row(this).data();
            console.log('data: ', data);
            if (data["archivo"] == null) {

                let param = {
                    cedula: data["cedula"],
                    nombre_cliente: data["nombre_cliente"],
                    fecha_creado: moment(data["fecha_creado"]).format("YYYYMMDDhhmmss"),
                    ip: data["ip"],
                }

                AjaxSendReceiveData(url_Generar_pdf, param, function(x) {
                    console.log('x: ', x);
                    if (x == 1) {
                        Cargar_reporte();
                    }
                })
            }
        });
    }
</script>