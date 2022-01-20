<?php
	include ("funciones.php");
	head();
?>
<table>
	<tr  bgcolor="#6699CC" align="center">
		<td colspan="2"><b>Men&uacute; Coordinador</b></td>	
	</tr>	
	<tr>
		<td><a href="pedidos.php?vend=<?php echo $_GET['vend']?>&fecha=<?php echo $_GET['fecha']?>&zona=<?php echo $_GET['zona']?>">Postear Pedidos</a></td>
	</tr>
	<tr> 
		<td><a href="indexgte.php?vend=<?php echo $_GET['vend']?>&fecha=<?php echo $_GET['fecha']?>">Consultar Coordinadores</a></td>	
	</tr>
	<tr>
		<td><a href="mant_user.php?vend=<?php echo $_GET['vend']?>&fecha=<?php echo $_GET['fecha']?>">Cambiar Clave</a></td>	
	</tr>
	<tr>
		<td><a href="logout.php">Cerra Sesi&oacute;n</a></td>	
	</tr>
</table>
<?php
	foot();
?>
