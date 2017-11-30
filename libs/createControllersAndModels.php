<?php 
error_reporting(E_ALL);

/**
* 
*/
class createControllersAndModels
{
	
	private $tabla;
	private $ColumnasName;
	private $ColumnasType;
	private $user; 
	private $pass;

	public function __construct($user, $pass)
	{
		$this->user = $user;
		$this->pass = $pass;
		if (!file_exists( $_SERVER['DOCUMENT_ROOT'] . "/clase1/generateFiles" )) {
		    mkdir($_SERVER['DOCUMENT_ROOT'] . "/clase1/generateFiles", 0777, true);
		}
		if (!file_exists( $_SERVER['DOCUMENT_ROOT'] . "/clase1/generateFiles/models" )) {
		    mkdir($_SERVER['DOCUMENT_ROOT'] . "/clase1/generateFiles/models", 0777, true);
		}
		if (!file_exists( $_SERVER['DOCUMENT_ROOT'] . "/clase1/generateFiles/controllers" )) {
		    mkdir($_SERVER['DOCUMENT_ROOT'] . "/clase1/generateFiles/controllers", 0777, true);
		}
	}

	public function setValues($tableP, $ColumnasNP, $ColumnasTP) 
	{ 
		$this->tabla = $tableP;
		$this->ColumnasName = $ColumnasNP;
		$this->ColumnasType = $ColumnasTP;
	}

	public function createController() 
	{ 
		$controllerName = $_SERVER['DOCUMENT_ROOT'] . "/clase1/generateFiles/controllers/" . $this->tabla . "_controller.php";
		if( file_put_contents($controllerName, $this->controllerBody() ) !== false) 
		    echo "\n" . "Controller File created (" . basename($controllerName) . ")<br>";
		else 
		    echo "\n" . "Cannot create Controller file (" . basename($controllerName) . ")<br>";
	}

