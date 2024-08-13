<?php


class Administracion extends Controller
{

    function __construct()
    {

        parent::__construct();
        //$this->view->render('principal/index');
        //echo "nuevo controlaodr";
    }
    function render()
    {
       if ($_SESSION['userAcces'] == "1") {
            $this->view->render('administracion/index');
        } else {
            $this->view->render('errores/errores');
        }
    }

    function Admin()
    {
        $sucursales =  $this->model->ConsultarSucursales();
        $this->view->suc = $sucursales;
        $this->render();
    }

    function ConsultarDatosLocales()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->ConsultarDatosLocales($array);
    }
    function ActualizarDatosLocales()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->ActualizarDatosLocales($array);
    }
    function ActualizarSasVendedores()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->ActualizarSasVendedores($array);
    }
}
