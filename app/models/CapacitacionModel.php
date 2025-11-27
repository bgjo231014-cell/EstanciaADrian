<?php
require_once(__DIR__ . '/Model.php');

class CapacitacionModel extends Model
{
    protected $table = 'capacitacion';
    protected $idField = 'id_capacitacion';

    /**
     * Obtener todas las filas ordenadas por año (desc).
     */
    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY año DESC";
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
     * Insertar un registro nuevo.
     */
    public function insert(array $data)
    {
        $columns = array_keys($data);
        $placeholders = implode(', ', array_fill(0, count($columns), '?'));

        $sql = "INSERT INTO {$this->table} (" . implode(', ', $columns) . ")
                VALUES ($placeholders)";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            error_log("❌ Error al preparar INSERT en capacitación: " . $this->db->error);
            return false;
        }

        // Todos los campos son numéricos o textos → los tratamos como "s" (string)
        $types = str_repeat('s', count($columns));
        $values = array_values($data);

        $stmt->bind_param($types, ...$values);
        $ok = $stmt->execute();

        if (!$ok) {
            error_log("❌ Error al insertar capacitación: " . $stmt->error);
        }

        $stmt->close();
        return $ok;
    }

    /**
     * Actualizar un registro existente por id.
     */
    public function update($id, array $data)
    {
        $columns = array_keys($data);
        $setParts = [];
        foreach ($columns as $col) {
            $setParts[] = "$col = ?";
        }
        $setClause = implode(', ', $setParts);

        $sql = "UPDATE {$this->table} SET $setClause WHERE {$this->idField} = ?";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            error_log("❌ Error al preparar UPDATE en capacitación: " . $this->db->error);
            return false;
        }

        $types = str_repeat('s', count($columns)) . 'i';
        $values = array_values($data);
        $values[] = (int)$id;

        $stmt->bind_param($types, ...$values);
        $ok = $stmt->execute();

        if (!$ok) {
            error_log("❌ Error al actualizar capacitación: " . $stmt->error);
        }

        $stmt->close();
        return $ok;
    }

    /**
     * Eliminar un registro por id.
     */
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE {$this->idField} = ?";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            error_log("❌ Error al preparar DELETE en capacitación: " . $this->db->error);
            return false;
        }

        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();

        if (!$ok) {
            error_log("❌ Error al eliminar capacitación: " . $stmt->error);
        }

        $stmt->close();
        return $ok;
    }
}
?>
