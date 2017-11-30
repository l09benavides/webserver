<?php
/**
 * DB Query Generator Library
 *
 * @category library
 * @package Folio
 * @version 1.0
 * @author Royner Luna Ramirez
 * @copyright Copyright (c) 2016
 * @date
 * 
 */    

require_once('conn/Conexion.php');

class dbQueryGenerator { 

    private static $model;

    public static function loadModelFile($name, $additionalPath) 
    { 
        if(isset($additionalPath))
            $path = ABSPATH . '/models/' . $additionalPath . '/' . $name . '.php';
        else 
            $path = ABSPATH . '/models/' . $name . '.php';
        if( file_exists($path) ) : 
            require_once $path;
            self::$model = new $name;
        else:
            echo "Model file not exist in this directory: " . $name;
        endif;
    }

    public static function getModel() 
    { 
        // 
        return self::$model;
    }

    public static function dbProcedure($procedure)
    {
        $db = new Conexion(); 
        $query = 
            'SELECT PARAMETER_NAME ' . 
            'FROM information_schema.parameters ' . 
            'WHERE SPECIFIC_NAME = "' . $procedure[0] . '" ' . 
                'AND PARAMETER_MODE = "OUT"';
        $rParametros = $db->query( $query );      
        $szListaParams = '';
        foreach( $rParametros as $keyConsulta=>$rowConsulta ) {           
           $szListaParams .= '@' . strval($rowConsulta['PARAMETER_NAME']);
           if ($keyConsulta < $rParametros->num_rows - 1) 
           {
             $szListaParams .= ',';
           }
        }
        $query = 'CALL ' . $procedure[0] . '(';       
        $paramsCount = count($procedure);
        foreach ($procedure as $key=>$param)
        {            
            if ($key > 0)                     
            {
                $query .= $param;                
                if ($key < $paramsCount - 1)
                {
                    $query .= ',';
                }
            }                        
        } 
        $query .= ',' . $szListaParams;
        $query .= ')';
        echo $query;
        echo '                ';
        $r = $db->query( $query );
        $query = 'SELECT ' . $szListaParams; 
       // echo $query;

        $r = $db->query( $query );
        $rows = $r->fetch_assoc();        
        foreach ($rows as $key => $value) {
            var_dump($value);
        }
        var_dump($r);
        return $r;   
    } 

    public static function selectAllData($model) 
    { 
        $db = new Conexion(); 
        $query = 
            "SELECT " . self::getVarStr($model, ', ') . " " . 
            "FROM " . $model->getTable() . " "; 
   
        $r = $db->query( $query );
        return $r;
    }

  

    public static function execQuery( $query ) 
    { 
       $db = new Conexion(); 
        $r = $db->query( $query );
        return $r;
    }


    public static function insertData($model,$returningID=false) 
    { 
   
        $db = new Conexion();         
        $query = 
            'INSERT INTO ' . $model->getTable() . ' (' . self::getVarKeyStrNotNull($model, ', ') . ') VALUES ( ' . 
                self::getVarValStrNotNull($model, ', ',true) . 
            ')';
        $r = $db->query( $query,$returningID);
        return $r;
    }

    public static function updateAllData($model) 
    {
       
        $db = new Conexion(); 
        $query = 
            'UPDATE ' . $model->getTable() . 
            ' SET ' . self::getVarValStrNotNull($model, ' , ') . 
            ' WHERE ' . self::getVarKeyValStrNotNull($model, ' AND ');     
        $r = $db->query( $query );
        return $r;
    }

    public static function deleteSpecificFieldsWithClauses($model) 
    {
        if( method_exists( $model, 'setCOD_HOTEL' ) ) 
            $model->setCOD_HOTEL( Session::get('idHotel') );
        $db = new Conexion(); 
        /*$query = 
            'DELETE FROM ' . $model->getTable() . 
            ' WHERE ' . self::getVarKeyValStrNotNull($model, ' AND ');*/
        $query = 'UPDATE ' . $model->getTable() . ' SET ACTIVO = 0 WHERE ' . self::getVarKeyValStrNotNull($model, ' AND ');   
        $r = $db->query( $query );
        return $r;
    }


