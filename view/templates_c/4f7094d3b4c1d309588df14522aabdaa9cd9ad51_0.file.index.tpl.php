<?php
/* Smarty version 3.1.31, created on 2017-11-30 20:46:50
  from "/srv/http/distribuidora/webserver/view/templates/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a206e3a55deb4_57245190',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4f7094d3b4c1d309588df14522aabdaa9cd9ad51' => 
    array (
      0 => '/srv/http/distribuidora/webserver/view/templates/index.tpl',
      1 => 1512074798,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a206e3a55deb4_57245190 (Smarty_Internal_Template $_smarty_tpl) {
?>
<html>
<head>
<?php echo '<script'; ?>
 type="text/javascript" src="js/jquery.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="js/bootstrap.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php echo '<script'; ?>
>

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

$(document).ready(function(){
    if(getCookie("loggedin") === 'false'){
        $('#logindiv').show();
        $('#menu').hide();
        $('#content').hide();
    }if(getCookie("loggedin")  === 'true'){
        $('#logindiv').hide();
        $('#menu').show();
        $('#content').show();
    } else{
        $('#logindiv').show();
        $('#menu').hide();
        $('#content').hide();
    }




$("#login").click(function(){
    var data = $("#loginfrm").serialize();
    $.ajax({
      url: 'control/Controller_login.php',
      type: 'POST',
      dataType: 'json',
      data: data
    })
    .done(function(respuesta){
        document.cookie = "loggedin=true;";
      console.log("Success" + JSON.parse(respuesta).toString());
        $('#content').html("<h1>Bienvenido <?php echo $_smarty_tpl->tpl_vars['kNombre']->value;?>
<h1>");

    })
    .fail(function(respuesta){
        var res = respuesta;
      console.dir(res);
        $('#content').show();
        $('#content').html("<h1>Usuario o Password Incorrecto<h1>");
        document.cookie = "loggedin=false;";
    })
    .always(function(respuesta){
      console.log("Complete");
    });

  });
      
  
  //Logout
  $("#l-o").click(function(){
      document.cookie = "loggedin=false;";
      location.reload();
	});
});

<?php echo '</script'; ?>
>
</head>
<body>



<div class="container" id="main">
	<!--Menu-->
<nav class="navbar navbar-inverse navbar-fixed-top" id="menu">
   <div class="container-fluid">
     <div class="navbar-header">
       <!--Boton para dispositivos Moviles-->
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" dat-target="#navbar-1">
         <span class="sr-only"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </button>
       <a href="#" class="navbar-brand">Distribuidora</a>
       </div>
       <div class="collapse navbar-collapse" id="navbar-1">
         <ul class="nav navbar-nav">
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Usuario <span class="caret"></span></a>
                 <ul class="dropdown-menu">
                   <li><a href="#">Item #1</a></li>
                   <li><a href="#">Item #2</a></li>
                   <li><a class="divider"></a></li>
                   <li><a href="#">Item #4</a></li>
                 </ul>
               </li><!-- Menu Usuarios -->
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Articulos <span class="caret"></span></a>
                 <ul class="dropdown-menu">
                   <li><a href="#">Item #1</a></li>
                   <li><a href="#">Item #2</a></li>
                   <li><a class="divider"></a></li>
                   <li><a href="#">Item #4</a></li>
                 </ul>
               </li><!-- Menu Articulos -->
               <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Compras <span class="caret"></span></a>
                 <ul class="dropdown-menu">
                   <li><a href="#">Item #1</a></li>
                   <li><a href="#">Item #2</a></li>
                   <li><a class="divider"></a></li>
                   <li><a href="#">Item #4</a></li>
                 </ul>
               </li><!-- Menu Compras -->
         </ul>
         <!--Busqueda-->
         <form action="" class="navbar-form navbar-left" role="search">
           <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
        </form>
         <ul class="nav navbar-nav navbar-right">
           <li><a href=# class="fa fa-sign-out" style="font-size:48px" id="l-o"></a></li>
         </ul>
        </div> <!--Clase nav-collapse-->
      </div><!--Clase containe-fluid-->
    </nav>



<!--Fin del Menu-->

  <div class="jumbotron" id="logindiv">
    <h2 align="center">Acceso</h2>
	<form class="form-horizontal" id="loginfrm">

      <div class="form-group">
        <div class="input-group input-group-lg">
          <span class="input-group-addon"><i class="fa fa-user"></i></span>
          <input type="text" class="form-control" placeholder="Usuario" id="usr" name="usr">
        </div><!--User input-->

        <div class="input-group input-group-lg">
          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
          <input type="password" class="form-control" placeholder="Contrasena" id="pwd" name="pwd">
        </div><!--Password input-->
      </div>


      <div class="form-group">        
          <button type="submit" class="btn btn-info" id="login">Acceder</button>
      </div>
  	</form> <!-- Login Form -->
  </div><!--Clase jumbotron-->


  <div class="jumbotron" id="content">
    
  </div><!--Clase jumbotron-->


</div><!--Clase Container-->

</body>
</html>
<?php }
}
