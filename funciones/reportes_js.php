<?php

$url_Cargar_Consultas = constant('URL') . 'reportes/Cargar_Consultas/';
$url_Generar_pdf = constant('URL') . 'reportes/Generar_pdf/';


$SO = PHP_OS;
if ($SO  == "Linux") {
    $directorio_archivo = "/api/docs/";
} else {
    $directorio_archivo = "/credito_express_api/docs/";
}
?>
<script>
    var url_Cargar_Consultas = '<?php echo $url_Cargar_Consultas ?>';
    var url_Generar_pdf = '<?php echo $url_Generar_pdf ?>';

    var directorio_archivo = '<?php echo $directorio_archivo ?>';


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
                    render: function(x, y, r) {
                        if (x != null) {
                            if (!r.existe) {
                                x = '<a class="text-success">GENERAR</a>';
                            } else {
                                x = "<a target='_blank' href='" + directorio_archivo + x + "'><i class='fa fa-file-pdf-o fs-1 text-danger'></i></a>"
                            }

                        } else {
                            x = '<a class="text-success">GENERAR</a>';
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
            if (data["archivo"] == null || data["existe"] == false) {

                let param = {
                    id_unico: data.id_unico,
                    ip: data.ip,
                    fecha: data.fecha_consulta,
                    datos: JSON.parse(data.datos),
                    cedula: data.cedula,
                    numero: data.numero,

                }
                console.log('param: ', param);

                AjaxSendReceiveData(url_Generar_pdf, param, function(x) {
                    console.log('x: ', x);
                    Cargar_Consultas();
                })
            }
        });
    }

    function Valisar_Archivo() {
        $.ajax({
            url: archivoUrl,
            type: 'HEAD',
            success: function(data, textStatus, xhr) {
                console.log('Código de estados:', xhr.status);
                return x = "<a target='_blank' href='" + directorio_archivo + x + "'><i class='fa fa-file-pdf-o fs-1 text-danger'></i></a>" // Debería imprimir 200 si el archivo existe
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log('Código de estado:', xhr.status); // Debería imprimir 404 si el archivo no existe
            }
        });
    }
</script>