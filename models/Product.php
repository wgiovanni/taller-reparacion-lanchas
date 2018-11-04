<?php
/**
 * Cliente
 */
require_once 'Database.php';
class Product
{
	private $pdoProduct;

	public $id;
	public $code;
	public $name;
	public $description;
	public $price;

	public function __construct() {
		try {
			$this->pdoProduct = Database::conectar();
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function getAll(){
		try{

			$queryResult = $this->pdoProduct->prepare("SELECT * FROM producto");
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

			$queryResult = $this->pdoProduct->prepare("SELECT * FROM producto WHERE id = ?");
            $queryResult->execute(array($id));
        	return $queryResult->fetch(PDO::FETCH_OBJ); 
		} 
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function delete($id) {
		try {
			$queryResult = $this->pdoProduct->prepare("DELETE FROM producto WHERE id = ?");
			$queryResult->execute(array($id));
		} 
		catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function update($data){
		try {
			$sql = "UPDATE producto SET
						codigo = ?,
						nombre = ?,
            			descripcion = ?,
            			precio = ?
				    WHERE id = ?";

			$this->pdoProduct->prepare($sql)
					->execute(array(
                        $data->id,
                        $data->code,
                        $data->name,
                        $data->description,
                        $data->price
                    )
				);

		} catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function save(ServicioTecnico $data) {
		try {
			
		$sql = "INSERT INTO producto 
        (codigo, nombre, descripcion, precio) 
        VALUES (?, ?, ?, ?, ?, ?)";

		$this->pdoProduct->prepare($sql)
		     ->execute(array(
                       $data->id,
                        $data->code,
                        $data->name,
                        $data->description,
                        $data->price
                )
			);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}