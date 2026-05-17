<?php
// app/models/RSUModel.php

class RSUModel
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    /* ============================
       HELPERS
    ============================ */
    private function num($data, $key)
    {
        if (!isset($data[$key]) || $data[$key] === '') return 0.0;
        return (float)$data[$key];
    }

    /* ============================
       OBTENER TODOS LOS REGISTROS
    ============================ */
    public function obtenerRegistros(): array
    {
        $registros = [];
        $sql = "SELECT * FROM rsu ORDER BY mes DESC";

        if ($result = $this->conn->query($sql)) {
            $registros = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        }

        return $registros;
    }

    /* ============================
       CREAR REGISTRO
    ============================ */
    public function agregarRegistro(array $data): bool
    {
        $mes = $data['mes'] ?? '';
        if (empty($mes) || !strtotime($mes)) {
            return false;
        }

        // Materiales
        $basura          = $this->num($data, 'basura_kg');
        $basura_organica = $this->num($data, 'basura_organica_kg');
        $papel           = $this->num($data, 'papel_kg');
        $carton          = $this->num($data, 'carton_kg');
        $pet             = $this->num($data, 'pet_kg');
        $otros_plas      = $this->num($data, 'otros_plasticos_kg');
        $vidrio          = $this->num($data, 'vidrio_kg');
        $aluminio        = $this->num($data, 'aluminio_kg');
        $hojalata        = $this->num($data, 'hojalata_kg');
        $fierro          = $this->num($data, 'fierro_kg');

        // Totales básicos
        $total_registro = $basura + $basura_organica + $papel + $carton + $pet +
                          $otros_plas + $vidrio + $aluminio + $hojalata + $fierro;

        $total_cuatrimestre          = 0.0;
        $kg_co2_persona_cuatrimestre = 0.0;
        $tn_cuatrimestre             = $total_registro / 1000.0;

        $sql = "INSERT INTO rsu
                (mes, basura_kg, basura_organica_kg, papel_kg, carton_kg, pet_kg,
                 otros_plasticos_kg, vidrio_kg, aluminio_kg, hojalata_kg, fierro_kg,
                 total_registro, total_cuatrimestre, kg_co2_persona_cuatrimestre, tn_cuatrimestre)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if (!$stmt = $this->conn->prepare($sql)) {
            error_log("Error preparar INSERT RSU: " . $this->conn->error);
            return false;
        }

        $stmt->bind_param(
            "sdddddddddddddd",
            $mes,
            $basura,
            $basura_organica,
            $papel,
            $carton,
            $pet,
            $otros_plas,
            $vidrio,
            $aluminio,
            $hojalata,
            $fierro,
            $total_registro,
            $total_cuatrimestre,
            $kg_co2_persona_cuatrimestre,
            $tn_cuatrimestre
        );

        $ok = $stmt->execute();

        if (!$ok) {
            error_log("Error ejecutar INSERT RSU: " . $stmt->error);
        }

        $stmt->close();
        return $ok;
    }

    /* ============================
       ACTUALIZAR REGISTRO
    ============================ */
    public function actualizarRegistro(array $data): bool
    {
        $id = isset($data['id']) ? (int)$data['id'] : 0;

        if ($id <= 0) {
            error_log("RSUModel::actualizarRegistro() -> ID inválido: " . ($data['id'] ?? 'null'));
            return false;
        }

        $mes = $data['mes'] ?? '';

        if (empty($mes) || !strtotime($mes)) {
            error_log("RSUModel::actualizarRegistro() -> mes inválido: " . $mes);
            return false;
        }

        // Materiales
        $basura          = $this->num($data, 'basura_kg');
        $basura_organica = $this->num($data, 'basura_organica_kg');
        $papel           = $this->num($data, 'papel_kg');
        $carton          = $this->num($data, 'carton_kg');
        $pet             = $this->num($data, 'pet_kg');
        $otros_plas      = $this->num($data, 'otros_plasticos_kg');
        $vidrio          = $this->num($data, 'vidrio_kg');
        $aluminio        = $this->num($data, 'aluminio_kg');
        $hojalata        = $this->num($data, 'hojalata_kg');
        $fierro          = $this->num($data, 'fierro_kg');

        $total_registro = $basura + $basura_organica + $papel + $carton + $pet +
                          $otros_plas + $vidrio + $aluminio + $hojalata + $fierro;

        $total_cuatrimestre          = 0.0;
        $kg_co2_persona_cuatrimestre = 0.0;
        $tn_cuatrimestre             = $total_registro / 1000.0;

        $sql = "UPDATE rsu SET
                    mes = ?,
                    basura_kg = ?,
                    basura_organica_kg = ?,
                    papel_kg = ?,
                    carton_kg = ?,
                    pet_kg = ?,
                    otros_plasticos_kg = ?,
                    vidrio_kg = ?,
                    aluminio_kg = ?,
                    hojalata_kg = ?,
                    fierro_kg = ?,
                    total_registro = ?,
                    total_cuatrimestre = ?,
                    kg_co2_persona_cuatrimestre = ?,
                    tn_cuatrimestre = ?
                WHERE id = ?";

        if (!$stmt = $this->conn->prepare($sql)) {
            error_log("Error preparar UPDATE RSU: " . $this->conn->error);
            return false;
        }

        $stmt->bind_param(
            "sddddddddddddddi",
            $mes,
            $basura,
            $basura_organica,
            $papel,
            $carton,
            $pet,
            $otros_plas,
            $vidrio,
            $aluminio,
            $hojalata,
            $fierro,
            $total_registro,
            $total_cuatrimestre,
            $kg_co2_persona_cuatrimestre,
            $tn_cuatrimestre,
            $id
        );

        $ok = $stmt->execute();

        if (!$ok) {
            error_log("Error ejecutar UPDATE RSU: " . $stmt->error);
        } else {
            error_log("RSUModel::actualizarRegistro() -> filas afectadas: " . $stmt->affected_rows);
        }

        $stmt->close();
        return $ok;
    }

    /* ============================
       ELIMINAR REGISTRO
    ============================ */
    public function eliminarRegistro(int $id): bool
    {
        if ($id <= 0) return false;

        if (!$stmt = $this->conn->prepare("DELETE FROM rsu WHERE id = ?")) {
            error_log("Error preparar DELETE RSU: " . $this->conn->error);
            return false;
        }

        $stmt->bind_param("i", $id);

        $ok = $stmt->execute();

        if (!$ok) {
            error_log("Error ejecutar DELETE RSU: " . $stmt->error);
        }

        $stmt->close();
        return $ok;
    }

    /* ============================
       OBTENER POR ID
    ============================ */
    public function obtenerRegistroPorId(int $id): ?array
    {
        if ($id <= 0) return null;

        $sql = "SELECT * FROM rsu WHERE id = ?";

        if (!$stmt = $this->conn->prepare($sql)) {
            error_log("Error preparar SELECT RSU por ID: " . $this->conn->error);
            return null;
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $res = $stmt->get_result();
        $row = $res->fetch_assoc() ?: null;

        $stmt->close();

        return $row;
    }
}