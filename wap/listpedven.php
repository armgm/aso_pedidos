<?php
	include ("funciones.php");
	session_start();
	head();		
	$vend=$_SESSION['user'];
	$fecha=$_GET['fecha'];
	$zona=$_GET['zona'];
	if (!(empty($_SESSION['user'])))
		{
		$ped=$_GET['ped'];
		$link=conectar();	
		$sql="select a.fecha_ped, b.nombre from pedidos as a, clientes b where trim(a.nropedido)='".$ped."' and 		      a.zona='".$zona."' and a.codcli=b.codcli";		
		//echo $sql;
		$result=mysql_query($sql,$link);
		$row=mysql_fetch_row($result);
		$sql="select nombre from usuarios where trim(usuario)='".$vend."'";	
		$xresult=mysql_query($sql,$link);
		$xrow=mysql_fetch_row($xresult);

		echo "<table  border='0'> \n"
		     ."<tr> \n"
		     ."<td><img src=\"logo.jpg\"/><h2>Almacendora Asoportuguesa S.A</h2></td> \n"
		     ."</tr> \n"
		     ."<tr> \n"
		     ."<td>Pedido Nro: ".$ped."</td> \n"
		     ."<td>Fecha: ".cambiaf_a_normal($row[0])."</td> \n"
		     ."</tr> \n"
		     ."<tr> \n"
		     ."<td>Vendedor: ".$xrow[0]."</td> \n"
		     ."</tr> \n"
		     ."<tr> \n"
		     ."<td>Cliente: ".$row[1]."</td> \n"
		     ."</tr> \n"

		     ."</table>";	
				
		echo "<table bgcolor=\"#6699CC\" border=\"1\" cellspacing=\"0\"> \n"
		     ."<tr> \n"
		     ."<td>Cod. Articulo</td> \n"
		     ."<td>Cant. Ordenada</td> \n"
		     ."<td>Cant. Ajustada</td> \n"
		     ."<td>Cant. Despachada</td> \n"
		     ."<td>Cant. total</td> \n"
   		     ."<td>Precio</td> \n"
		     ."<td>Monto Art</td> \n"	
		     ."</tr> \n";
		
		$sql="select a.nropedido, a.fecha_ped,b.cod_art, c.nombre, b.cant_ord, b.cant_ajust, b.cant_desp, 			      b.cant_total, b.precio from pedidos as a, detalle_ped b, clientes c 
		      where a.nropedido=b.nropedido and a.codcli=c.codcli and trim(a.zona)='".$zona."'
		      and trim(a.nropedido)='".$ped."'";
		$result=mysql_query($sql,$link);
		while ($row = mysql_fetch_row($result))
			{
			echo "<tr bgcolor=\"#FFFFFF\"> \n";
			echo "<td>$row[2]</a></td> \n";
			echo "<td>$row[4]</td> \n";
			echo "<td>$row[5]</td> \n";
			echo "<td>$row[6]</td> \n";
			echo "<td>".$row[4]."</td> \n";
			echo "<td>$row[8]</td> \n";
			echo "<td>".$row[8]*($row[4]-$row[5])."</td> \n";
			echo "</tr> \n";
			}    	 	 	
		echo "</table> \n";
		echo "<div align=center><a href=indexped.php?vend=".$_SESSION['user']."&fecha=".$fecha.">volver</a>
		      <a href=logout.php>Cerrar Sesion</a></div>";
		
	        }
	else
		{
		};



foot();
?>
