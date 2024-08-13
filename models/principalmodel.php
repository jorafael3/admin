<?php
class PrincipalModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }


    function ConsultarVentasVendedores($parametros)
    {
        $fechaIni = $parametros["fechaIni"];
        $fechaFin = $parametros["fechaFin"];

        try {
            $items = [];
            $query = $this->db->connect()->prepare("{CALL  SIS_TOP_NACIONAL_VENDEDORES_COMPUTRON (?,?)}");
            $query->bindParam(1, $fechaIni, PDO::PARAM_STR);
            $query->bindParam(2, $fechaFin, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                echo json_encode($result);
                exit();
                $bandera = true;
            } else {
                $err = $query->errorInfo();
                echo json_encode($err);
                exit();
            }
        } catch (PDOException $e) {
            print_r($query->errorInfo());
        }
    }
}
