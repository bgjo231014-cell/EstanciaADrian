<?php
// app/models/ComunidadModel.php

require_once __DIR__ . '/../../config/database.php';

class ComunidadModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    /* ============================
       OBTENER REGISTROS
    ============================ */
    public function obtenerComunidades() {
        $sql = "SELECT * FROM comunidad ORDER BY año DESC";
        $result = $this->conn->query($sql);

        if (!$result) {
            die("Error al obtener comunidades: " . $this->conn->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerComunidadPorId($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM comunidad WHERE id_comunidad = $id";
        $result = $this->conn->query($sql);

        if (!$result) {
            die("Error al obtener comunidad: " . $this->conn->error);
        }

        return $result->fetch_assoc();
    }

    /* ============================
       CREAR REGISTRO
    ============================ */
    public function crearComunidad($data) {

        // Validar Año
        if (!isset($data['año']) || !preg_match('/^\d+$/', (string)$data['año'])) {
            die("Error: El campo 'Año' solo acepta números enteros sin letras ni decimales.");
        }

        /* VALIDACIÓN DE MESES */
        $mesesValidos = [
            'enero','febrero','marzo','abril','mayo','junio',
            'julio','agosto','septiembre','octubre','noviembre','diciembre'
        ];

        $mes_1 = strtolower(trim($data['mes_1'] ?? ''));
        $mes_2 = strtolower(trim($data['mes_2'] ?? ''));
        $mes_3 = strtolower(trim($data['mes_3'] ?? ''));

        foreach (['mes_1'=>$mes_1,'mes_2'=>$mes_2,'mes_3'=>$mes_3] as $campo => $mes) {
            if ($mes !== '' && !in_array($mes, $mesesValidos)) {
                die("Error: El valor de '$campo' no es un mes válido.");
            }
        }

        if (count(array_filter([$mes_1,$mes_2,$mes_3])) !== count(array_unique(array_filter([$mes_1,$mes_2,$mes_3])))) {
            die("Error: No se pueden repetir los meses.");
        }

        // Sanitizar
        $año   = (int)$data['año'];
        $mes_1 = $this->escapar($data['mes_1'] ?? '');
        $mes_2 = $this->escapar($data['mes_2'] ?? '');
        $mes_3 = $this->escapar($data['mes_3'] ?? '');

        $v = fn($k) => floatval($data[$k] ?? 0);

        // Campos
        $adm1=$v('admvo_1'); $adm2=$v('admvo_2'); $adm3=$v('admvo_3');
        $ptc1=$v('ptc_1');   $ptc2=$v('ptc_2');   $ptc3=$v('ptc_3');
        $hon1=$v('honorarios_1'); $hon2=$v('honorarios_2'); $hon3=$v('honorarios_3');
        $pa1=$v('pa_1'); $pa2=$v('pa_2'); $pa3=$v('pa_3');
        $jar1=$v('jardin_1'); $jar2=$v('jardin_2'); $jar3=$v('jardin_3');
        $lim1=$v('limpieza_1'); $lim2=$v('limpieza_2'); $lim3=$v('limpieza_3');
        $man1=$v('mantto_1'); $man2=$v('mantto_2'); $man3=$v('mantto_3');
        $vig1=$v('vigilancia_1'); $vig2=$v('vigilancia_2'); $vig3=$v('vigilancia_3');
        $lic1=$v('licenciatura_1'); $lic2=$v('licenciatura_2'); $lic3=$v('licenciatura_3');
        $pos1=$v('posgrado_1'); $pos2=$v('posgrado_2'); $pos3=$v('posgrado_3');

        $tot = $this->calcularTotales($data);

        $sql = "
            INSERT INTO comunidad (
                año, mes_1, mes_2, mes_3,
                admvo_1, admvo_2, admvo_3,
                ptc_1, ptc_2, ptc_3,
                honorarios_1, honorarios_2, honorarios_3,
                pa_1, pa_2, pa_3,
                jardin_1, jardin_2, jardin_3,
                limpieza_1, limpieza_2, limpieza_3,
                mantto_1, mantto_2, mantto_3,
                vigilancia_1, vigilancia_2, vigilancia_3,
                licenciatura_1, licenciatura_2, licenciatura_3,
                posgrado_1, posgrado_2, posgrado_3,
                total_personal_1, total_personal_2, total_personal_3,
                promedio
            ) VALUES (
                $año, '$mes_1', '$mes_2', '$mes_3',
                $adm1, $adm2, $adm3,
                $ptc1, $ptc2, $ptc3,
                $hon1, $hon2, $hon3,
                $pa1, $pa2, $pa3,
                $jar1, $jar2, $jar3,
                $lim1, $lim2, $lim3,
                $man1, $man2, $man3,
                $vig1, $vig2, $vig3,
                $lic1, $lic2, $lic3,
                $pos1, $pos2, $pos3,
                {$tot['total_personal_1']}, {$tot['total_personal_2']}, {$tot['total_personal_3']},
                {$tot['promedio']}
            )";

        if (!$this->conn->query($sql)) {
            die("Error al insertar comunidad: " . $this->conn->error);
        }

        return true;
    }

    /* ============================
       EDITAR REGISTRO
    ============================ */
    public function actualizarComunidad($data) {

        if (!isset($data['id_comunidad'])) {
            die("Error: falta ID de comunidad.");
        }

        // VALIDAR AÑO
        if (!preg_match('/^\d+$/', (string)$data['año'])) {
            die("Error: El campo 'Año' solo acepta números enteros.");
        }

        /* VALIDACIÓN DE MESES */
        $mesesValidos = [
            'enero','febrero','marzo','abril','mayo','junio',
            'julio','agosto','septiembre','octubre','noviembre','diciembre'
        ];

        $m1 = strtolower(trim($data['mes_1']));
        $m2 = strtolower(trim($data['mes_2']));
        $m3 = strtolower(trim($data['mes_3']));

        foreach (['mes_1'=>$m1,'mes_2'=>$m2,'mes_3'=>$m3] as $campo => $mes) {
            if ($mes !== '' && !in_array($mes, $mesesValidos)) {
                die("Error: '$campo' no es un mes válido.");
            }
        }

        if (count(array_filter([$m1,$m2,$m3])) !== count(array_unique(array_filter([$m1,$m2,$m3])))) {
            die("Error: No se pueden repetir meses.");
        }

        // Sanitizar (la versión CORRECTA)
        $mes_1 = $this->escapar($data['mes_1']);
        $mes_2 = $this->escapar($data['mes_2']);
        $mes_3 = $this->escapar($data['mes_3']);

        $id  = (int)$data['id_comunidad'];
        $año = (int)$data['año'];

        $v = fn($k) => floatval($data[$k] ?? 0);

        $adm1=$v('admvo_1'); $adm2=$v('admvo_2'); $adm3=$v('admvo_3');
        $ptc1=$v('ptc_1');   $ptc2=$v('ptc_2');   $ptc3=$v('ptc_3');
        $hon1=$v('honorarios_1'); $hon2=$v('honorarios_2'); $hon3=$v('honorarios_3');
        $pa1=$v('pa_1'); $pa2=$v('pa_2'); $pa3=$v('pa_3');
        $jar1=$v('jardin_1'); $jar2=$v('jardin_2'); $jar3=$v('jardin_3');
        $lim1=$v('limpieza_1'); $lim2=$v('limpieza_2'); $lim3=$v('limpieza_3');
        $man1=$v('mantto_1'); $man2=$v('mantto_2'); $man3=$v('mantto_3');
        $vig1=$v('vigilancia_1'); $vig2=$v('vigilancia_2'); $vig3=$v('vigilancia_3');
        $lic1=$v('licenciatura_1'); $lic2=$v('licenciatura_2'); $lic3=$v('licenciatura_3');
        $pos1=$v('posgrado_1'); $pos2=$v('posgrado_2'); $pos3=$v('posgrado_3');

        $tot = $this->calcularTotales($data);

        $sql = "
            UPDATE comunidad SET
                año = $año,
                mes_1 = '$mes_1',
                mes_2 = '$mes_2',
                mes_3 = '$mes_3',
                admvo_1 = $adm1, admvo_2 = $adm2, admvo_3 = $adm3,
                ptc_1 = $ptc1, ptc_2 = $ptc2, ptc_3 = $ptc3,
                honorarios_1 = $hon1, honorarios_2 = $hon2, honorarios_3 = $hon3,
                pa_1 = $pa1, pa_2 = $pa2, pa_3 = $pa3,
                jardin_1 = $jar1, jardin_2 = $jar2, jardin_3 = $jar3,
                limpieza_1 = $lim1, limpieza_2 = $lim2, limpieza_3 = $lim3,
                mantto_1 = $man1, mantto_2 = $man2, mantto_3 = $man3,
                vigilancia_1 = $vig1, vigilancia_2 = $vig2, vigilancia_3 = $vig3,
                licenciatura_1 = $lic1, licenciatura_2 = $lic2, licenciatura_3 = $lic3,
                posgrado_1 = $pos1, posgrado_2 = $pos2, posgrado_3 = $pos3,
                total_personal_1 = {$tot['total_personal_1']},
                total_personal_2 = {$tot['total_personal_2']},
                total_personal_3 = {$tot['total_personal_3']},
                promedio = {$tot['promedio']}
            WHERE id_comunidad = $id
        ";

        if (!$this->conn->query($sql)) {
            die("Error al actualizar comunidad: " . $this->conn->error);
        }

        return true;
    }

    /* ============================
       ELIMINAR
    ============================ */
    public function eliminarComunidad($id) {
        $id = (int)$id;
        $sql = "DELETE FROM comunidad WHERE id_comunidad = $id";

        if (!$this->conn->query($sql)) {
            die("Error al eliminar comunidad: " . $this->conn->error);
        }
        return true;
    }

    /* ============================
       CÁLCULO DE TOTALES
    ============================ */
    private function calcularTotales($d) {
        $v = fn($k) => isset($d[$k]) ? floatval($d[$k]) : 0;

        $t1 = $v('admvo_1') + $v('ptc_1') + $v('honorarios_1') + $v('pa_1') +
              $v('jardin_1') + $v('limpieza_1') + $v('mantto_1') + $v('vigilancia_1') +
              $v('licenciatura_1') + $v('posgrado_1');

        $t2 = $v('admvo_2') + $v('ptc_2') + $v('honorarios_2') + $v('pa_2') +
              $v('jardin_2') + $v('limpieza_2') + $v('mantto_2') + $v('vigilancia_2') +
              $v('licenciatura_2') + $v('posgrado_2');

        $t3 = $v('admvo_3') + $v('ptc_3') + $v('honorarios_3') + $v('pa_3') +
              $v('jardin_3') + $v('limpieza_3') + $v('mantto_3') + $v('vigilancia_3') +
              $v('licenciatura_3') + $v('posgrado_3');

        return [
            'total_personal_1' => $t1,
            'total_personal_2' => $t2,
            'total_personal_3' => $t3,
            'promedio'         => ($t1 + $t2 + $t3) / 3
        ];
    }

    /* ============================
       HELPERS
    ============================ */
    private function escapar($v) {
        return $this->conn->real_escape_string($v ?? '');
    }
}
?>
