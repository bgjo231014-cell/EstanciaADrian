<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte General del Sistema Ambiental</title>
<style>
body { font-family: Arial, sans-serif; font-size: 12px; }
h2 { text-align: center; margin-bottom: 10px; }
h4 { text-align: center; margin-top: 0; margin-bottom: 20px; }
table { width: 100%; border-collapse: collapse; margin-top: 10px; }
th, td {
    border: 1px solid black;
    padding: 4px;
    text-align: center;
}
th { background: #e0e0e0; }
.section-title {
    margin-top: 20px;
    font-size: 14px;
    font-weight: bold;
    text-align: left;
}
img.grafica {
    width: 100%;
    max-height: 300px;
    object-fit: contain;
    margin-top: 10px;
    margin-bottom: 20px;
}
</style>
</head>
<body>

<?php
// $data y $anioSeleccionadoVista vienen del controlador
$anio = $anioSeleccionadoVista ?? null;

// Intentar cargar la gráfica guardada
$graficaDataUri = null;
$graficaFile = __DIR__ . '/../../../public/descargas/grafica_general.png';
if (file_exists($graficaFile)) {
    $imgData = base64_encode(file_get_contents($graficaFile));
    $graficaDataUri = 'data:image/png;base64,' . $imgData;
}
?>

<h2>Reporte General del Sistema Ambiental</h2>
<h4>
    <?= $anio ? "Año " . htmlspecialchars($anio) : "Todos los años disponibles" ?>
</h4>

<?php if ($graficaDataUri): ?>
    <div class="section-title">Gráfica General de Indicadores</div>
    <img class="grafica" src="<?= $graficaDataUri ?>" alt="Gráfica General">
<?php endif; ?>

<!-- ========================== -->
<!--   COMBUSTIBLES             -->
<!-- ========================== -->
<div class="section-title">Combustibles</div>
<table>
<thead>
<tr>
    <th>Año</th>
    <th>Tipo</th>
    <th>Litros</th>
    <th>CO₂ (kg)</th>
    <th>Costo ($)</th>
</tr>
</thead>
<tbody>
<?php foreach($data['combustibles'] as $c): ?>
<tr>
    <td><?= $c['anio'] ?></td>
    <td><?= ucfirst($c['tipo_combustible']) ?></td>
    <td><?= number_format($c['litros'],2) ?></td>
    <td><?= number_format($c['co2'],2) ?></td>
    <td>$<?= number_format($c['costos'],2) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<!-- ========================== -->
<!--   RSU                      -->
<!-- ========================== -->
<div class="section-title">Residuos Sólidos Urbanos (RSU)</div>
<table>
<thead>
<tr>
    <th>Año</th>
    <th>Total Kg</th>
    <th>Total Toneladas</th>
</tr>
</thead>
<tbody>
<?php foreach($data['rsu'] as $r): ?>
<tr>
    <td><?= $r['anio'] ?></td>
    <td><?= number_format($r['total_kg'],2) ?></td>
    <td><?= number_format($r['total_tn'],2) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<!-- ========================== -->
<!--   AGUA                     -->
<!-- ========================== -->
<div class="section-title">Consumo de Agua</div>
<table>
<thead>
<tr>
    <th>Año</th>
    <th>Total m³</th>
    <th>Total Costos ($)</th>
</tr>
</thead>
<tbody>
<?php foreach($data['agua'] as $a): ?>
<tr>
    <td><?= $a['anio'] ?></td>
    <td><?= number_format($a['total_m3'],2) ?></td>
    <td><?= number_format($a['total_costo'],2) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<!-- ========================== -->
<!--   ELECTRICIDAD             -->
<!-- ========================== -->
<div class="section-title">Electricidad</div>
<table>
<thead>
<tr>
    <th>Año</th>
    <th>Total kW</th>
    <th>Total Costos ($)</th>
</tr>
</thead>
<tbody>
<?php foreach($data['electricidad'] as $e): ?>
<tr>
    <td><?= $e['anio'] ?></td>
    <td><?= number_format($e['total_kw'],2) ?></td>
    <td><?= number_format($e['total_costo'],2) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<!-- ========================== -->
<!--   COMUNIDAD                -->
<!-- ========================== -->
<div class="section-title">Comunidad</div>
<table>
<thead>
<tr>
    <th>Año</th>
    <th>Promedio Personal</th>
    <th>Total Personal</th>
</tr>
</thead>
<tbody>
<?php foreach($data['comunidad'] as $c): ?>
<tr>
    <td><?= $c['año'] ?></td>
    <td><?= number_format($c['promedio_personal'],2) ?></td>
    <td><?= number_format($c['total_personal'],2) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<!-- ========================== -->
<!--   CAPACITACIÓN             -->
<!-- ========================== -->
<div class="section-title">Capacitación</div>
<table>
<thead>
<tr>
    <th>Año</th>
    <th>Total Capacitados</th>
    <th>Hombres</th>
    <th>Mujeres</th>
</tr>
</thead>
<tbody>
<?php foreach($data['capacitacion'] as $c): ?>
<tr>
    <td><?= $c['año'] ?></td>
    <td><?= number_format($c['total_capacitados'],2) ?></td>
    <td><?= $c['hombres'] ?></td>
    <td><?= $c['mujeres'] ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</body>
</html>
