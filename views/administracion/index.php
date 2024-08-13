<?php require 'views/header.php'; ?>
<?php require 'funciones/administracionjs.php'; ?>


<div id="exTab2" class="box-content bordered ">
    <ul class="nav nav-tabs">
        <li class="active font-weight-bolder " style="font-size: 20px;">
            <a href="#1" data-toggle="tab">Datos Sucursales</a>
        </li>
        <li><a href="#2" style="font-size: 20px;" data-toggle="tab">Datos Empleados</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="1">
            <div class="card-body">
                <div class="input-group mb-3">
                    <div class="col-lg-4 col-md-6 col-xs-12">
                        <h4>Sucursal</h4>
                        <select onchange="CbOnchange(this.value,1)" name="Sucursales" id="Sucursales" class="select2 form-control select2-size-md">
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
                </div>
                <div class="input-group mb-3" style="display: none;" id="CardUplocales">
                    <hr>
                           <div class="col-lg-4 col-md-6 col-xs-12">
                        <h4>Meta del local</h4>
                        <div class="input-group margin-bottom-20">
                            <div class="input-group-btn"><label for="ig-1" class="btn btn-default"><i class="fa fa-dollar"></i></label></div>
                            <input id="MetaLocal" step="0.01" min="0" type="number" class="form-control" placeholder="0.00">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-xs-12">
                        <h4>Meta de rotacion</h4>
                        <div class="input-group margin-bottom-20">
                            <div class="input-group-btn"><label for="ig-1" class="btn btn-default"><i class="fa fa-percent"></i></label></div>
                            <input id="Saslocal" min="0" type="number" class="form-control" placeholder="0%">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-xs-12" style="display: none;">
                        <h4>Score Visita Fantasma</h4>
                        <div class="input-group margin-bottom-20">
                            <div class="input-group-btn"><label for="ig-1" class="btn btn-default"><i class="fa fa-percent"></i></label></div>
                            <input id="SasFantasma" min="0" type="number" class="form-control" placeholder="0%">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-xs-12" style="margin-top: 30px;">
                        <h4></h4>
                        <div class="input-group margin-bottom-20">
                            <button onclick="btnActualizar()" class="btn btn-success">Actualizar</button>
                        </div>
                    </div> 
                    <div class="input-group mb-3" style="display: none;" id="CardUpempSuc">
                        <code>*Para actualizar los datos presione enter en la casilla correspondiente</code><br><br>
                        <code>*Para actualizar La tabla u archivo de excel presione</code>
                        <button onclick="RefreshExcelLocales()" class="btn-info"><i class="fas fa-sync-alt"></i></button>

                        <hr>
                        <div class="table-responsive">
                            <table id="tablaDSucursales" style="width: 100%; font-weight: bold;" class="table-bordered display compact">


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="2">
            <div class="card-body">
                <div class="input-group mb-3">
                    <div class="col-lg-4 col-md-6 col-xs-12">
                        <h4>Sucursal</h4>
                        <select style="width: 100%;" onchange="CbOnchange(this.value,2)" name="Sucursales" id="Sucursales2" class="select2 form-control">
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
                    <div class="col-lg-6 col-md-6 col-xs-12">

                    </div>
                </div>
                <div class="input-group mb-3" style="display: none;" id="CardUpemp">
                    <hr>
                    <code>*Para actualizar los datos presione enter en la casilla correspondiente</code><br><br>
                    <code>* Despues de hacer un cambio Presionar para Refrescar excel</code>
                    <button onclick="RefreshExcel()" class="btn-info"><i class="fas fa-sync-alt"></i></button>
                    <hr>
                    <div class="table-responsive">
                        <table id="tablaVendedores" style="width: 100%; font-weight: bold;" class="table-bordered display table-sm">

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php require 'views/footer.php'; ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/locale/es.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/datatables.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">

<script>
    $("#page-title").text("Administracion de Datos");

    $('.select2').select2({
        placeholder: "Seleccione Sucursal"
    });

    function CbOnchange(id, tipo) {

        console.log(tipo);
        validarAdminDatos(id, tipo);
    }

    function btnActualizar() {

        ACtualizarDatosLocales();
    }

    function RefreshExcel() {
        var cb = $("#Sucursales2").val();
        validarAdminDatos(cb, 2);
    }

    function RefreshExcelLocales() {
        var cb = $("#Sucursales").val();
        validarAdminDatos(cb, 1);
    }
</script>