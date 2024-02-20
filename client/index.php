<?php

require_once ("Routes.php");

$routes = new Routes();

// Aqui se decodifica o lee la respuesta archivo json
$registros = json_decode(file_get_contents($url = $routes->getUrlBase().'/server/tareas'), true);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Bienvenido</title>
</head>
<body>
    <?php
    echo $routes->getHomeMenu()."&nbsp;&nbsp;&nbsp;&nbsp;".$routes->getNewMenu(); ?>
    <br>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>TÍTULO</th>
                <th>DESCRIPCIÓN</th>
                <th>PRIORIDAD</th>
                <th>OPCIONES</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($registros as $registro) {
                echo "<tr>";
                echo "<td>".$registro['id']."</td>";
                echo "<td>".$registro['titulo']."</td>";
                echo "<td>".$registro['descripcion']."</td>";
                echo "<td>".$registro['prioridad']."</td>";
                echo "<td>".$routes->getUpdateMenu($registro['id'])."&nbsp;&nbsp;&nbsp;&nbsp;".$routes->getDeleteMenu($registro['id'])."</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>