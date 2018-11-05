<?php
	session_start();
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$title="Editar Factura | Taller de reparacion de lanchas";
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	if (isset($_GET['id_factura']))
	{
		$id_factura=intval($_GET['id_factura']);
		print_r($id_factura);
		$campos="cliente.id, cliente.nombre, cliente.apellido, cliente.telefono, cliente.email, cliente.direccion, factura.id, factura.fecha, factura.estado_factura, forma_pago.id, forma_pago.nombre";
		$sql_factura=mysqli_query($con,"select $campos from factura INNER JOIN cliente ON (factura.id_cliente=cliente.id) INNER JOIN forma_pago ON (factura.id_forma_pago = forma_pago.id) where factura.id='".$id_factura."'");
		$count=mysqli_num_rows($sql_factura);
		if ($count==1)
		{
				$rw_factura=mysqli_fetch_array($sql_factura);
				print_r($rw_factura);
				$id_cliente=$rw_factura['id'];
				$nombre_cliente=$rw_factura['nombre'];
				$apellido_cliente=$rw_factura['apellido'];
				$telefono_cliente=$rw_factura['telefono'];
				$email_cliente=$rw_factura['email'];
				$fecha_factura=$rw_factura['fecha'];
				$direccion_cliente=$rw_factura['direccion'];
				$estado_factura=$rw_factura['estado_factura'];
				$id_forma_pago=$rw_factura[9];
				$forma_pago_nombre = $rw_factura[10];
				$_SESSION['id_factura']=$id_factura;
		}	
		else
		{
			header("location: facturas.php");
			exit;	
		}
		$query=mysqli_query($con, "select * from forma_pago");
	} 
	else 
	{
		header("location: facturas.php");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
	include("navbar.php");
	?>  
    <div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h4><i class='glyphicon glyphicon-edit'></i> Editar Factura</h4>
		</div>
		<div class="panel-body">
		<?php 
			include("modal/buscar_productos.php");
			include("modal/registro_clientes.php");
			include("modal/registro_productos.php");
		?>
			<form class="form-horizontal" role="form" id="datos_factura">
				<input id="id_factura" name="id_factura" value="<?php echo $id_factura; ?>" type='hidden'>	
				<div class="form-group row">
					<label for="fecha" class="col-md-1 control-label">Fecha</label>
					<div class="col-md-2">
						<input type="text" class="form-control input-sm" name="fecha" id="fecha" value="<?php echo date("d/m/Y");?>" readonly>
					</div>
					<label for="forma_pago" class="col-md-2 control-label">Forma de pago</label>
					<div class="col-md-2">
						<select class='form-control input-sm' id="forma_pago" name="forma_pago">
							<option value="<?php echo $id_forma_pago; ?>" disable><?php echo $forma_pago_nombre; ?> </option>
							<?php
								while ($row=mysqli_fetch_array($query)){
									echo '<option value='.$row['id'].'>'.$row['nombre'].'</option>';
								}
									
							?>
						</select>
					</div>
				</div>
				<label class="control-label">Cliente</label>
				<hr>
				<div class="form-group row">
					<label for="nombre_cliente" class="col-md-1 control-label">Cliente</label>
					<div class="col-md-2">
						<input type="text" class="form-control input-sm" id="nombre_cliente" placeholder="Selecciona un cliente" required value="<?php echo $nombre_cliente;?>">
					<input id="id_cliente" name="id_cliente" type='hidden' value="<?php echo $id_cliente;?>">	
					</div>
					<label for="nombre_cliente" class="col-md-1 control-label">Nombre</label>
					<div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="nombre_cliente" name="nombre_cliente" value="<?php echo $nombre_cliente;?>" placeholder="Nombre" readonly>
					</div>
					<label for="apellido_cliente" class="col-md-1 control-label">Apellido</label>
					<div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="apellido_cliente" name="apellido_cliente" value="<?php echo $apellido_cliente;?>" placeholder="Apellido" readonly>
					</div>
					
				 </div>
				 <div class="form-group row">
				 <label for="tel1" class="col-md-1 control-label">Teléfono</label>
					<div class="col-md-2">
						<input type="text" class="form-control input-sm" id="tel1" placeholder="Teléfono" value="<?php echo $telefono_cliente;?>" readonly>
					</div>
					<label for="mail" class="col-md-1 control-label">Email</label>
					<div class="col-md-3">
						<input type="text" class="form-control input-sm" id="mail" placeholder="Email" readonly value="<?php echo $email_cliente;?>">
					</div>
					<label for="direccion_cliente" class="col-md-1 control-label">Dirección</label>
					<div class="col-md-3">
						<input type="text" class="form-control input-sm" id="direccion_cliente" name="direccion_cliente" value="<?php echo $direccion_cliente;?>" placeholder="Dirección" readonly>
					</div>
				</div>
				
				
				<div class="col-md-12">
					<div class="pull-right">
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoProducto">
						 <span class="glyphicon glyphicon-plus"></span> Nuevo producto
						</button>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoCliente">
						 <span class="glyphicon glyphicon-user"></span> Nuevo cliente
						</button>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
						 <span class="glyphicon glyphicon-search"></span> Agregar productos
						</button>
						<button type="submit" class="btn btn-default" id="guardar_factura">
						  <span class="glyphicon glyphicon-floppy-saved"></span> Guardar
						</button>
					</div>	
				</div>
			</form>	
			<div class="clearfix"></div>
				<div class="editar_factura" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->	
			
		<div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->			
			
		</div>
	</div>		
		 
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/editar_factura.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
		$(function() {
						$("#cedula_cliente").autocomplete({
							source: "./ajax/autocomplete/clientes.php",
							minLength: 2,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_cliente').val(ui.item.id_cliente);
								$('#cedula_cliente').val(ui.item.value);
								$('#nombre_cliente').val(ui.item.nombre_cliente);
								$('#apellido_cliente').val(ui.item.apellido_cliente);
								$('#telefono_cliente').val(ui.item.telefono_cliente);
								$('#email_cliente').val(ui.item.email_cliente);
								$('#direccion_cliente').val(ui.item.direccion_cliente);
																
								
							 }
						});
						 
						
					});
					
	$("#cedula_cliente" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_cliente" ).val("");
							$("#telefono_cliente" ).val("");
							$("#email_cliente" ).val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#nombre_cliente" ).val("");
							$("#id_cliente" ).val("");
							$("#telefono_cliente" ).val("");
							$("#email_cliente" ).val("");
						}
			});

		$("#guardar_factura_datos").submit(function( event ) {
		
		var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "ajax/nueva_factura.php",
				data: parametros,
				beforeSend: function(objeto){
					$("#resultados_ajax_factura").html("Mensaje: Cargando...");
				},
				success: function(datos){
					//alert(datos);
					$("#resultados_ajax_factura").html(datos);
					$('#guardar_factura_datos').attr("disabled", false);
					load(1);
				}
			});
			event.preventDefault();
	})
	</script>

  </body>
</html>