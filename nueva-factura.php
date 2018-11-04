<?php
require_once('models/WayToPay.php');
require_once('models/Product.php');
echo "Entro";

$wayToPay = new WayToPay();
$wayToPay = $wayToPay->getAll(); //aqui ya se obtienen todas las formas de pago disponibles
//print_r($wayToPay);
//echo '<br>';
$products = new Product();
$products = $products->getAll();
print_r($products);
$arrayCodeProduct = array();
foreach($products as $product):
array_push($arrayCodeProduct, $product->codigo);
endforeach
?>

<!DOCTYPE html>
<html>
<head>
	<?php include('head.php');?>	
</head>
<body>
	<?php include('principal.php');?>
		<div class="row">
			<h2>Crear Factura</h2>
		</div>
		<form>
			<div class="row">
				<div class="col-15">
					<label>Fecha Emisión: </label>
				</div>
				<div class="col-35">
					<input type="text" name="fecha-cliente" value="12/08/2018" disabled="true">
				</div>
				<div class="col-15">
					<label>Forma de pago</label>
				</div>
				<div class="col-35">
					<select>
						<option disabled="disabled" value=""  selected="true">Selecionar</option>
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
					<select>
						<option disabled="disabled" value=""  selected="true">Selecionar</option>
						<option value="V">V</option>
						<option value="E">E</option>
					</select>
				</div>
				<div class="col-15">
					<label>Cédula: </label>
				</div>
				<div class="col-35">
					<input type="text" name="ci-cliente" placeholder="Ingrese la Cédula">
				</div>
			</div>
			<div class="row">
				<div class="col-15">
					<label>Nombre: </label>
				</div>
				<div class="col-35">
					<input type="text" name="nombre-cliente" placeholder="Ingrese el nombre">
				</div>
				<div class="col-15">
					<label>Apellido: </label>
				</div>
				<div class="col-35">
					<input type="text" name="apellido-cliente" placeholder="Ingrese el apellido">
				</div>
			</div>
			<div class="row">
				<div class="col-15">
					<label>Teléfono: </label>
				</div>
				<div class="col-35">
					<input type="text" name="tlf-cliente" placeholder="Ingrese el Teléfono">
				</div>
				<div class="col-15">
					<label>E-mail: </label>
				</div>
				<div class="col-35">
					<input type="text" name="email-cliente" placeholder="Ingrese el Email">
				</div>
			</div>
			<div class="row">
				<div class="col-15">
					<label>Dirección: </label>
				</div>
				<div class="col-85">
					<input type="text" name="dir-cliente" placeholder="Ingrese la Dirección">
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
								<th>#</th>
								<th>Código</th>
								<th>Nombre</th>
								<th>Descripción</th>
								<th>P. Unitario</th>
								<th>Cantidad</th>
								<th>Descuentos</th>
								<th>Total</th>
								<th></th>
							</tr>
							<tr>
								<td>1</td>
								<td>Producto 131</td>
								<td>Producto 1</td>
								<td>Desc. producto 1</td>
								<td>511111881</td>
								<td>3</td>
								<td></td>
								<td>51555</td>
								<td><button class="button button-danger" href="#">Eliminar</button></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Producto 2</td>
								<td>Producto 2</td>
								<td>Desc. producto 2</td>
								<td>87811881</td>
								<td>4</td>
								<td></td>
								<td>87874555</td>
								<td><button class="button button-danger" href="#">Eliminar</button></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Producto 3</td>
								<td>Producto 3</td>
								<td>Desc. producto 3</td>
								<td>99811881</td>
								<td>1</td>
								<td></td>
								<td>4353455</td>
								<td><button class="button button-danger" href="#">Eliminar</button></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td><strong>Sub-total</strong></td>
								<td>124412362634</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td><strong>Impuestos</strong></td>
								<td>1200</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td><strong>Total</strong></td>
								<td>12009589845756</td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<input type="submit" class="button" value="Guardar">
				<button class="button button-danger">Cancelar</button>
			</div>
		</form>
	<?php include('footer.php');?>
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
		<script>
		$(document).ready(function() {
		    $('#codigo-producto').on('keyup', function() {
		        var key = $(this).val();
		        console.log(key);		
		        /*var dataString = 'key='+key;
				$.ajax({
		            type: "POST",
		            url: "ajax.php",
		            data: dataString,
		            success: function(data) {
		                //Escribimos las sugerencias que nos manda la consulta
		                $('#suggestions').fadeIn(1000).html(data);
		                //Al hacer click en alguna de las sugerencias
		                $('.suggest-element').on('click', function(){
		                        //Obtenemos la id unica de la sugerencia pulsada
		                        var id = $(this).attr('id');
		                        //Editamos el valor del input con data de la sugerencia pulsada
		                        $('#key').val($('#'+id).attr('data'));
		                        //Hacemos desaparecer el resto de sugerencias
		                        $('#suggestions').fadeOut(1000);
		                        alert('Has seleccionado el '+id+' '+$('#'+id).attr('data'));
		                        return false;
		                });
		            }
		        });*/
		    });
		}); 
		</script>
</body>
</html>