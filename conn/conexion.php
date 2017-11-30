<?php 

require_once("config.php");

/**
* 
*/
class Conexion
{
	
	public static $instancia;

	public static function getInstance(){
		if(!self::$instancia instanceof self){
			return self::$instancia = new self;
		}else{
			return self::$instancia;
		}
	}

	private $link;


	public function __construct()
	{
		
	}

	public function connectar(){
		$this->link = mysqli_connect(SERVER,USER,PASS,DB);

		if (!$this->link){
			echo "Error Connectando a la Base de Datos: ".$this->link->connect_error;
		}
	}

	public function CloseConn(){
		mysqli_close($this->link);
	}

	public function getLink(){
		$this->connectar();
		return $this->link;
	}
}

 ?>