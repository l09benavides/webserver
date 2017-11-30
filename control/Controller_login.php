<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 27/11/17
 * Time: 07:17 PM
 */

require_once "../conn/conexion.php";
//require_once "logging.php";


//$log = new logging();
$insDB = conexion::getInstance();

//$log->lfile("/tmp/distapp.log");
//$log->lopen();

$mysqli = $insDB->getLink();

$query = "select usuario, id_rol from tbl_usuario where usuario='".
    $_POST['usr']."' and password='".$_POST['pwd']."'";

//$log->lwrite("Query Generated: "+$query);

$usuarios = $mysqli->query($query);

//$log->lwrite("Result: "+$usuarios);

if($usuarios->num_rows == 1):
    $datos = $usuarios->fetch_assoc();
  //  $log->lwrite("Data: "+$datos);
    echo json_encode(array('Error'=> false, 'tipo' => $datos));
    else:
        echo json_encode(array('Error'=> true));
    endif;

$insDB->CloseConn();
//$log->lclose();

?>