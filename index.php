<?php
require_once('models/Invoice.php');
$invoice = new Invoice();
$invoice = $invoice->getAll(); 
?>

<!DOCTYPE html>
<html>
<head>
	<?php include('head.php');?>
</head>
<body>
	<?php include('principal.php'); ?>
		<div class="row">
			<h2>Bienvenidos</h2>
		</div>
		<form>
			<div class="row">
				<div class="col-15">
					<a href="listado-facturas.php" class="button delete-line" style="text-decoration:none">Listado de facturas</a>
				</div>
				<div class="col-35">
					<a href="nueva-factura.php" class="button" style="text-decoration:none">Nueva factura</a>
				</div>
			</div>
		</form>
	<?php include('footer.php');?>
</body>
</html>