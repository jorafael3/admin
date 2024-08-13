<?php
class ReportesModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }


    function Cargar_Consultas($param)
    {
        try {

            if (isset($_SESSION["Usuario"])) {

                // $ORDEN = $param["ORDEN"];


                $SQL = "SELECT * FROM creditossolicitados";

                $query = $this->db->connect()->prepare($SQL);
                // $query->bindParam(":ORDEN", $ORDEN, PDO::PARAM_STR);

                if ($query->execute()) {
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    $res = array(
                        "success" => true,
                        "data" => $result,
                        "sql" => ""
                    );
                    echo json_encode($res);
                    exit();
                } else {
                    $err = $query->errorInfo();
                    $res = array(
                        "success" => false,
                        "data" => $err,
                        "sql" => ""
                    );
                    echo json_encode($res);
                    exit();
                }
            }
        } catch (PDOException $e) {
            $e = $e->getMessage();
            echo json_encode($e);
            exit();
        }
    }
}
