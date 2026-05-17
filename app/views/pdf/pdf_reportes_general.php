<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte General del Sistema Ambiental</title>

<style>
body {
    font-family: Arial, sans-serif;
    font-size: 12px;
    color: #222;
}

h2 {
    text-align: center;
    margin-bottom: 10px;
    color: #117a65;
}

h4 {
    text-align: center;
    margin-top: 0;
    margin-bottom: 20px;
    color: #555;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    margin-bottom: 18px;
}

th, td {
    border: 1px solid black;
    padding: 5px;
    text-align: center;
}

th {
    background: #e0e0e0;
}

.section-title {
    margin-top: 20px;
    font-size: 14px;
    font-weight: bold;
    text-align: left;
    color: #117a65;
}

.barra-contenedor {
    width: 100%;
    height: 14px;
    background: #e5e5e5;
    border: 1px solid #ccc;
}

.barra {
    height: 14px;
    background: #117a65;
}

.footer {
    margin-top: 25px;
    text-align: center;
    font-size: 10px;
    color: #666;
}
</style>
</head>

<body>

<?php
// $data, $anioSeleccionado y $indicadores vienen del controlador
$anio = $anioSeleccionado ?? null;
?>

<h2>Reporte General del Sistema Ambiental</h2>

<h4>
    <?= $anio ? "Año " . htmlspecialchars($anio) : "Todos los años disponibles" ?>
</h4>

<!-- ========================== -->
<!--   RESUMEN CON BARRAS HTML  -->
<!-- ========================== -->
<div class="section-title">Resumen General de Indicadores</div>

<table>
<thead>
<tr>
    <th>Indicador</th>
    <th>Total</th>
    <th>Representación</th>
</tr>
</thead>

<tbody>
<?php foreach (($indicadores ?? []) as $ind): ?>
    <?php
        $valor = (float)($ind['valor'] ?? 0);
        $unidad = $ind['unidad'] ?? '';

        $porcentajeBarra = $maxValor > 0
            ? ($valor / $maxValor) * 100
            : 0;

        if ($porcentajeBarra < 2 && $valor > 0) {
            $porcentajeBarra = 2;
        }
    ?>

    <tr>
        <td><?= htmlspecialchars($ind['nombre'] ?? '') ?></td>
        <td>
            <?= number_format($valor, 2) ?>
            <?= htmlspecialchars($unidad) ?>
        </td>
        <td>
            <div class="barra-contenedor">
                <div class="barra" style="width: <?= number_format($porcentajeBarra, 2) ?>%;"></div>
            </div>
        </td>
    </tr>
<?php endforeach; ?>
</tbody>
</table>

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
<?php foreach (($data['combustibles'] ?? []) as $c): ?>
<tr>
    <td><?= htmlspecialchars($c['anio'] ?? '') ?></td>
    <td><?= htmlspecialchars(ucfirst($c['tipo_combustible'] ?? '')) ?></td>
    <td><?= number_format((float)($c['litros'] ?? 0), 2) ?></td>
    <td><?= number_format((float)($c['co2'] ?? 0), 2) ?></td>
    <td>$<?= number_format((float)($c['costos'] ?? 0), 2) ?></td>
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
<?php foreach (($data['rsu'] ?? []) as $r): ?>
<tr>
    <td><?= htmlspecialchars($r['anio'] ?? '') ?></td>
    <td><?= number_format((float)($r['total_kg'] ?? 0), 2) ?></td>
    <td><?= number_format((float)($r['total_tn'] ?? 0), 2) ?></td>
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
<?php foreach (($data['agua'] ?? []) as $a): ?>
<tr>
    <td><?= htmlspecialchars($a['anio'] ?? '') ?></td>
    <td><?= number_format((float)($a['total_m3'] ?? 0), 2) ?></td>
    <td>$<?= number_format((float)($a['total_costo'] ?? 0), 2) ?></td>
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
<?php foreach (($data['electricidad'] ?? []) as $e): ?>
<tr>
    <td><?= htmlspecialchars($e['anio'] ?? '') ?></td>
    <td><?= number_format((float)($e['total_kw'] ?? 0), 2) ?></td>
    <td>$<?= number_format((float)($e['total_costo'] ?? 0), 2) ?></td>
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
    <th>Total Registros</th>
    <th>Promedio Personal</th>
    <th>Total Personal</th>
</tr>
</thead>

<tbody>
<?php foreach (($data['comunidad'] ?? []) as $c): ?>
<tr>
    <td><?= htmlspecialchars($c['anio'] ?? '') ?></td>
    <td><?= number_format((float)($c['total_registros'] ?? 0), 0) ?></td>
    <td><?= number_format((float)($c['promedio_personal'] ?? 0), 2) ?></td>
    <td><?= number_format((float)($c['total_personal'] ?? 0), 2) ?></td>
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
    <th>Total Registros</th>
    <th>Total Capacitados</th>
    <th>Total Verdadero</th>
    <th>Hombres</th>
    <th>Mujeres</th>
    <th>% Hombres</th>
    <th>% Mujeres</th>
</tr>
</thead>

<tbody>
<?php foreach (($data['capacitacion'] ?? []) as $c): ?>
<tr>
    <td><?= htmlspecialchars($c['anio'] ?? '') ?></td>
    <td><?= number_format((float)($c['total_registros'] ?? 0), 0) ?></td>
    <td><?= number_format((float)($c['total_capacitados'] ?? 0), 2) ?></td>
    <td><?= number_format((float)($c['total_verdadero'] ?? 0), 2) ?></td>
    <td><?= number_format((float)($c['hombres'] ?? 0), 0) ?></td>
    <td><?= number_format((float)($c['mujeres'] ?? 0), 0) ?></td>
    <td><?= number_format((float)($c['porcentaje_hombres'] ?? 0), 2) ?>%</td>
    <td><?= number_format((float)($c['porcentaje_mujeres'] ?? 0), 2) ?>%</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<div class="footer">
    Reporte generado automáticamente por el Sistema de Gestión Ambiental CECAM.
</div>

</body>
</html>