	public function controllerBody() 
	{ 
		$controllerContent = 
			'<?php' . "\n" . 
			'// header("Access-Control-Allow-Origin: *");' . "\n" . 
			'// header("Access-Control-Allow-Headers: *");' . "\n" . 
			'/**' . "\n" . 
			' * Seasons Controller' . "\n" . 
			' * @category Controller' . "\n" . 
			' * @package Clase 1' . "\n" . 
			' * @version 1.0' . "\n" . 
			' * @author  Royner Luna' . "\n" . 
			' * @copyright Copyright (c) 2017' . "\n" . 
			' * ' . "\n" . 
			' */' . "\n" . 
			'require_once( ABSPATH . "libs/controller.php" );' . "\n" . 
			'class ' . $this->tabla . '_controller extends controller {' . "\n" . 
			'    //------------------------------------------------------------------------------' . "\n" . 
			'    //------------------------------------------------------------------------------' . "\n" . 
			'    // Attributes declarations' . "\n" . 
			'    //------------------------------------------------------------------------------' . "\n" . 
			'    //------------------------------------------------------------------------------' . "\n" . 
			'    //------------------------------------------------------------------------------' . "\n" . 
			'    //------------------------------------------------------------------------------' . "\n" . 
			'    // Constructors declarations' . "\n" . 
			'    //------------------------------------------------------------------------------' . "\n" . 
			'    //------------------------------------------------------------------------------' . "\n" . 
			'    public function __construct()' . "\n" . 
			'    { ' . "\n" . 
			'        try { ' . "\n" . 
			'            parent::__construct();' . "\n" . 
			'            parent::loadModel("' . $this->tabla . '_model", "maintance");' . "\n" . 
			'        } ' . "\n" . 
			'        catch (Exception $e) { ' . "\n" . 
			'            $this->registerLog("' . $this->tabla . '_controler");' . "\n" . 
			'            return false;' . "\n" . 
			'        }' . "\n" . 
			'    }' . "\n" . 
			'    public function __destruct()' . "\n" . 
			'    { }' . "\n" . 
			'    //------------------------------------------------------------------------------' . "\n" . 
			'    //------------------------------------------------------------------------------' . "\n" . 
			'    // Base methods' . "\n" . 
			'    //------------------------------------------------------------------------------' . "\n" . 
			'    //------------------------------------------------------------------------------' . "\n" . 
			'    //------------------------------------------------------------------------------' . "\n" . 
			'    //------------------------------------------------------------------------------' . "\n" . 
			'    // Procedures & functions declarations' . "\n" . 
			'    //------------------------------------------------------------------------------' . "\n" . 
			'    //------------------------------------------------------------------------------' . "\n" . 
			'    public function getData()' . "\n" . 
			'    { ' . "\n" . 
			'        $optionsBottom   =' . "\n" . 
			'            "<button type=\'button\' data-action=\'delete\' class=\'btn btn-sm btn-success noMargin\'>" . ' . "\n" . 
			'            "   <i class=\'fa fa-trash\'></i>" . ' . "\n" . 
			'            "</button>";' . "\n" . 
			'        $arrayData = array(); ' . "\n" . 
			'        $list = $this->model->selectAllData($this->model);' . "\n" . 
			'        foreach( $list as $row ) :' . "\n" . 
			'            $c = false;' . "\n" . 
			'            if( $c ) ' . "\n" . 
			'                $classSelector = "gradeX";' . "\n" . 
			'            else' . "\n" . 
			'                $classSelector = "gradeU";' . "\n" . 
			'            $c = !$c;' . "\n" . 
			'            array_push( $arrayData, array( ' . "\n" . 
			'                "DT_RowId"          => strval($row["CODIGO"]),' . "\n" . 
			'                "DT_RowClass"       => $classSelector,' . "\n";
		foreach ($this->ColumnasName as $value) {
			$controllerContent .= '                "' . $value . '" 			=> $row["' . $value . '"],' . "\n";
		}
		$controllerContent .= 
			'                "options" 			=> $optionsBottom' . "\n" . 
			'           	));' . "\n" . 
			'        endforeach;' . "\n" . 
			'        $arrList["data"] = $arrayData;' . "\n" . 
			'        return json_encode($arrList);' . "\n" . 
			'    }' . "\n" . 
			'}' . "\n" . 
			'if( defined(\'DEBUGMODE\') && DEBUGMODE  ) { }' . "\n" . 
			'if(isset($_POST[\'action\'])) { ' . "\n" . 
			'    $controller = new ' . $this->tabla . '_controller();' . "\n" . 
			'    switch ($_POST[\'action\']) { ' . "\n" . 
			'        case \'getTableData\':' . "\n" . 
			'            echo $controller->getData();' . "\n" . 
			'            break;' . "\n" . 
			'    }' . "\n" . 
			'}' . "\n" . 
			'?>';
		return $controllerContent;
	}

	public function createModel() 
	{ 
		$modelName = $_SERVER['DOCUMENT_ROOT'] . "/clase1/generateFiles/models/" . $this->tabla . "_model.php";
		
		if( file_put_contents( $modelName, $this->modelBody() ) !== false) 
		    echo "\n" . "Model File created (" . basename($modelName) . ")<br>";
		else 
		    echo "\n" . "Cannot create Model file (" . basename($modelName) . ")<br>";
	}

