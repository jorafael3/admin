<?php
class TopVendedoresModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }


    function ConsultarVentasVendedores($parametros)
    {
        $fechaIni = $parametros["fechaIni"];
        $fechaFin = $parametros["fechaFin"];
        $sucursal = $parametros["sucursal"];
        $items = [];
        $c = 0;
        try {
            $items = [];
            $query = $this->db->connect()->prepare("{CALL VEN_TOP_VENDEDORES_COMPUTRON (?,?,?)}");
            $query->bindParam(1, $sucursal, PDO::PARAM_STR);
            $query->bindParam(2, $fechaIni, PDO::PARAM_STR);
            $query->bindParam(3, $fechaFin, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $row) {
                    $productos["ID"] = $row['ID'];
                    $productos["Margen"] = $row['Margen'];
                    $productos["Meta"] = $row['Meta'];
                    $productos["Nombre"] = $row['Nombre'];
                    $productos["PrimerApellido"] = $row['PrimerApellido'];
                    $productos["NombreGrafico"] =  $row['PrimerApellido'] . " " . $row['PrimerNombre'];
                    $productos["SatisfaccionCliente"] = $row['SatisfaccionCliente'];
                    $productos["value"] = round($row['value'], 2);
                    $productos["track"] = $c + 1;
                    $productos["ScoreTotal"] = round($row['scoreTotal'], 2);
                    $productos["PorcentajeMeta"] = round($row['Porcentajemeta'], 2);
                    $productos["ScoreVisitaFantasma"] = $row["ScoreVisitaFantasma"];
                    $items[$c] = $productos;
                    $c = $c + 1;
                }
                echo json_encode($items);
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

    public function ConsultarSucursales()
    {

        $items = [];
        try {

            $query = $this->db->connect()->query("SIS_LOCALES_COMPUTRON");
            if (!$query->execute()) {
                print_r($query->errorInfo());
            }
            // $query->execute(['GrupoID' => $id]);
            while ($row = $query->fetch()) {
                $item["ID"]  = $row['Sucursal'];
                $item["Nombre"]  = $row['Nombre'];

                array_push($items, $item);
            }
            //echo json_encode($items);
            //exit();         
            return $items;
        } catch (PDOException $e) {
            return [];
            echo $e->getMessage();
        }
    }
}
