<?php
/**
 * Cliente
 */
require_once 'Database.php';
class Customer
{
	private $pdoCustomer;

	public $id;
	public $identification;
	public $firstName;
	public $secondName;
	public $address;
	public $phone;
	public $email;

	public function __construct() {
		try {
			$this->pdoCustomer = Database::conectar();
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function getAll(){
		try{

			$queryResult = $this->pdoCustomer->prepare("SELECT * FROM cliente");
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

			$queryResult = $this->pdoCustomer->prepare("SELECT * FROM cliente WHERE id = ?");
            $queryResult->execute(array($id));
        	return $queryResult->fetch(PDO::FETCH_OBJ); 
		} 
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function delete($id) {
		try {
			$queryResult = $this->pdoCustomer->prepare("DELETE FROM cliente WHERE id = ?");
			$queryResult->execute(array($id));
		} 
		catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function update($data){
		try {
			$sql = "UPDATE pdoCustomer SET
						cedula = ?,
						nombre = ?,
            			apellido = ?,
            			direccion = ?, 
            			telefono = ?,
            			email = ?
				    WHERE id = ?";

			$this->pdoCustomer->prepare($sql)
					->execute(array(
                        $data->id,
                        $data->identification,
                        $data->firstName,
                        $data->secondName,
                        $data->address,
                        $data->phone,
                        $data->email
					)
				);

		} catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function save(ServicioTecnico $data) {
		try {
			
		$sql = "INSERT INTO cliente 
        (cedula, nombre, apellido, direccion, telefono, email) 
        VALUES (?, ?, ?, ?, ?, ?)";

		$this->pdoCustomer->prepare($sql)
		     ->execute(array(
                        $data->id,
                        $data->identification,
                        $data->firstName,
                        $data->secondName,
                        $data->address,
                        $data->phone,
                        $data->email
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