    // Internal privates methods
    private static function getVarsArr($model) 
    { 
        $reflection = new ReflectionClass($model);
        $varsArr = array();
        foreach($reflection->getProperties(ReflectionProperty::IS_PRIVATE) as $v) { 
            if( strtolower($v->name) != 'table' )
                array_push($varsArr, $v->name);
        }
        return $varsArr;
    }
   //DSOTO
    private static function getVarStr($model, $separator) 
    { 
        $reflection = new ReflectionClass($model);
        $varsStr = "";
        $attrsCount = count($reflection->getProperties(ReflectionProperty::IS_PRIVATE)) - 1;
        foreach( $reflection->getProperties(ReflectionProperty::IS_PRIVATE) as $k => $v ) { 
            if( strtolower($v->name) != 'table' )
                $varsStr .= "`" . $v->name . "`";
            if( $k > 0 && $k < $attrsCount ) 
                $varsStr .= $separator ;
        }
        return $varsStr;
    }

    private static function getVarKeyStrNotNull($model, $separator) 
    { 
        $varsStr = "";
        $fr = false;
        $reflection = new ReflectionClass($model);
        $attrsCount = count($reflection->getProperties(ReflectionProperty::IS_PRIVATE)) - 1;
        foreach( $reflection->getProperties(ReflectionProperty::IS_PRIVATE) as $k => $v ) { 
            if( strtolower($v->name) != 'table' ) { 
                $getMethod = 'get' . $v->name;
                $tmpVal = $model->$getMethod();
                if( !is_null($tmpVal) ) { 
                    if( $k > 0 && $k <= $attrsCount && $fr )
                        $varsStr .= $separator;
                    $varsStr .= "`" . $v->name . "`";
                    $fr = true;                    
                }
            }
        }
        return $varsStr;
    }

    private static function getVarValStrNotNull($model, $separator,$bQuoted=false) 
    { 
        $varsStr = "";
        $fr = false;
        $reflection = new ReflectionClass($model);
        $attrsCount = count($reflection->getProperties(ReflectionProperty::IS_PRIVATE)) - 1;
        foreach( $reflection->getProperties(ReflectionProperty::IS_PRIVATE) as $k => $v ) { 
            if( strtolower($v->name) != 'table' ) { 
                $getMethod = 'get' . $v->name;
                $tmpVal = $model->$getMethod();
                if(!is_null($tmpVal)) { 
                    if( $k > 0 && $k <= $attrsCount && $fr )
                        $varsStr .= $separator;
                    $bQuoted ?  $varsStr .= '"'. $tmpVal .'"' : $varsStr .= $tmpVal;
                    $fr = true;
                }
            }
        }
        return $varsStr;
    }

    private static function getVarKeyValStrNotNull($model, $separator) 
    { 
        $varsStr = "";
        $fr = false;
        $reflection = new ReflectionClass($model);
        $attrsCount = count($reflection->getProperties(ReflectionProperty::IS_PRIVATE)) - 1;
        foreach( $reflection->getProperties(ReflectionProperty::IS_PRIVATE) as $k => $v ) { 
            if( strtolower($v->name) != 'table' ) { 
                $getMethod = 'get' . $v->name;
                $tmpVal = $model->$getMethod();
                if( !is_null($tmpVal) ) { 
                    if( $k > 0 && $k <= $attrsCount && $fr )
                        $varsStr .= $separator;
                    $varsStr .= $v->name . '= "' . $tmpVal . '"';
                    $fr = true;
                }
            }
        }
        return $varsStr;
    }

    private static function getVarKeyValNotNull($model, $separator,$bQuoted=false) 
    { 
        $varsStr = "";
        $fr = false;
        $reflection = new ReflectionClass($model);
        $attrsCount = count($reflection->getProperties(ReflectionProperty::IS_PRIVATE)) - 1;
        foreach( $reflection->getProperties(ReflectionProperty::IS_PRIVATE) as $k => $v ) { 
            if( strtolower($v->name) != 'table' ) { 
                $getMethod = 'get' . $v->name;
                $tmpVal = $model->$getMethod();
                if( !is_null($tmpVal) ) { 
                    if( $k > 0 && $k <= $attrsCount && $fr )
                        $varsStr .= $separator;
                    //$varsStr .= $v->name . '= ' . $tmpVal . '';
                    $bQuoted ?  $varsStr .=  "`" . $v->name . '` = "' . $tmpVal . '"' : $varsStr .= $v->name . '= ' . $tmpVal . '';
                    $fr = true;
                }
            }
        }
        return $varsStr;
    }
}
?>