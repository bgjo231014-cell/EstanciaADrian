<?php
require_once(__DIR__ . '/Model.php');

class CapacitacionModel extends Model
{
    protected $table = 'capacitacion';
    protected $idField = 'id_capacitacion';

    /**
     * Obtener todas las filas ordenadas por año y mes.
     */
    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table} 
                ORDER BY año DESC, id_capacitacion DESC";

        $result = $this->db->query($sql);

        $data = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    /**
     * Obtener un registro por ID.
     */
    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->idField} = ?";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            error_log("Error al preparar SELECT capacitación: " . $this->db->error);
            return null;
        }

        $id = (int)$id;
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result ? $result->fetch_assoc() : null;

        $stmt->close();

        return $row;
    }

    /**
     * Insertar un registro nuevo.
     */
    public function insert(array $data)
    {
        $data = $this->prepararDatos($data);

        $columns = array_keys($data);
        $placeholders = implode(', ', array_fill(0, count($columns), '?'));

        $sql = "INSERT INTO {$this->table} (`" . implode('`, `', $columns) . "`)
                VALUES ($placeholders)";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            error_log("Error al preparar INSERT en capacitación: " . $this->db->error);
            return false;
        }

        $types = str_repeat('s', count($columns));
        $values = array_values($data);

        $stmt->bind_param($types, ...$values);
        $ok = $stmt->execute();

        if (!$ok) {
            error_log("Error al insertar capacitación: " . $stmt->error);
        }

        $stmt->close();

        return $ok;
    }

    /**
     * Actualizar un registro existente por ID.
     */
    public function update($id, array $data)
    {
        $data = $this->prepararDatos($data);

        $columns = array_keys($data);
        $setParts = [];

        foreach ($columns as $col) {
            $setParts[] = "`$col` = ?";
        }

        $setClause = implode(', ', $setParts);

        $sql = "UPDATE {$this->table} 
                SET $setClause 
                WHERE {$this->idField} = ?";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            error_log("Error al preparar UPDATE en capacitación: " . $this->db->error);
            return false;
        }

        $types = str_repeat('s', count($columns)) . 'i';
        $values = array_values($data);
        $values[] = (int)$id;

        $stmt->bind_param($types, ...$values);
        $ok = $stmt->execute();

        if (!$ok) {
            error_log("Error al actualizar capacitación: " . $stmt->error);
        }

        $stmt->close();

        return $ok;
    }

    /**
     * Eliminar un registro por ID.
     */
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE {$this->idField} = ?";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            error_log("Error al preparar DELETE en capacitación: " . $this->db->error);
            return false;
        }

        $id = (int)$id;
        $stmt->bind_param("i", $id);

        $ok = $stmt->execute();

        if (!$ok) {
            error_log("Error al eliminar capacitación: " . $stmt->error);
        }

        $stmt->close();

        return $ok;
    }

    /**
     * Preparar datos antes de guardar.
     */
    private function prepararDatos(array $data)
    {
        $datos = [];

        $datos['año'] = isset($data['año']) ? (int)$data['año'] : 0;
        $datos['mes'] = trim($data['mes'] ?? '');
        $datos['descripcion'] = trim($data['descripcion'] ?? '');

        $datos['admvos'] = $this->num($data, 'admvos');
        $datos['ptcs'] = $this->num($data, 'ptcs');
        $datos['honorarios'] = $this->num($data, 'honorarios');
        $datos['pa'] = $this->num($data, 'pa');
        $datos['docentes'] = $this->num($data, 'docentes');
        $datos['jardineros'] = $this->num($data, 'jardineros');
        $datos['servicio_limpieza'] = $this->num($data, 'servicio_limpieza');
        $datos['seguridad'] = $this->num($data, 'seguridad');
        $datos['visitantes'] = $this->num($data, 'visitantes');
        $datos['personas_externas_capacitadas'] = $this->num($data, 'personas_externas_capacitadas');

        $datos['cantidad_hombres'] = $this->num($data, 'cantidad_hombres');
        $datos['cantidad_mujeres'] = $this->num($data, 'cantidad_mujeres');

        $totales = $this->calcularTotales($datos);

        $datos['cantidad_total_capa'] = $totales['cantidad_total_capa'];
        $datos['total_empirico'] = $totales['total_empirico'];
        $datos['calculo_total_verdadero'] = $totales['calculo_total_verdadero'];
        $datos['total_verdadero_final'] = $totales['total_verdadero_final'];
        $datos['porcentaje_hombres'] = $totales['porcentaje_hombres'];
        $datos['porcentaje_mujeres'] = $totales['porcentaje_mujeres'];

        return $datos;
    }

    /**
     * Calcular totales automáticamente.
     */
    private function calcularTotales(array $data)
    {
        $cantidadTotal =
            $this->num($data, 'admvos') +
            $this->num($data, 'ptcs') +
            $this->num($data, 'honorarios') +
            $this->num($data, 'pa') +
            $this->num($data, 'docentes') +
            $this->num($data, 'jardineros') +
            $this->num($data, 'servicio_limpieza') +
            $this->num($data, 'seguridad') +
            $this->num($data, 'visitantes') +
            $this->num($data, 'personas_externas_capacitadas');

        $hombres = $this->num($data, 'cantidad_hombres');
        $mujeres = $this->num($data, 'cantidad_mujeres');

        $totalGenero = $hombres + $mujeres;

        $porcentajeHombres = $totalGenero > 0
            ? ($hombres / $totalGenero) * 100
            : 0;

        $porcentajeMujeres = $totalGenero > 0
            ? ($mujeres / $totalGenero) * 100
            : 0;

        return [
            'cantidad_total_capa' => $cantidadTotal,
            'total_empirico' => $cantidadTotal,
            'calculo_total_verdadero' => $cantidadTotal,
            'total_verdadero_final' => $cantidadTotal,
            'porcentaje_hombres' => $porcentajeHombres,
            'porcentaje_mujeres' => $porcentajeMujeres
        ];
    }

    /**
     * Convertir campos numéricos.
     */
    private function num(array $data, string $key)
    {
        if (!isset($data[$key]) || $data[$key] === '') {
            return 0;
        }

        return (float)$data[$key];
    }
}
?>