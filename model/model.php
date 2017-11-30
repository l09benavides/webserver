<?php
/**
 * Model Parent
 *
 * @category model
 * @package Folio
 * @version 1.0
 * @author Royner Luna Ramirez
 * @copyright Copyright (c) 2016,
 * @date
 * 
 */  

require_once( 'conn/Conexion.php');
require_once( 'libs/dbQueryGenerator.php');

class model{
  
    function __construct() 
    { }
    
    

    public function selectAllData($model) 
    { 
        return dbQueryGenerator::selectAllData($model);
    }

    public function selectAllDataWithClauses($model) 
    { 
        return dbQueryGenerator::selectAllDataWithClauses($model);
    }

    

    public function insertData($model) 
    { 
        return dbQueryGenerator::insertData($model);
    } 

    public function updateAllData($model) 
    { 
        return dbQueryGenerator::updateAllData($model);
    } 

    

    public function deleteSpecificFieldsWithClauses($model) 
    { 
        return dbQueryGenerator::deleteSpecificFieldsWithClauses($model);
    } 

    public function execQuery($model) 
    { 
        return dbQueryGenerator::execQuery($model);
    } 
}
?>