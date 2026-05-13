<?php

class RestoreModel {
    public function restaurarBD($archivo) {

        $host = "localhost";
        $user = "root";
        $pass = "";
        $db   = "estancia"; // nombre de la  BD

        $mysqli = new mysqli($host, $user, $pass, $db);

        if ($mysqli->connect_error) {
            die("Error de conexión: " . $mysqli->connect_error);
        }

        $mysqli->set_charset("utf8mb4");

        // 0. APAGAR llaves foráneas
        $mysqli->query("SET FOREIGN_KEY_CHECKS = 0");

        // 1. Borrar todas las tablas actuales
        $result = $mysqli->query("SHOW TABLES");
        if ($result) {
            while ($row = $result->fetch_array()) {
                $tabla = $row[0];
                $mysqli->query("DROP TABLE IF EXISTS `$tabla`");
            }
        }

        // 2. Leer archivo .sql
        $sql = file_get_contents($archivo);
        if ($sql === false) {
            die("No se pudo leer el archivo SQL.");
        }

        // 3. Separar en sentencias por ';'
        $queries = explode(";", $sql);

        // 4. Ejecutar cada sentencia
        foreach ($queries as $query) {
            $query = trim($query);
            // Saltar vacías o comentarios
            if ($query === '' || strpos($query, '--') === 0 || strpos($query, '/*') === 0) {
                continue;
            }
            if (!$mysqli->query($query)) {
                // SOLO para depurar (puedes quitarlo si ya todo funciona)
                echo "Error en consulta:<br><pre>$query</pre><br>";
                echo "MySQL dijo: " . $mysqli->error . "<hr>";
            }
        }
        // 5. VOLVER A ENCENDER llaves foráneas
        $mysqli->query("SET FOREIGN_KEY_CHECKS = 1");

        return true;
    }
}
