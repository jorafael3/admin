<?php
require("public/fpdf/fpdf.php");
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
                    $SO = PHP_OS;
                    if ($SO  == "Linux") {
                        $directorio_archivo = "../api/docs/";
                    } else {
                        $directorio_archivo = "../credito_express_api/docs/";
                    }
                    for ($i = 0; $i < count($result); $i++) {
                        $result[$i]["existe"] = 0;
                        $result[$i]["ruta"] = 0;
                        if ($result[$i]["archivo"] != null) {
                            $result[$i]["existe"] = file_exists($directorio_archivo . $result[$i]["archivo"]);
                            $result[$i]["ruta"] = $directorio_archivo . $result[$i]["archivo"];
                        }
                    }

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

    function Generar_pdf($param)
    {
        $API = $param["datos"];
        $ID_UNICO = $param["id_unico"];
        $ip = $param["ip"];
        $fechaConsulta = $param["fecha"];
        $cedula = $param["cedula"];


        if (count($API) > 0) {
            $cedula = $API["SOCIODEMOGRAFICO"][0]["IDENTIFICACION"];
            $nombre = $API["SOCIODEMOGRAFICO"][0]["NOMBRE"];
        } else {
            $cedula = $param["cedula"];
            $nombre  = "";
        }


        // $fechaConsulta = new Date();
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        // Título
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 10, utf8_decode('AUTORIZACIÓN PARA EL TRATAMIENTO DE DATOS PERSONALES'), 0, 1, 'C');
        $pdf->Cell(0, 2, utf8_decode('BANCO SOLIDARIO S.A.'), 0, 1, 'C');
        $pdf->Ln(3);

        // Contenido
        $pdf->SetFont('Arial', '', 9);
        $contenido = utf8_decode("
    Declaración de Capacidad legal y sobre la Aceptación:\n
    Por medio de la presente autorizo de manera libre, voluntaria, previa, informada e inequívoca a BANCO SOLIDARIO
    S.A. para que en los términos legalmente establecidos realice el tratamiento de mis datos personales como parte de
    la relación precontractual, contractual y post contractual para: \n
    El procesamiento, análisis, investigación, estadísticas, referencias y demás trámites para facilitar, promover, permitir
    o mantener las relaciones con el BANCO. \n
    Cuantas veces sean necesarias, gestione, obtenga y valide de cualquier entidad pública y/o privada que se encuentre
    facultada en el país, de forma expresa a la Dirección General de Registro Civil, Identificación y Cedulación, a la Dirección
    Nacional de Registros Públicos, al Servicio de Referencias Crediticias, a los burós de información crediticia, instituciones
    financieras de crédito, de cobranza, compañías emisoras o administradoras de tarjetas de crédito, personas naturales
    y los establecimientos de comercio, personas señaladas como referencias, empleador o cualquier otra entidad y demás
    fuentes legales de información autorizadas para operar en el país, información y/o documentación relacionada con mi
    perfil, capacidad de pago y/o cumplimiento de obligaciones, para validar los datos que he proporcionado, y luego de
    mi aceptación sean registrados para el desarrollo legítimo de la relación jurídica o comercial, así como para realizar
    actividades de tratamiento sobre mi comportamiento crediticio, manejo y movimiento de cuentas bancarias, tarjetas
    de crédito, activos, pasivos, datos/referencias personales y/o patrimoniales del pasado, del presente y las que se
    generen en el futuro, sea como deudor principal, codeudor o garante, y en general, sobre el cumplimiento de mis
    obligaciones. Faculto expresamente al Banco para transferir o entregar a las mismas personas o entidades, la
    información relacionada con mi comportamiento crediticio. Esta expresa autorización la otorgo al Banco o a cualquier
    cesionario o endosatario. \n
    Tratar, transferir y/o entregar la información que se obtenga en virtud de esta solicitud incluida la relacionada con mi
    comportamiento crediticio y la que se genere durante la relación jurídica o comercial a autoridades competentes,
    terceros, socios comerciales y/o adquirientes de cartera, para el tratamiento de mis datos personales conforme los
    fines detallados en esta autorización o que me contacten por cualquier medio para ofrecerme los distintos servicios y
    productos que integran su portafolio y su gestión, relacionados o no con los servicios financieros del BANCO. En caso
    de que el BANCO ceda o transfiera cartera adeudada por mí, el cesionario o adquiriente de dicha cartera queda desde
    ahora expresamente facultado para realizar las mismas actividades establecidas en esta autorización.\n
    Entiendo y acepto que mi información personal podrá ser almacenada de manera impresa o digital, y accederán a ella
    los funcionarios de BANCO SOLIDARIO, estando obligados a cumplir con la legislación aplicable a las políticas de
    confidencialidad, protección de datos y sigilo bancario. En caso de que exista una negativa u oposición para el
    tratamiento de estos datos, no podré disfrutar de los servicios o funcionalidades que el BANCO ofrece y no podrá
    suministrarme productos, ni proveerme sus servicios o contactarme y en general cumplir con varias de las finalidades
    descritas en la Política. \n
    El BANCO conservará la información personal al menos durante el tiempo que dure la relación comercial y el que sea
    necesario para cumplir con la normativa respectiva del sector relativa a la conservación de archivos. \n
    Declaro conocer que para el desarrollo de los propósitos previstos en el presente documento y para fines
    precontractuales, contractuales y post contractuales es indispensable el tratamiento de mis datos personales
    conforme a la Política disponible en la página web del BANCO www.banco-solidario.com/transparencia Asimismo,
    declaro haber sido informado por el BANCO de los derechos con que cuento para conocer, actualizar y rectificar mi
    información personal; así como, si no deseo continuar recibiendo información comercial y/o publicidad, deberé remitir
    mi requerimiento a través del proceso de atención de derechos ARSO+ en cualquier momento y sin costo alguno,
    utilizando la página web (www.banco-solidario.com), teléfono: 1700 765 432, comunicado escrito o en cualquiera de
    las agencias del BANCO. \n
    En virtud de que, para ciertos productos y servicios el BANCO requiere o solicita el tratamiento de datos personales
    de un tercero que como cliente podré facilitar, como por ejemplo referencias comerciales o de contacto, garantizo
    que, si proporciono datos personales de terceras personas, les he solicitado su aceptación e informado acerca de las
    finalidades y la forma en la que el BANCO necesita tratar sus datos personales. \n
    Para la comunicación de sus datos personales se tomarán las medidas de seguridad adecuadas conforme la normativa
    vigente.\n
   
    ");
        $pdf->MultiCell(0, 4, $contenido);
        $pdf->Ln(3);

        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 10, utf8_decode('AUTORIZACIÓN EXPLÍCITA DE TRATAMIENTO DE DATOS PERSONALES'), 0, 1, 'C');
        $pdf->Cell(0, 2, utf8_decode('BANCO SOLIDARIO S.A.'), 0, 1, 'C');
        $pdf->Ln(3);

        $pdf->SetFont('Arial', '', 9);
        $contenido = utf8_decode("
    Declaro que soy el titular de la información reportada, y que la he suministrado de forma voluntaria, completa,
    confiable, veraz, exacta y verídica:\n
    Como titular de los datos personales, particularmente el código dactilar, dato biométrico facial, no me encuentro
    obligado a otorgar mi autorización de tratamiento a menos que requiera consultar y/o aplicar a un producto y/o
    servicio financiero. A través de la siguiente autorización libre, especifica, previa, informada, inequívoca y explícita,
    faculto al tratamiento (recopilación, acceso, consulta, registro, almacenamiento, procesamiento, análisis, elaboración
    de perfiles, comunicación o transferencia y eliminación) de mis datos personales incluido el código dactilar con la
    finalidad de: consultar y/o aplicar a un producto y/o servicio financiero y ser sujeto de decisiones basadas única o
    parcialmente en valoraciones que sean producto de procesos automatizados, incluida la elaboración de perfiles. Esta
    información será conservada por el plazo estipulado en la normativa aplicable. \n
    Así mismo, declaro haber sido informado por el BANCO de los derechos con que cuento para conocer, actualizar y
    rectificar mi información personal, así como, los establecidos en el artículo 20 de la LOPDP y remitir mi requerimiento
    a través del proceso de atención de derechos ARSO+; en cualquier momento y sin costo alguno, utilizando la página
    web (www.banco-solidario.com), teléfono: 1700 765 432, comunicado escrito o en cualquiera de las agencias del
    BANCO. \n
    Para proteger esta información conozco que el Banco cuenta con medidas técnicas y organizativas de seguridad
    adaptadas a los riesgos como, por ejemplo: anonimización, cifrado, enmascarado y seudonimización. \n
    Con la lectura de este documento manifiesto que he sido informado sobre el Tratamiento de mis Datos Personales, y
    otorgo mi autorización y aceptación de forma voluntaria y verídica. En señal de aceptación suscribo el presente
    documento. 
    ");

        $pdf->MultiCell(0, 4, $contenido);
        $pdf->Ln(3);

        // $fecha = DateTime::createFromFormat('YmdHis', $fechaConsulta);
        // $fechaFormateada = $fecha->format('Y-m-d H:i A');
        // Información del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 5, '      CLIENTE: ', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 6, "      " . utf8_decode($nombre) . " - " . $cedula, 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 5, "      " . utf8_decode('ACEPTÓ TERMINOS Y CONDICIONES: '), 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 6, "      " . $fechaConsulta, 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 5, utf8_decode('      DIRECCIÓN IP: '), 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 6,  "      " . $ip, 0, 1, 'L');


        $nombreArchivo = $ID_UNICO . ".pdf"; // Nombre del archivo PDF

        $SO = PHP_OS;
        if ($SO  == "Linux") {
            $directorio_archivo = "../api/docs/";
        } else {
            $directorio_archivo = "../credito_express_api/docs/";
        }

        if (chmod($directorio_archivo, 0777)) {
            // echo "Permisos cambiados exitosamente.";
        }

        $pdf->Output($directorio_archivo . $nombreArchivo, 'F');

        // if ($pdf->Output($directorio_archivo . $nombreArchivo, 'F')) {
        //     echo json_encode(1);
        //     exit();
        // } else {
        //     echo json_encode(0);
        //     exit();
        // }

        try {
            $query = $this->db->connect()->prepare('UPDATE creditossolicitados
            set archivo = :ruta_archivo
            where id_unico = :cedula
            ');
            $query->bindParam(":ruta_archivo", $nombreArchivo, PDO::PARAM_STR);
            $query->bindParam(":cedula", $ID_UNICO, PDO::PARAM_STR);
            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode(1);
                exit();
                // return 1;
            } else {
                // return 0;
            }
        } catch (PDOException $e) {
            $e = $e->getMessage();
            echo json_encode($e);
            exit();
        }
    }
}
