<?php
$conexion = new mysqli("localhost", "root", "", "SENATIDB", "3306");

$consulta = $conexion->query("SELECT SD.sede, SD.idsede, EMP.apellidos, EMP.nombres, EMP.ndocumento, EMP.fechanac, EMP.telefono FROM empleados EMP INNER JOIN sedes SD ON EMP.idsede=SD.idsede");

while ($datos = $consulta->fetch_object()) {
    ?>
    <tr>
        <td class="text-center"><?= $datos->ndocumento ?></td>
        <td class="text-center"><?= $datos->nombres ?></td>
        <td class="text-center"><?= $datos->apellidos ?></td>
        <td class="text-center"><?= $datos->sede ?></td>
        <td class="text-center"><?= $datos->fechanac ?></td>
        <td class="text-center"><?= $datos->telefono ?></td>
    </tr>
    <?php
}
?>
