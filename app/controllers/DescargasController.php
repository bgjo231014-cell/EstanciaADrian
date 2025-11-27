<?php

class DescargasController
{
    private $baseDir;

    public function __construct($connection = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Carpeta donde se guardan todos los archivos públicos
        $this->baseDir = __DIR__ . '/../../public/descargas/';

        if (!is_dir($this->baseDir)) {
            mkdir($this->baseDir, 0777, true);
        }
    }

    /**
     * Verifica si el usuario puede subir / eliminar archivos
     * Admin (1) y Personal CECAM (2)
     */
    private function puedeGestionar()
    {
        $usuario = $_SESSION['usuario'] ?? null;
        if (!$usuario) return false;

        $idRol = $usuario['idRol'] ?? null;
        $rolNombre = $usuario['rol'] ?? null;

        if (in_array($idRol, [1, 2])) return true;
        if (in_array($rolNombre, ['Administrador', 'Personal', 'CECAM'])) return true;

        return false;
    }

    /**
     * Subir archivo al tablón de descargas
     */
    public function subir()
    {
        if (!$this->puedeGestionar()) {
            header("Location: index.php?view=descargas");
            exit();
        }

        if (empty($_FILES['archivo']['name'])) {
            header("Location: index.php?view=descargas");
            exit();
        }

        $nombreOriginal = basename($_FILES['archivo']['name']);
        // Nombre seguro (sin caracteres raros)
        $nombreSeguro = preg_replace('/[^A-Za-z0-9_\.\-]/', '_', $nombreOriginal);

        // Para evitar choques de nombres, le podemos anteponer fecha/hora
        $nombreFinal = date('Ymd_His') . '_' . $nombreSeguro;

        $destino = $this->baseDir . $nombreFinal;

        if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
            move_uploaded_file($_FILES['archivo']['tmp_name'], $destino);
        }

        header("Location: index.php?view=descargas");
        exit();
    }

    /**
     * Eliminar archivo del tablón de descargas
     */
    public function eliminar()
    {
        if (!$this->puedeGestionar()) {
            header("Location: index.php?view=descargas");
            exit();
        }

        if (!empty($_POST['archivo'])) {
            $archivo = basename($_POST['archivo']); // sanea
            $ruta    = $this->baseDir . $archivo;

            if (is_file($ruta)) {
                unlink($ruta);
            }
        }

        header("Location: index.php?view=descargas");
        exit();
    }
}
