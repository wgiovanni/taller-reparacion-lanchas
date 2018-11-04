<?php
/**
 * Factura
 */
require_once 'Database.php';
class Invoice
{
	private $pdoInvoice;

	public $id;
	public $code;
	public $date;
	public $isPrinted;
	public $canceled;
	public $tax;
	public $idWayToPay;
	public $idCustomer;


	public function __construct() {
		try {
			$this->pdoInvoice = Database::conectar();
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function getAll(){
		try{

			$queryResult = $this->pdoInvoice->prepare("SELECT * FROM factura AS f INNER JOIN cliente AS c ON (f.id_cliente = c.id)");
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

			$queryResult = $this->pdoInvoice->prepare("SELECT * FROM factura WHERE id = ?");
            $queryResult->execute(array($id));
        	return $queryResult->fetch(PDO::FETCH_OBJ); 
		} 
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function delete($id) {
		try {
			$queryResult = $this->pdoInvoice->prepare("DELETE FROM factura WHERE id = ?");
			$queryResult->execute(array($id));
		} 
		catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function update($data){
		try {
			$sql = "UPDATE factura SET
						codigo = ?,
						fecha = ?,
            			es_impresa = ?,
            			anulada = ?, 
            			impuesto = ?,
            			id_forma_pago = ?,
            			id_cliente = ?
				    WHERE id = ?";

			$this->pdoInvoice->prepare($sql)
					->execute(array(
                        $data->id,
                        $data->code,
                        $data->date,
                        $data->isPrinted,
                        $data->canceled,
                        $data->tax,
                        $data->idWayToPay,
                        $data->idCustomer
					)
				);

		} catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function save(ServicioTecnico $data) {
		try {
			
		$sql = "INSERT INTO factura 
        (codigo, fecha, es_impresa, anulada, impuesto, id_forma_pago, id_cliente) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

		$this->pdoInvoice->prepare($sql)
		     ->execute(array(
                        $data->id,
                        $data->code,
                        $data->date,
                        $data->isPrinted,
                        $data->canceled,
                        $data->tax,
                        $data->idWayToPay,
                        $data->idCustomer
                )
			);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
	/*public function search($estatus, $tienda, $categoria) {
		try {
			$arraySearch = [];
			$arrayParamts = [];

			if (isset($estatus) && !empty($estatus)){
				array_push($arraySearch, $estatus);
				array_push($arrayParamts, "estatus");
				//print_r($estatus);
			}

			if(isset($tienda) && !empty($tienda)) {
				array_push($arraySearch, $tienda);
				array_push($arrayParamts, "tienda");
				//print_r($tienda);
			}

			if (isset($categoria) && !empty($categoria)) {
				array_push($arraySearch, $categoria);
				array_push($arrayParamts, "categoria");
				//print_r($categoria);
			}

			$sql = "SELECT * FROM serviciotecnico";

			if(!empty($arraySearch) && !empty($arrayParamts))
			{
				$size = sizeof($arraySearch);
				for ($i=0; $i < $size; $i++) { 
					if($i == 0) {
						$sql = $sql . " WHERE " . $arrayParamts[$i]. " = ?";  
					} else {
						$sql = $sql . " AND " . $arrayParamts[$i] . " = ?"; 
					}
				}
			}
			$queryResult = $this->pdoServicioTecnico->prepare($sql);
            $queryResult->execute($arraySearch);
        	return $queryResult->fetchAll(PDO::FETCH_OBJ); 
		} 
		catch(Exception $e){
			die($e->getMessage());
		}
	}*/
}