<?php
	include ("funciones.php");
	session_start();	
	head();
	
	$zona=$_GET['zona'];
//	echo $_GET['error'];
	$vend=$_GET['vend'];
	$fecha=$_GET['fecha'];
	
	$url="savepd.php?vend=".$vend."&fecha=".$fecha."&zona=".$zona;	
	
	
	if ($_SESSION['user']==""||$_SESSION['user']!=$_GET['vend'])
	   {
		//echo $_SESSION['jef'];
		echo "No ha iniciado ninguna session ";
		echo "<a href=index.php>volver</a>";
		session_destroy();	
		exit();
	   }
?>

<script language="JavaScript" type="text/javascript">
var id=""
var id2=""
function cambia1(id,id2){
if (document.getElementById(id).disabled==false) {
	document.getElementById(id).disabled=true;
	document.getElementById(id2).disabled=true;	
	return false;
	}else{
	
	document.getElementById(id).disabled=false;
	document.getElementById(id2).disabled=false;	
	return false;
	}
  }
function cambia2(){
document.getElementById('Cn2').disabled=true;return false;
  }

function descambia1(){
document.getElementById('text2').disabled=false;return false;
  }
function descambia2(){
document.getElementById('text1').disabled=false;return false;
  }
</script>

<table cellpadding="0px" cellspacing="0px" border="0">
	<tr><td><img src="logo.jpg"/></td></tr>
	<tr><td><h2>Almacenadora Asoportuguesa S.A.</h2></td></tr>	
</table>
<form id="ped" name="from1" method="post" action="<?php echo $url ?>">
	<table cellpadding="3px" cellspacing="0px" border="1"> 
		<tr>
			<td colspan="2">Postear Pedidos</td>
		</tr>
		<?php
		$link=conectar();		
		$sql="select codigo,ltrim(Nombre) from clientes where zona='".$zona."'";
	//	echo $sql;		
		$result=mysql_query($sql,$link);
		?>	
		<tr><td>Pedido Nro:<input size="6" maxlength="6" type="text" name="id"/></td><td>Fecha: <?php echo date('d/m/Y');?></td></tr>
		<tr></tr>
		<tr><td colspan="2">Cliente: <select name="cliente">
								<?php								
								while ($row=mysql_fetch_row($result)){
								$cod=$row[0];
								echo "<option value=\"$cod\">".$cod."-".$row[1]."</option> \n";	
								}
								?>
	 				 		 </select>
			 </td>
		</tr>
		
	</table>
	
	<div><p></p></div>

	<table cellpadding="3px" cellspacing="0px" border="1">
		<tr>
			<td>Condici&oacute;n: <select name="conpag">
											<option value="Credito">Cr&eacute;dito</option>
											<option value="Contado">Contado</option>
										 </select>
			</td>
			<td>Plazo: <input type="text" name="plazo"/ size="2" maxlength="2"></td>
			<td>Descuento: <input type="text" name="desc" size="2" maxlength="2"/></td>
		</tr>
		<tr>
			<td colspan="3">Observaci&oacute;n: <input type="text" name="obs" size="30" maxlength="100"/></td>
		</tr>	
	</table>
	
	<div><p></p></div>
	
	<table cellpadding="3px" cellspacing="0px" border="1">
		<tr>
			<td>PRODUCTOS</td>
			<td>Selecci&oacute;n</td>
			<td>Cantidad</td>
			<td>% Promo.</td>
						
		</tr>
		<?php
		$sql="select cod_articulo,Descripcion from articulo where status='A'";
		$result=mysql_query($sql,$link);
		$id=0;		
		while ($row=mysql_fetch_row($result)){
			echo "<tr> \n";
			echo "<td>".$row[1]."</td> \n";
			echo "<td><input type=\"checkbox\" name=\"Chek[$id]\" id=\"ch$id\" value=\"$row[0]\"  onclick=\"cambia1('Cantidad[$id]','promo[$id]')\"</td> \n";
			echo "<td><input type=\"text\" name=\"Cantidad[$id]\" id=\"Cantidad[$id]\" size=\"4\" maxlength=\"4\" </td> \n";
			echo "<td><input type=\"text\" name=\"promo[$id]\" id=\"promo[$id]\" size=\"4\" maxlength=\"4\"  </td> \n";	
			echo "</tr> \n";
			$id++;
			}		
		?>
		<tr>
			<td colspan="5"><input type="submit" name="enviar" value="enviar"/>
			<input type="reset" name="enviar" value="Restablecer"/>
			</td>
		</tr>
	</table>
</from>

<?php
	//echo "<div aling=center><a href=logout.php>Cerrar Sesion</a> \n";
	echo "<div aling=center><a href=logout.php>Cerrar Sesion</a> <a href=menuven.php?vend=".$_GET['vend']."&fecha=".$_GET['fecha'].">Volver</a> \n";
	foot();
?>