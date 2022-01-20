<?php
	include ("funciones.php");
	session_start();
	head();		
	$vend=$_GET['vend'];
	$fecha=$_GET['fecha'];
	$zona=$_GET['zona'];
	if (!(empty($_SESSION['user'])))
		{
		$ped=$_GET['ped'];
		$link=conectar();	
		$sql="select a.fecha_ped, b.nombre from pedidos as a, clientes b where trim(a.nropedido)='".$ped."' and 		      a.zona='".$zona."' and a.codcli=b.codigo";		
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
		     ."</tr> \n"
		     ."<tr> \n"
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
		     ."<td>Cod. Art</td> \n"
		     ."<td>Cant. Ord</td> \n"
		     ."<td>Cant. Aju</td> \n"
		     ."<td>Cant. Desp</td> \n"
		     ."<td>Cant. total</td> \n"
   		  ."<td>Precio</td> \n"
		     //."<td>Monto</td> \n"	
		     ."</tr> \n";
		
		$sql="select a.nropedido, a.fecha_ped,b.cod_art, c.nombre, b.cant_ord, b.cant_ajust, b.cant_desp, 			      b.cant_total, b.precio from pedidos as a, detalle_ped b, clientes c 
		      where a.nropedido=b.nropedido and a.codcli=c.codigo and trim(a.zona)='".$zona."'
		      and trim(a.nropedido)='".$ped."'";
		$result=mysql_query($sql,$link);
		while ($row = mysql_fetch_row($result))
			{
			echo "<tr bgcolor=\"#FFFFFF\"> \n";
			echo "<td>".substr($row[2],9)."</a></td> \n";
			echo "<td>".number_format($row[4],2,'.',',')."</td> \n";
			echo "<td>".number_format($row[5],2,'.',',')."</td> \n";
			echo "<td>".number_format($row[6],2,'.',',')."</td> \n";
			echo "<td>".number_format($row[4],2,'.',',')."</td> \n";
			echo "<td>".number_format($row[8],2,'.',',')."</td> \n";
			//echo "<td>".number_format($row[8]*($row[4]-$row[5]),2,'.',',')."</td> \n";
			echo "</tr> \n";
			}    	 	 	
		echo "</table> \n";
		
		if (($_SESSION['tipo']=="gte")or(($_SESSION['tipo']=="cor"))){
			echo "<div align=center><a href=indexped.php?vend=".$_GET['vend']."&fecha=".$fecha."&cor=".$_GET['cor'].">volver</a> \n";
			echo "<a href=logout.php>Cerrar Sesion</a></div>";
		}
		else{
			echo "<div align=center><a href=indexped.php?vend=".$_SESSION['user']."&fecha=".$fecha.">volver</a> \n";
			echo "<a href=logout.php>Cerrar Sesion</a></div>";
		}	
		
//echo "<div align=center><a href=indexped.php?vend=".$_SESSION['user']."&fecha=".$fecha.">volver</a>
//		      
		
	        }
	else
		{
		};



foot();
?>
