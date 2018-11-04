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
			<h2>Listado de Factura</h2>
		</div>
		<form>
			<div class="row">
				<div class="col-100">
					<div class="table">
						<table>
							<tr>
								<th>Código</th>
								<th>Fecha</th>
								<th>Cedula cliente</th>
								<th>Nombre cliente</th>
								<th>Apellido cliente</th>
								<th></th>
							</tr>
							<?php
								foreach ($invoice as $item) {
									echo '<tr>';
									echo '<td>'.$item->codigo.'</td>';
									echo '<td>'.$item->fecha.'</td>';
									echo '<td>'.$item->cedula.'</td>';
									echo '<td>'.$item->nombre.'</td>';
									echo '<td>'.$item->apellido.'</td>';
									echo '<td><a class="button button-danger" style="text-decoration:none" href="editar-factura.php?id='.$item->id.'">Editar</a></td>';
									echo '</tr>';
								}
							?>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<input type="submit" class="button" value="Guardar">
				<a class="button button-danger" href="index.php" style="text-decoration:none">Cancelar</a>
			</div>
		</form>
	<?php include('footer.php');?>
</body>
</html>