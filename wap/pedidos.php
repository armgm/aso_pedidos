<?php
	include ("funciones.php");
	session_start();	
	head();
	
	$zona=$_GET['zona'];
//	echo $_GET['error'];
	$vend=$_GET['vend'];
	$fecha=$_GET['fecha'];
	
	
	

	if ($_SESSION['user']==""||$_SESSION['user']!=$_GET['vend'])
	   {
		//echo $_SESSION['jef'];
		echo "No ha iniciado ninguna session ";
		echo "<a href=index.php>volver</a>";
		session_destroy();	
		exit();
	   }
	   $link=conectar();		
		// BUSCA LA ZONA EN CASO DE PERDERLA EN EL URL
		if ($zona=="")
		{
		$sql="select zona from usuarios where usuario='".$vend."'";
		$result=mysql_query($sql,$link);
		$row=mysql_fetch_row($result);
		$zona=$row[0];
		}
		/////////////////////////////////////////////////
	   $url="savepd.php?vend=".$vend."&fecha=".$fecha."&zona=".$zona;	
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
</table>
<form id="ped" name="from1" method="post" action="<?php echo $url ?>">
	<table cellpadding="3px" cellspacing="0px" border="1"> 
		<tr>
			<td colspan="2">Postear Pedidos</td>
		</tr>
		<?php
		if ($_SESSION['tipo']=="gte")
			{
			$sql="select codigo,ltrim(Nombre) from clientes order by nombre";
			}
		else
			{
			$sql="select codigo,ltrim(Nombre) from clientes where zona='".$zona."' order by nombre";
			}
		$result=mysql_query($sql,$link);
		?>	
		<tr><td>Pedido Nro:<input size="6" maxlength="6" type="text" name="id"/></td><td>Fecha: <?php echo date('d/m/Y');?></td></tr>
		<tr></tr>
		<tr><td colspan="2">Cliente: <select name="cliente">
								<?php								
								while ($row=mysql_fetch_row($result))
								{
									$cod=$row[0];
									if ($_SESSION['tipo']!="gte")
									{
										echo "<option value=\"$cod\">".substr($cod,6)."-".$row[1]."</option> \n";
									}
									else
									{
										echo "<option value=\"$cod\">".$row[1]."</option> \n";
									}
								}
					 			?>
	 				    </select>
			 </td>
		</tr>
		
	</table>
	
	<div><p></p></div>

	<table cellpadding="3px" cellspacing="0px" border="1">
		<tr>
			<td>Condici&oacute;n de pago:
								<select name="conpag">
								<?php
								$sql="select * from facompag";
								$result=mysql_query($sql,$link);
								while ($row=mysql_fetch_row($result))
								{
								//echo $row[0]."-".$row[1];
								echo "<option value=\"".$row[0]."\">".$row[1]."</option> \n";
								}
								?>
								</select>
			</td>
		</tr>
<!--		<tr>	
			<td>Plazo: <input type="text" name="plazo"/ size="2" maxlength="2"></td>
		</tr>

//-->		<tr>			
			<td>Descuento: <input type="text" name="desc" value="0" size="2" maxlength="2"/></td>
		</tr>
		<tr>
			<td colspan="3">Observaci&oacute;n: <input type="text" name="obs" size="30" maxlength="100"/></td>
		</tr>	
	</table>
	
	<div><p></p></div>
	
	<table cellpadding="3px" cellspacing="0px" border="1">
		
		<?php
		$sql="select cod_articulo,Descripcion from articulo where status='A' order by Descripcion";
		$result=mysql_query($sql,$link);
		$id=0;		
		while ($row=mysql_fetch_row($result)){
			echo "<tr> \n";
			echo "<td><input type=\"checkbox\" name=\"Chek[$id]\" id=\"ch$id\" value=\"$row[0]\" </td> \n";
			echo "<td>".$row[1]."</td> \n";
			
			echo "</tr> \n";
			echo "<tr> \n";			
			echo "<td>Cant</td><td><input type=\"text\" name=\"Cantidad[$id]\" id=\"Cantidad[$id]\" size=\"4\" maxlength=\"4\" </td> \n";
			echo "</tr> \n";
			echo "<tr> \n";			
			echo "<td>Precio</td><td><input type=\"text\" name=\"precio[$id]\" id=\"precio[$id]\" size=\"4\" maxlength=\"15\"</td> \n";	
			echo "</tr> \n";
			echo "<tr> \n";			
			echo "<td>% Promo</td><td><input type=\"text\" name=\"promo[$id]\" id=\"promo[$id]\" size=\"4\" maxlength=\"4\"</td> \n";			
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
	echo "<div aling=center><a href=logout.php>Cerrar Sesion</a>";

	switch ($_SESSION['tipo'])
	{
		case "ven":
		echo "<a href=menuven.php?vend=".$_GET['vend']."&fecha=".$_GET['fecha']."&zona=".$zona.">Volver</a> \n";
		break;
		case "gte":
		echo "<a href=menugte.php?vend=".$_GET['vend']."&fecha=".$_GET['fecha']."&zona=".$zona.">Volver</a> \n";
		break;
		case "cor":
		echo "<a href=menucor.php?vend=".$_GET['vend']."&fecha=".$_GET['fecha']."&zona=".$zona.">Volver</a> \n";
		break;
	}
	foot();
?>
