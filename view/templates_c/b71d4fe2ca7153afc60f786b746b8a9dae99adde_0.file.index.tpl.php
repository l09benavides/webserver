<?php
/* Smarty version 3.1.31, created on 2017-11-12 17:02:05
  from "/srv/http/distribuidora/clase1/view/templates/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a087e8d5f5816_70414988',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b71d4fe2ca7153afc60f786b746b8a9dae99adde' => 
    array (
      0 => '/srv/http/distribuidora/clase1/view/templates/index.tpl',
      1 => 1510185470,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a087e8d5f5816_70414988 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Smarty Project</title>
	<?php echo '<script'; ?>
 type="text/javascript" src="libs/jquery-2.1.1.js"><?php echo '</script'; ?>
><!--Desde el index.php-->
	<?php echo '<script'; ?>
 type="text/javascript">
		function optionMenu (id) {
			$("#content").load("index.php?accion="+id);	
		}
	<?php echo '</script'; ?>
>
</head>
<body>
	<h1><?php echo $_smarty_tpl->tpl_vars['kNombre']->value;?>
</h1>
	<center>Menu</center>
	<br>
	<hr>
	<center>
		<a href="#" onclick="optionMenu(1);"><?php echo $_smarty_tpl->tpl_vars['item1']->value;?>
</a>
		<a href="#" onclick="optionMenu(2);"><?php echo $_smarty_tpl->tpl_vars['item2']->value;?>
</a>
		<a href="#" onclick="optionMenu(3);"><?php echo $_smarty_tpl->tpl_vars['item3']->value;?>
</a>
	</center>

	<br>

	<div id="content">
		<!-- Contenido -->
	</div>
</body>
</html>
<?php }
}
