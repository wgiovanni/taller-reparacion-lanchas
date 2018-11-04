<?php
require_once('models/Invoice.php');
require_once('models/WayToPay.php');
require_once('models/Product.php');
require_once('models/Customer.php');
require_once('models/DetailInvoice.php');

if (isset($_GET['id'])){
	$invoice = new Invoice();
	$invoice = $invoice->getId($_GET['id']);
	$wayToPay1 = new WayToPay();
	$wayToPay1 = $wayToPay1->getId($invoice->id_forma_pago);
	//print_r($invoice);
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('head.php');?>	
</head>
<body>
	<?php include('principal.php');?>	
<?php

	if (!$invoice->es_impresa){
		$wayToPay = new WayToPay();
		$wayToPay = $wayToPay->getAll();
		$products = new Product();
		$products = $products->getAll();
		$customer = new Customer();
		$customer = $customer->getId($invoice->id_cliente);
		$detailInvoice = new DetailInvoice();
		$detailInvoice = $detailInvoice->getByIdInvoice($invoice->id);
?>
		<div class="row">
			<h2>Editar Factura</h2>
		</div>
		<form method="post" action="guardar.php">
			<div class="row">
				<div class="col-15">
					<label>Fecha Emisión: </label>
				</div>
				<div class="col-35">
					<input type="text" name="fecha-cliente" value="<?php echo $invoice->fecha; ?>" disabled="true">
				</div>
				<div class="col-15">
					<label>Forma de pago</label>
				</div>
				<div class="col-35">
					<select name="forma-pago" required>
						<option disabled="disabled" value="<?php echo $wayToPay1->id; ?>"><?php echo $wayToPay1->nombre; ?></option>
						<?php
							foreach ($wayToPay as $item):
							print_r($item);	
							?>
							<option value="<?php echo $item->id; ?>"><?php echo $item->nombre; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			
			<div class="row">
				<h3>Cliente</h3>
				<div class="col-100">	
					<hr/>
				</div>
			</div>

			<div class="row">
				<div class="col-15">
					<label>Nacionalidad</label>
				</div>
				<div class="col-35">
					<select name="nacionalidad-cliente">
						<option disabled="disabled" value="<?php echo $customer->nacionalidad; ?>"><?php echo $customer->nacionalidad; ?></option>
						<option value="V">V</option>
						<option value="E">E</option>
					</select>
				</div>
				<div class="col-15">
					<label>Cédula: </label>
				</div>
				<div class="col-35">
					<input type="text" name="ci-cliente" id="ci-cliente" value="<?php echo $customer->cedula;?>" placeholder="Ingrese la Cédula">
				</div>
			</div>
			<div class="row">
				<div class="col-15">
					<label>Nombre: </label>
				</div>
				<div class="col-35">
					<input type="text" name="nombre-cliente" id="nombre-cliente" value="<?php echo $customer->nombre; ?>" placeholder="Ingrese el nombre">
				</div>
				<div class="col-15">
					<label>Apellido: </label>
				</div>
				<div class="col-35">
					<input type="text" name="apellido-cliente" id="apellido-cliente" value="<?php echo $customer->apellido; ?>" placeholder="Ingrese el apellido">
				</div>
			</div>
			<div class="row">
				<div class="col-15">
					<label>Teléfono: </label>
				</div>
				<div class="col-35">
					<input type="text" name="tlf-cliente" id="tlf-cliente" value="<?php echo $customer->telefono; ?>" placeholder="Ingrese el Teléfono">
				</div>
				<div class="col-15">
					<label>E-mail: </label>
				</div>
				<div class="col-35">
					<input type="text" name="email-cliente" id="email-cliente" value="<?php echo $customer->email; ?>" placeholder="Ingrese el Email">
				</div>
			</div>
			<div class="row">
				<div class="col-15">
					<label>Dirección: </label>
				</div>
				<div class="col-85">
					<input type="text" name="dir-cliente" id="dir-cliente" value="<?php echo $customer->direccion;?>" placeholder="Ingrese la Dirección">
				</div>
			</div>
			<div class="row">
				<h3>Producto</h3>
				<div class="col-100">	
					<hr/>
				</div>
			</div>
			<div class="row">
				<div>
					<div class="col-15">
						<label>Código producto: </label>
					</div>
					<div class="col-35">
						<input type="text" name="codigo-producto" id="codigo-producto" placeholder="Ingrese el código del producto">
					</div>
				</div>
				<div class="col-15">
					<label>Nombre producto: </label>
				</div>
				<div class="col-35">
					<input type="text" name="nombre-producto" id="nombre-producto" disabled="true">
				</div>
			</div>
			<div class="row">
				<div class="col-15">
					<label>Descripción: </label>
				</div>
				<div class="col-85">
					<input type="text" name="descripcion-producto" id="descripcion-producto" disabled="true">
				</div>
			</div>
			<div class="row">
				<div class="col-15">
					<label>Precio: </label>
				</div>
				<div class="col-35">
					<input type="text" name="precio-producto" id="precio-producto" disabled="true">
				</div>
				<div class="col-15">
					<label>Cantidad: </label>
				</div>
				<div class="col-35">
					<input type="text" name="cantidad-producto" placeholder="Ingrese la cantidad de productos">						
				</div>
			</div>
			<div class="row">
				<button class="button">Agregar</button>
				<button class="button button-danger">Limpiar</button>
			</div>
			<div class="row">
				<h2>Detalles</h2>
				<div class="col-100">
					<hr/>
				</div>
			</div>
			<div class="row">
				<div class="col-100">
					<div class="table">
						<table>
							<tr>
								<th>Código</th>
								<th>Nombre</th>
								<th>Descripción</th>
								<th>P. unitario</th>
								<th>Cantidad</th>
								<th>Descuentos</th>
								<th>Total</th>
								<th></th>
							</tr>
							<?php 
								foreach ($detailInvoice as $item) {
									echo '<tr>';
									echo '<td>'.$item->codigo.'</td>';
									echo '<td>'.$item->nombre.'</td>';
									echo '<td>'.$item->descripcion.'</td>';
									echo '<td>'.$item->precio.'</td>';
									echo '<td>'.$item->cantidad_productos.'</td>';
									echo '<td></td>';
									echo '<td>'.$item->cantidad_productos*$item->precio.'</td>';
									echo '<td><a class="button button-danger" style="text-decoration:none" href="#">Eliminar</a></td>';
									echo '</tr>';
								}
							?>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<input type="submit" class="button" value="Guardar">
				<a class="button button-danger" style="text-decoration:none" href="index.php">Cancelar</a>
			</div>
		</form>
	<?php include('footer.php'); ?>
</body>
</html>
<?php
	} else {
		$wayToPay = new WayToPay();
		$wayToPay = $wayToPay->getAll();
		$products = new Product();
		$products = $products->getAll();
		$customer = new Customer();
		$customer = $customer->getId($invoice->id_cliente);
		$detailInvoice = new DetailInvoice();
		$detailInvoice = $detailInvoice->getByIdInvoice($invoice->id);

	?>
		<div class="row">
			<h2>Nueva Factura</h2>
		</div>
		<form method="post" action="guardar.php">
			<div class="row">
				<div class="col-15">
					<label>Fecha Emisión: </label>
				</div>
				<div class="col-35">
					<input type="text" name="fecha-cliente" value="<?php echo $invoice->fecha; ?>" disabled="true">
				</div>
				<div class="col-15">
					<label>Forma de pago</label>
				</div>
				<div class="col-35">
					<select name="forma-pago">
						<option disabled="disabled" value="<?php echo $wayToPay1->id; ?>"><?php echo $wayToPay1->nombre; ?></option>
						<?php
							foreach ($wayToPay as $item):
							print_r($item);	
							?>
							<option value="<?php echo $item->id; ?>"><?php echo $item->nombre; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			
			<div class="row">
				<h3>Cliente</h3>
				<div class="col-100">	
					<hr/>
				</div>
			</div>

			<div class="row">
				<div class="col-15">
					<label>Nacionalidad</label>
				</div>
				<div class="col-35">
					<select name="nacionalidad-cliente">
						<option disabled="disabled" value="<?php echo $customer->nacionalidad; ?>"><?php echo $customer->nacionalidad; ?></option>
						<option value="V">V</option>
						<option value="E">E</option>
					</select>
				</div>
				<div class="col-15">
					<label>Cédula: </label>
				</div>
				<div class="col-35">
					<input type="text" name="ci-cliente" id="ci-cliente" value="<?php echo $customer->cedula;?>" placeholder="Ingrese la Cédula">
				</div>
			</div>
			<div class="row">
				<div class="col-15">
					<label>Nombre: </label>
				</div>
				<div class="col-35">
					<input type="text" name="nombre-cliente" id="nombre-cliente" value="<?php echo $customer->nombre; ?>" placeholder="Ingrese el nombre">
				</div>
				<div class="col-15">
					<label>Apellido: </label>
				</div>
				<div class="col-35">
					<input type="text" name="apellido-cliente" id="apellido-cliente" value="<?php echo $customer->apellido; ?>" placeholder="Ingrese el apellido">
				</div>
			</div>
			<div class="row">
				<div class="col-15">
					<label>Teléfono: </label>
				</div>
				<div class="col-35">
					<input type="text" name="tlf-cliente" id="tlf-cliente" value="<?php echo $customer->telefono; ?>" placeholder="Ingrese el Teléfono">
				</div>
				<div class="col-15">
					<label>E-mail: </label>
				</div>
				<div class="col-35">
					<input type="text" name="email-cliente" id="email-cliente" value="<?php echo $customer->email; ?>" placeholder="Ingrese el Email">
				</div>
			</div>
			<div class="row">
				<div class="col-15">
					<label>Dirección: </label>
				</div>
				<div class="col-85">
					<input type="text" name="dir-cliente" id="dir-cliente" value="<?php echo $customer->direccion;?>" placeholder="Ingrese la Dirección">
				</div>
			</div>
			<div class="row">
				<h3>Producto</h3>
				<div class="col-100">	
					<hr/>
				</div>
			</div>
			<div class="row">
				<div>
					<div class="col-15">
						<label>Código producto: </label>
					</div>
					<div class="col-35">
						<input type="text" name="codigo-producto" id="codigo-producto" placeholder="Ingrese el código del producto">
					</div>
				</div>
				<div class="col-15">
					<label>Nombre producto: </label>
				</div>
				<div class="col-35">
					<input type="text" name="nombre-producto" id="nombre-producto" disabled="true">
				</div>
			</div>
			<div class="row">
				<div class="col-15">
					<label>Descripción: </label>
				</div>
				<div class="col-85">
					<input type="text" name="descripcion-producto" id="descripcion-producto" disabled="true">
				</div>
			</div>
			<div class="row">
				<div class="col-15">
					<label>Precio: </label>
				</div>
				<div class="col-35">
					<input type="text" name="precio-producto" id="precio-producto" disabled="true">
				</div>
				<div class="col-15">
					<label>Cantidad: </label>
				</div>
				<div class="col-35">
					<input type="text" name="cantidad-producto" placeholder="Ingrese la cantidad de productos">						
				</div>
			</div>
			<div class="row">
				<button class="button">Agregar</button>
				<button class="button button-danger">Limpiar</button>
			</div>
			<div class="row">
				<h2>Detalles</h2>
				<div class="col-100">
					<hr/>
				</div>
			</div>
			<div class="row">
				<div class="col-100">
					<div class="table">
						<table>
							<tr>
								<th>Código</th>
								<th>Nombre</th>
								<th>Descripción</th>
								<th>P. unitario</th>
								<th>Cantidad</th>
								<th>Descuentos</th>
								<th>Total</th>
								<th></th>
							</tr>
							<?php 
								foreach ($detailInvoice as $item) {
									echo '<tr>';
									echo '<td>'.$item->codigo.'</td>';
									echo '<td>'.$item->nombre.'</td>';
									echo '<td>'.$item->descripcion.'</td>';
									echo '<td>'.$item->precio.'</td>';
									echo '<td>'.$item->cantidad_productos.'</td>';
									echo '<td></td>';
									echo '<td>'.$item->cantidad_productos*$item->precio.'</td>';
									echo '<td><a class="button button-danger" style="text-decoration:none" href="#">Eliminar</a></td>';
									echo '</tr>';
								}
							?>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<input type="submit" class="button" value="Guardar">
				<a class="button button-danger" style="text-decoration:none" href="index.php">Cancelar</a>
			</div>
		</form>
	<?php include('footer.php'); ?>
</body>
</html>
<?php
	}
}
?>


