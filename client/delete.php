<?php
require_once("Routes.php");

$routes = new Routes();

$id = $_GET['id'];

$url = $routes->getUrlBase()."/server/tareas/".$id;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
$result    = curl_exec($ch);
$httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
$resultado = "No fue posible eliminar el registro";

if($result){
    $resultado = "Registro eliminado exitosamente";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Eliminar <?= $id ?></title>
</head>
<body>
    <?php echo
    $routes->getHomeMenu()."&nbsp;&nbsp;&nbsp;&nbsp;".$routes->getNewMenu(); ?>
    <br>
    <?php echo $resultado; ?>
</body>
</html>