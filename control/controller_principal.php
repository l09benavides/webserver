<?php

require_once "libs/smarty/config_smarty.php"; #In PHP version 7.1 there should not be a slash at the beginning

class Controller_principal{


		//Clase encapsulada get's y set´s para los atributos privados

		// por defecto en privada
		// ninguna clase tiene que accederlo directamente
		private $nombre;
		private $apellidos;
		private $edad;
		private $ins;
		
		//Singleton
		public static $instancia;

		public static function getInstance(){
			if(!self::$instancia instanceof self){
				return self::$instancia = new self;
			}else{
				return self::$instancia;
			}
		}		
		
		//Constructor se usa por defecto

    /**
     * Controller_principal constructor.
     */
    public function __construct(){
			//al ser orientado a objectos se usa this, y la variable no usa $
			$this->nombre = "";
			$this->apellidos = "";
			$this->edad = 0;
			$this->ins = new config_smarty();
			$this->ins->setRutas();
		}

	
		public function mostrar(){
			
			$this->ins->setAssign('kNombre','Luis');
			$this->ins->exeDisplay("index.tpl");

		}


		public function openHome(){
			$this->ins->exeDisplay("home.tpl");
		}

		public function openCatalogo(){
			$this->ins->exeDisplay("catalogos.tpl");
		}

		public function openReporte(){
			$this->ins->exeDisplay("reportes.tpl");
		}


}

?>