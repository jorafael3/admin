<?php
class TopLocalesModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

 
    function ConsultarVentaslocales($parametros)
    {
        $fechaIni = $parametros["fechaIni"];
        $fechaFin = $parametros["fechaFin"];

        try {
            $items = [];
            $query = $this->db->connect()->prepare("{CALL VEN_TOP_LOCALES_COMPUTRON (?,?)}");
            $query->bindParam(1, $fechaIni, PDO::PARAM_STR);
            $query->bindParam(2, $fechaFin, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $c = 0;
                /* foreach ($result as $row) {
                    $productos["cedula"] = $row['cli_ruc'];
                    $productos["nombre"] = $row['cli_name'];
                    $productos["email"] = $row['cli_email'];
                    $productos["dir"] = $row['cli_dir'];
                    $productos["telf"] = $row['cli_telf'];
                    $productos["estado"] = $row['cli_estado'];
                    $items[$c] = $productos;
                    $c = $c + 1;
                }*/
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