	public function modelBody() 
	{ 
		$modelContent = 
			'<?php' . "\n" . 
			'require_once(ABSPATH . "conn/Conexion.php");' . "\n" . 
			'require_once(ABSPATH . "model/model.php");' . "\n" . 
			'class ' . $this->tabla . '_model extends model' . "\n" . 
			'{' . "\n" . 
			'//------------------------------------------------------------------------------' . "\n" . 
			'// Attributes declarations' . "\n" . 
			'//------------------------------------------------------------------------------' . "\n" . 
			'    private $table;' . "\n";
		foreach ($this->ColumnasName as $value) {
			$modelContent .= '    private $' . $value . ';' . "\n";
		}
		$modelContent .= 
			'//------------------------------------------------------------------------------' . "\n" . 
			'// Constructors declarations' . "\n" . 
			'//------------------------------------------------------------------------------' . "\n" . 
			'    public function __construct()' . "\n" . 
			'    {' . "\n" . 
			'        $this->table = "' . $this->tabla . '";' . "\n" . 
			'    }' . "\n" . 
			'    public function __destruct()' . "\n" . 
			'    { }' . "\n" . 
			'    public function asignValues (';
		$f = true;
		foreach ($this->ColumnasName as $value) {
			if( !$f ) 
				$modelContent .= ', ';	
			$modelContent .= '$' . $value . 'p';
			$f = false;
		}
		$modelContent .= 
			')' . "\n" . 
			'    {' . "\n";
		foreach ($this->ColumnasName as $value) {
			$modelContent .= '        $this->' . $value . ' = $' . $value . 'p;' . "\n";
		}
		$modelContent .= 
			'    }' . "\n" . 
			'//------------------------------------------------------------------------------' . "\n" . 
			'// Set & Get declarations' . "\n" . 
			'//------------------------------------------------------------------------------' . "\n" . 
			'    public function getTable()' . "\n" . 
			'    {' . "\n" . 
			'        return $this->table;' . "\n" . 
			'    }' . "\n";
		$i = 0;
		foreach ($this->ColumnasName as $value) { 
			$modelContent .= 
				'	//------------------------------------------------------------------------------' . "\n" . 
				'	// Field: ' . $value . ' type: ' . $this->ColumnasType[$i] . ' ' . "\n" . 
				'    public function set' . $value . '( $' . $value . 'p )' . "\n" . 
				'    {' . "\n" . 
				'        $this->' . $value . ' = $' . $value . 'p;' . "\n" . 
				'    }' . "\n" . 
				'	// Field: ' . $value . ' return type: ' . $this->ColumnasType[$i] . ' ' . "\n" . 
				'    public function get' . $value . '()' . "\n" . 
				'    {' . "\n" . 
				'        return $this->' . $value . ';' . "\n" . 
				'    }' . "\n";
				$i++;
		}
		$modelContent .= 
			'}' . "\n" . 
			'?>'; 
		return $modelContent; 
	} 

	public function getQuery($DATABASE, $query) 
	{ 
		$SERVER_DB = "localhost"; 
		$mysqli = new mysqli( $SERVER_DB, $this->user, $this->pass, $DATABASE ); 
		mysqli_set_charset($mysqli, "utf8"); 
		if( $mysqli->connect_error ) 
		    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error); 
		$results = $mysqli->query($query); 
		$mysqli->close(); 
		return $results; 
	} 

	public function startProcess($databaseP, $tablesP ) 
	{ 
		$columnsName = array(); 
		$columnsType = array(); 
		foreach( $tablesP as $row ) : 
			$query = 
				"SELECT COLUMN_NAME, DATA_TYPE " . 
				"FROM INFORMATION_SCHEMA.COLUMNS " . 
				"WHERE TABLE_SCHEMA = '" . $databaseP . "' " . 
					"AND TABLE_NAME = '" . $row . "' "; 
			$columnsResult = $this->getQuery( $databaseP, $query ); 
			$columnName = array(); 
			$columnType = array(); 
			foreach( $columnsResult as $rowC ) : 
				// var_dump($rowC);die();
				array_push( $columnName, $rowC["COLUMN_NAME"] ); 
				array_push( $columnType, $rowC["DATA_TYPE"] ); 
			endforeach; 
			array_push( $columnsName, $columnName ); 
			array_push( $columnsType, $columnType ); 
		endforeach; 
		for ($i=0; $i < count($tablesP); $i++) : 
			echo "------------------------------------------------------------------------------<br><br>";
			$this->setValues( $tablesP[$i], $columnsName[$i], $columnsType[$i] ); 
			$this->createController(); 
			$this->createModel(); 
			echo "<br>------------------------------------------------------------------------------<br>";
		endfor; 
	}

	public function getAllTablesFromDB( $databaseP ) 
	{ 
		$tablesName = array();
		$query_tables = 
			"SELECT TABLE_NAME " . 
			"FROM INFORMATION_SCHEMA.TABLES " . 
			"WHERE TABLE_SCHEMA LIKE '" . $databaseP . "'";
		$tables = $this->getQuery( $databaseP, $query_tables );
		foreach( $tables as $row ) : 
			array_push( $tablesName, $row["TABLE_NAME"] ); 
		endforeach; 
		return $tablesName;
	} 

} 



$database = "clase1"; 
$tables = ["usuarios","prefiles"];
$user = "root";
$pass = "";

$fileMan = new createControllersAndModels($user, $pass); 

$fileMan->startProcess( $database, $tables );
?> 