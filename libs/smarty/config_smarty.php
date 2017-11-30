<?php

require_once "Smarty.class.php";

	class config_smarty{

		private $smarty;

		public function __construct(){
			$this->smarty = new Smarty;
		}		

		public function setRutas(){
			$this->smarty->template_dir="view/templates";
			$this->smarty->compile_dir="view/templates_c";
			$this->smarty->config_dir="control/configs";
			$this->smarty->cache_dir="control/cache";
		}

		public function setAssign($key, $value){

			$this->smarty->assign($key, $value);

		}

		public function exeDisplay($tpl){

			$this->smarty->display($tpl);

		}

	}

?>