<?php


class TopVendedores extends Controller
{

    function __construct()
    {

        parent::__construct();
        //$this->view->render('principal/index');
        //echo "nuevo controlaodr";
    }
    function render()
    {
        $this->view->render('topvendedores/index');
    }

    function Vendedores()
    {
        $sucursales =  $this->model->ConsultarSucursales();
        $this->view->suc = $sucursales;
        $this->render();
    }
    
    function ConsultarVentasVendedores()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->ConsultarVentasVendedores($array);
    }
}
