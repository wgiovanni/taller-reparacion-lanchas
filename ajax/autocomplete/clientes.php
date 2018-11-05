<?php
if (isset($_GET['term'])){
include("../../config/db.php");
include("../../config/conexion.php");
$return_arr = array();
/* If connection to database, run sql statement. */
if ($con)
{
	$fetch = mysqli_query($con,"SELECT * FROM cliente where cedula like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	/* Retrieve and store in array the results of the query.*/
	while ($row = mysqli_fetch_array($fetch)) {
		//print_r($row);
		$id_cliente=$row['id'];
		$row_array['value'] = $row['cedula'];
		$row_array['id_cliente']=$id_cliente;
		$row_array['nombre_cliente']=$row['nombre'];
		$row_array['apellido_cliente']=$row['apellido'];
		$row_array['telefono_cliente']=$row['telefono'];
		$row_array['email_cliente']=$row['email'];
		$row_array['direccion_cliente']=$row['direccion'];
		array_push($return_arr,$row_array);
    }
	
}

/* Free connection resources. */
mysqli_close($con);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

}
?>