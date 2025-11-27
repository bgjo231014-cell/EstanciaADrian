<?php
require_once __DIR__ . '/../models/BackupModel.php';

class BackupController {

    private $model;

    public function __construct() {
        $this->model = new BackupModel();
    }

    public function index() {
        include __DIR__ . '/../views/backup_restore.php';
    }

    public function generar() {

        $archivo = $this->model->generarBackup();

        header("Content-Disposition: attachment; filename=" . basename($archivo));
        header("Content-Type: application/sql");
        readfile($archivo);
        exit();
    }
}
