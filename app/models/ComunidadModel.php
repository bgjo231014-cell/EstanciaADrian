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
        $sql = "SELECT * FROM comunidad ORDER BY año DESC, id_comunidad DESC";
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

        if (!isset($data['año']) || !preg_match('/^\d+$/', (string)$data['año'])) {
            die("Error: El campo 'Año' solo acepta números enteros.");
        }

        $mesesValidos = [
            'enero','febrero','marzo','abril','mayo','junio',
            'julio','agosto','septiembre','octubre','noviembre','diciembre'
        ];

        $mesValidado = strtolower(trim($data['mes'] ?? ''));

        if (!in_array($mesValidado, $mesesValidos)) {
            die("Error: El campo 'Mes' debe ser un mes válido. Ejemplo: enero, febrero, marzo.");
        }

        $año = (int)$data['año'];
        $mes = $this->escapar($data['mes'] ?? '');
        $descripcion = $this->escapar($data['descripcion'] ?? '');

        $admvos = $this->num($data, 'admvos');
        $ptcs = $this->num($data, 'ptcs');
        $honorarios = $this->num($data, 'honorarios');
        $pa = $this->num($data, 'pa');
        $jardineros = $this->num($data, 'jardineros');
        $limpieza = $this->num($data, 'limpieza');
        $maestros = $this->num($data, 'maestros');
        $vigilancias = $this->num($data, 'vigilancias');
        $licenciaturas = $this->num($data, 'licenciaturas');
        $posgrados = $this->num($data, 'posgrados');

        $totales = $this->calcularTotales($data);

        $sql = "
            INSERT INTO comunidad (
                año,
                mes,
                descripcion,
                admvos,
                ptcs,
                honorarios,
                pa,
                jardineros,
                limpieza,
                maestros,
                vigilancias,
                licenciaturas,
                posgrados,
                total_personal,
                promedio
            ) VALUES (
                $año,
                '$mes',
                '$descripcion',
                $admvos,
                $ptcs,
                $honorarios,
                $pa,
                $jardineros,
                $limpieza,
                $maestros,
                $vigilancias,
                $licenciaturas,
                $posgrados,
                {$totales['total_personal']},
                {$totales['promedio']}
            )
        ";

        if (!$this->conn->query($sql)) {
            die("Error al insertar comunidad: " . $this->conn->error);
        }

        return true;
    }

    /* ============================
       ACTUALIZAR REGISTRO
    ============================ */
    public function actualizarComunidad($data) {

        if (!isset($data['id_comunidad'])) {
            die("Error: falta ID de comunidad.");
        }

        if (!isset($data['año']) || !preg_match('/^\d+$/', (string)$data['año'])) {
            die("Error: El campo 'Año' solo acepta números enteros.");
        }

        $mesesValidos = [
            'enero','febrero','marzo','abril','mayo','junio',
            'julio','agosto','septiembre','octubre','noviembre','diciembre'
        ];

        $mesValidado = strtolower(trim($data['mes'] ?? ''));

        if (!in_array($mesValidado, $mesesValidos)) {
            die("Error: El campo 'Mes' debe ser un mes válido. Ejemplo: enero, febrero, marzo.");
        }

        $id = (int)$data['id_comunidad'];
        $año = (int)$data['año'];
        $mes = $this->escapar($data['mes'] ?? '');
        $descripcion = $this->escapar($data['descripcion'] ?? '');

        $admvos = $this->num($data, 'admvos');
        $ptcs = $this->num($data, 'ptcs');
        $honorarios = $this->num($data, 'honorarios');
        $pa = $this->num($data, 'pa');
        $jardineros = $this->num($data, 'jardineros');
        $limpieza = $this->num($data, 'limpieza');
        $maestros = $this->num($data, 'maestros');
        $vigilancias = $this->num($data, 'vigilancias');
        $licenciaturas = $this->num($data, 'licenciaturas');
        $posgrados = $this->num($data, 'posgrados');

        $totales = $this->calcularTotales($data);

        $sql = "
            UPDATE comunidad SET
                año = $año,
                mes = '$mes',
                descripcion = '$descripcion',
                admvos = $admvos,
                ptcs = $ptcs,
                honorarios = $honorarios,
                pa = $pa,
                jardineros = $jardineros,
                limpieza = $limpieza,
                maestros = $maestros,
                vigilancias = $vigilancias,
                licenciaturas = $licenciaturas,
                posgrados = $posgrados,
                total_personal = {$totales['total_personal']},
                promedio = {$totales['promedio']}
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
    private function calcularTotales($data) {
        $total =
            $this->num($data, 'admvos') +
            $this->num($data, 'ptcs') +
            $this->num($data, 'honorarios') +
            $this->num($data, 'pa') +
            $this->num($data, 'jardineros') +
            $this->num($data, 'limpieza') +
            $this->num($data, 'maestros') +
            $this->num($data, 'vigilancias') +
            $this->num($data, 'licenciaturas') +
            $this->num($data, 'posgrados');

        return [
            'total_personal' => $total,
            'promedio' => $total / 10
        ];
    }

    /* ============================
       HELPERS
    ============================ */
    private function num($data, $key) {
        if (!isset($data[$key]) || $data[$key] === '') {
            return 0;
        }

        return (float)$data[$key];
    }

    private function escapar($v) {
        return $this->conn->real_escape_string($v ?? '');
    }
}
?>