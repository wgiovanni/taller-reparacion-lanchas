<?php
/**
 * Factura
 */
require_once 'Database.php';
class DetailInvoice
{
	private $pdoDetailInvoice;

	public $id;
	public $quantityOfProducts;
	public $total;
	public $idProduct;
	public $idInvoice;


	public function __construct() {
		try {
			$this->pdoDetailInvoice = Database::conectar();
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function getAll(){
		try{

			$queryResult = $this->pdoDetailInvoice->prepare("SELECT * FROM detalle_factura");
            $queryResult->execute();
        	return  $queryResult->fetchAll(PDO::FETCH_OBJ); 
		} 
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	/*public function getAllByStatusPending($status){
		try{
			$queryResult = $this->pdoCustomer->prepare("SELECT * FROM cliente WHERE estatus = ?");
            $queryResult->execute(array($status));
        	return $queryResult->fetchAll(PDO::FETCH_OBJ); 
		} 
		catch(Exception $e){
			die($e->getMessage());
		}
	}*/

	public function getId($id){
		try {

			$queryResult = $this->pdoDetailInvoice->prepare("SELECT * FROM detalle_factura WHERE id = ?");
            $queryResult->execute(array($id));
        	return $queryResult->fetch(PDO::FETCH_OBJ); 
		} 
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function getByIdInvoice($idFactura){
		try {

			$queryResult = $this->pdoDetailInvoice->prepare("SELECT * FROM detalle_factura AS df INNER JOIN producto AS p ON (df.id_producto = p.id) WHERE id_factura = ?");
            $queryResult->execute(array($idFactura));
        	return $queryResult->fetchAll(PDO::FETCH_OBJ); 
		} 
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function delete($id) {
		try {
			$queryResult = $this->pdoDetailInvoice->prepare("DELETE FROM detalle_factura WHERE id = ?");
			$queryResult->execute(array($id));
		} 
		catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function update($data){
		try {
			$sql = "UPDATE detalle_factura SET
						cantidad_productos = ?,
						total = ?,
            			id_producto = ?,
            			id_factura = ?
				    WHERE id = ?";

			$this->pdoDetailInvoice->prepare($sql)
					->execute(array(
                        $data->id,
                        $data->quantityOfProducts,
                        $data->total,
                        $data->idProduct,
                        $data->idInvoice
					)
				);

		} catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function save(ServicioTecnico $data) {
		try {
			
		$sql = "INSERT INTO detalle_factura 
        (cantidad_productos, total, id_factura, id_producto) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

		$this->pdoDetailInvoice->prepare($sql)
		     ->execute(array(
                        $data->id,
                        $data->quantityOfProducts,
                        $data->total,
                        $data->idInvoice,
                        $data->idProduct
                )
			);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}