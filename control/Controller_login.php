<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 27/11/17
 * Time: 07:17 PM
 */

require_once "../conn/conexion.php";

$insDB = conexion::getInstance();

$mysqli = $insDB->getLink();

$query = "select usuario, id_rol from tbl_usuario where usuario='".
    $_POST['usr']."' and password='".$_POST['pwd']."'";

$usuarios = $mysqli->query($query);

if($usuarios->num_rows == 1):
    $datos = $usuarios->fetch_assoc();
    echo json_encode(array('Error'=> false, 'tipo' => $datos));
    else:
        echo json_encode(array('Error'=> true));
    endif;

$mysqli->CloseConn();


?>