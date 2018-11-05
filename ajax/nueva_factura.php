<?php
if (empty($_POST['id_cliente'])) {
    $errors[] = "Id vacio";
} else if (empty($_POST['cedula_cliente'])) {
    $errors[] = "Cédula vacia";
 } else if (empty($_POST['fecha'])){
     $errors[] = "Fecha vacia";
 } else if (empty($_POST['forma_pago'])){
     $errors[] = "Forma de pago vacia";
 } else if (
     !empty($_POST['cedula_cliente']) &&
     !empty($_POST['fecha']) &&
     !empty($_POST['forma_pago']))
    {
        require_once ("../config/db.php");
        require_once ("../config/conexion.php");
        $id_cliente=mysqli_real_escape_string($con,(strip_tags($_POST["id_cliente"],ENT_QUOTES)));
        $fecha =mysqli_real_escape_string($con,(strip_tags($_POST["fecha"],ENT_QUOTES)));
        $id_forma_pago = mysqli_real_escape_string($con,(strip_tags($_POST["forma_pago"],ENT_QUOTES)));

        $sql="INSERT INTO factura (fecha, id_cliente, estado_factura, id_forma_pago) VALUES ('$fecha','$id_cliente',1, '$id_forma_pago')";
        $query1 = mysqli_query($con, $sql);
        $sql = "SELECT * FROM factura ORDER BY id DESC LIMIT 1";
        $query = mysqli_query($con, $sql);
        while($row=mysqli_fetch_array($query)){
            //print_r($row);
            $id_factura = $row['id'];
        }
        //$nums=1;
        $sumador_total=0;
        if (!empty($id_factura)){
            $sql=mysqli_query($con, "select * from producto, tmp where producto.id=tmp.id_producto");

            while ($row=mysqli_fetch_array($sql))
            {
                $id_producto=$row["id_producto"];
                $cantidad=$row['cantidad_tmp'];                
                $precio_venta=$row['precio_tmp'];
                $precio_venta_f=number_format($precio_venta,2);
                $precio_venta_r=str_replace(",","",$precio_venta_f);
                $precio_total=$precio_venta_r*$cantidad;
                $precio_total_f=number_format($precio_total,2);//Precio total formateado
                $precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
                $sumador_total+=$precio_total_r;//Sumador
                $insert_detail=mysqli_query($con, "INSERT INTO detalle_factura (id_producto, id_factura, cantidad, total) VALUES ('$id_producto','$id_factura','$cantidad','$precio_total')");
            }
            $update_factura=mysqli_query($con, "UPDATE factura SET total_venta='$sumador_total' WHERE id='$id_factura'");
            $delete=mysqli_query($con,"DELETE FROM tmp");
        }
        if ($query1){
            $messages[] = "Producto ha sido ingresado satisfactoriamente.";
        } else{
            $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
        }
    } else {
        $errors []= "Error desconocido.";
    }
    
    if (isset($errors)){
        
        ?>
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong> 
                <?php
                    foreach ($errors as $error) {
                            echo $error;
                        }
                    ?>
        </div>
        <?php
        }
        if (isset($messages)){
            
            ?>
            <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Bien hecho!</strong>
                    <?php
                        foreach ($messages as $message) {
                                echo $message;
                            }
                        ?>
            </div>
            <?php
        }
?>