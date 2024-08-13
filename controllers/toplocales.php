<?php


class TopLocales extends Controller
{

    function __construct()
    {

        parent::__construct();
        //$this->view->render('principal/index');
        //echo "nuevo controlaodr";
    }
    function render()
    {
        if ($_SESSION['userAcces'] == "7") {
            $this->view->render('errores/errores');
        } else {
            $this->view->render('toplocales/index');
        }
    }

    function Locales()
    {
        $this->render();
    }

    function ConsultarVentaslocales()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->ConsultarVentaslocales($array);
    }
}
