<?php

class BackupModel {

    public function generarBackup() {

        $host = "localhost";
        $user = "root";
        $pass = "";
        $db   = "estancia";

        $mysqli = new mysqli($host, $user, $pass, $db);
        $mysqli->set_charset("utf8mb4");

        $resultadoTablas = $mysqli->query("SHOW TABLES");

        $tablas = [];
        while ($row = $resultadoTablas->fetch_row()) {
            $tablas[] = $row[0];
        }

        $sql = "SET FOREIGN_KEY_CHECKS=0;\n\n";
        $sql .= "\nSET FOREIGN_KEY_CHECKS=1;\n";

        foreach ($tablas as $tabla) {

            // Crear tabla
            $res = $mysqli->query("SHOW CREATE TABLE `$tabla`");
            $row = $res->fetch_row();
            $createTable = $row[1];

// Quitar constraints FOREIGN KEY para evitar errores al restaurar
$createTable = preg_replace('/,\s*CONSTRAINT\s+`[^`]+`\s+FOREIGN KEY\s+\([^)]+\)\s+REFERENCES\s+`[^`]+`\s+\([^)]+\)(\s+ON DELETE\s+\w+)?(\s+ON UPDATE\s+\w+)?/i', '', $createTable);

// Quitar comas sobrantes antes del cierre
$createTable = preg_replace('/,\s*\)/', "\n)", $createTable);

$sql .= "\n\nDROP TABLE IF EXISTS `$tabla`;\n";
$sql .= $createTable . ";\n\n";

            // Datos
            $resDatos = $mysqli->query("SELECT * FROM `$tabla`");

            while ($fila = $resDatos->fetch_assoc()) {

                $columnas = array_keys($fila);
                $sql .= "INSERT INTO `$tabla` (`" . implode("`,`", $columnas) . "`) VALUES(";

                $values = [];

                foreach ($fila as $valor) {

                    if (is_null($valor)) {
                        $values[] = "NULL"; // <-- Manejo correcto
                    } else {
                        // escapado correcto
                        $valorSeguro = addslashes($valor);
                        $valorSeguro = str_replace("\n", "\\n", $valorSeguro);

                        $values[] = "'" . $valorSeguro . "'";
                    }
                }

                $sql .= implode(",", $values) . ");\n";
            }
        }

        $fecha = date("Y-m-d_H-i-s");
        $ruta = "config/backups/respaldo_$fecha.sql";

        file_put_contents($ruta, $sql);

        return $ruta;
    }
}
