<?php
	include ("funciones.php");
	head();
?>
<table>
	<tr  bgcolor="#6699CC" align="center">
		<td colspan="2"><b>Men&uacute; Coordinador</b></td>	
	</tr>	
	<tr> 
		<td><a href="indexcor.php?vend=<?php echo $_GET['vend']?>&fecha=<?php echo $_GET['fecha']?>">Consultar Vendedores</a></td>	
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
