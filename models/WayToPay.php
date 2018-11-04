<?php
/**
 * Factura
 */
require_once 'Database.php';
class WayToPay
{
	private $pdoWayToPay;

	public $id;
	public $name;
	public $description;

	public function __construct() {
		try {
			$this->pdoWayToPay = Database::conectar();
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function getAll(){
		try{

			$queryResult = $this->pdoWayToPay->prepare("SELECT * FROM forma_pago");
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

			$queryResult = $this->pdoWayToPay->prepare("SELECT * FROM forma_pago WHERE id = ?");
            $queryResult->execute(array($id));
        	return $queryResult->fetch(PDO::FETCH_OBJ); 
		} 
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function delete($id) {
		try {
			$queryResult = $this->pdoWayToPay->prepare("DELETE FROM forma_pago WHERE id = ?");
			$queryResult->execute(array($id));
		} 
		catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function update($data){
		try {
			$sql = "UPDATE forma_pago SET
						nombre = ?,
						descripcion = ?
				    WHERE id = ?";

			$this->pdoWayToPay->prepare($sql)
					->execute(array(
                        $data->id,
                        $data->name,
                        $data->description
                    )
				);

		} catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function save(ServicioTecnico $data) {
		try {
			
		$sql = "INSERT INTO forma_pago 
        (nombre, descripcion) 
        VALUES (?, ?)";

		$this->pdoWayToPay->prepare($sql)
		     ->execute(array(
                       	$data->id,
                        $data->name,
                        $data->description
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