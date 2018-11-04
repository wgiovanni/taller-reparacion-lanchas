<?php
require_once('models/Product.php');

if (isset($_GET['term'])){

	print_r($_GET);
	$products = new Product();
	$products = $products->getAll();

	return json_encode($products);
}

?>