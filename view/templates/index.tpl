<html>
<head>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>

$(document).ready(function(){
  $('#menu').hide();
  $('#content').hide();


$("#login").click(function(){
    var data = $("#loginfrm").serialize();
    $.ajax({
      url: 'control/Controller_login.php',
      type: 'POST',
      dataType: 'json',
      data: data
    })
    .done(function(respuesta){
      console.log("Success");
        $('#logindiv').hide();
        $('#menu').show();
        $('#content').show();
        $('#content').html("<h1>Bienvenido {$kNombre}<h1>");
    })
    .fail(function(respuesta){
      console.log("Error");
        $('#content').show();
        $('#content').html("<h1>Usuario o Password Incorrecto<h1>");
    })
    .always(function(respuesta){
      console.log("Complete");
    });

  });
      
  
  //Logout
  $("#l-o").click(function(){
      $('#menu').hide();
      $('#content').hide();
      $('#logindiv').show();
	});
});

</script>
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
