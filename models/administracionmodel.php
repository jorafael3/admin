<?php
class AdministracionModel extends Model
{

    public function __construct()
    {
        parent::__construct();
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

    function ConsultarDatosLocales($parametros)
    {
        $id = $parametros["id"];

        try {
            $items = [];
            $query = $this->db->connect()->prepare("SELECT * FROM SIS_SUCURSALES_PROPIEDADES  WITH(NOLOCK) WHERE codigo = :id");
            $query->bindParam(":id", $id, PDO::PARAM_STR);

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
    function ActualizarDatosLocales2($parametros)
    {
        $id = $parametros["id"];
        $meta = $parametros["meta"];
        $mes = $parametros["mes"];

        $bandera = false;
        try {
            $items = [];
            $query = $this->db->connect()->prepare("{CALL VEN_SET_META_SUCURSAL (?,?,?)}");
            $query->bindParam(1, $id, PDO::PARAM_STR);
            $query->bindParam(2, $meta, PDO::PARAM_STR);
            $query->bindParam(3, $mes, PDO::PARAM_STR);


            if ($query->execute()) {
                $bandera = true;
                echo json_encode($bandera);
                exit();
            } else {
                $err = $query->errorInfo();
                echo json_encode($err);
                exit();
            }
        } catch (PDOException $e) {
            print_r($query->errorInfo());
        }
    }

    function ActualizarDatosLocales($parametros)
    {
        $id = $parametros["id"];
        $meta = $parametros["meta"];
        $rotacion = $parametros["rotacion"];

        $mes = "";
        $bandera = false;
        try {
            $items = [];
            $query = $this->db->connect()->prepare("{CALL VEN_SET_META_SUCURSAL (?,?,?,?)}");
            $query->bindParam(1, $id, PDO::PARAM_STR);
            $query->bindParam(2, $meta, PDO::PARAM_STR);
            $query->bindParam(3, $mes, PDO::PARAM_STR);
            $query->bindParam(4, $rotacion, PDO::PARAM_STR);



            if ($query->execute()) {
                $bandera = true;
                echo json_encode($bandera);
                exit();
            } else {
                $err = $query->errorInfo();
                echo json_encode($err);
                exit();
            }
        } catch (PDOException $e) {
            print_r($query->errorInfo());
        }
    }

    function ObtenerDatosEmpleados()
    {

    }

    function ActualizarSasVendedores($parametros)
    {
        $id = $parametros["ID"];
        $sas = $parametros["sas"];
        $fantasma = $parametros["fantasma"];


        $bandera = false;
        try {
            $items = [];
            $query = $this->db->connect()->prepare("{CALL VEN_SET_SATISFACCIONCLIENTE_EMPLEADO (?,?,?)}");
            $query->bindParam(1, $id, PDO::PARAM_STR);
            $query->bindParam(2, $sas, PDO::PARAM_STR);
            $query->bindParam(3, $fantasma, PDO::PARAM_STR);

            if ($query->execute()) {
                $bandera = true;
                echo json_encode($bandera);
                exit();
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
