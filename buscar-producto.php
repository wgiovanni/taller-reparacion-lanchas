<?php
require_once('models/product.php');
$products = new Product();
$products = $products->getAll();
//$conexion = new mysqli('servidor','usuario','password','basedatos',3306);
//$matricula = $_GET['term'];
//$consulta = "select matricula FROM tblalumno WHERE matricula LIKE '%$matricula%'";
echo json_encode($products);

?>