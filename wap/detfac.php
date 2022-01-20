<?php
	include ("funciones.php");
	session_start();
	head();		
	$vend=$_SESSION['user'];
	$fecha=$_GET['fecha'];
	$cord=$_GET['cor'];
	$zona=$_GET['zona'];
	if (!(empty($_SESSION['user'])))
		{
		$fac=$_GET['fac'];
		$link=conectar();	
		$sql="select a.fecfac, b.nombre from factura as a, clientes b where trim(a.nrofac)='".$fac."' and 		              a.codcli=b.codcli";		
//		echo $sql;
		$result=mysql_query($sql,$link);
		$row=mysql_fetch_row($result);
		$sql="select nombre from usuarios where trim(usuario)='".$_GET['vend']."'";	
		$xresult=mysql_query($sql,$link);
		$xrow=mysql_fetch_row($xresult);

		echo "<table  border='0'> \n"
		     ."<tr> \n"
		     ."<td><img src=\"logo.jpg\"/><h2>Almacendora Asoportuguesa S.A</h2></td> \n"
		     ."</tr> \n"
		     ."<tr> \n"
		     ."<td>Factura Nro: ".$fac."</td> \n"
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
		     ."<td>Cod. Articulo</td> \n"
		     ."<td>Cantidad</td> \n"
		     ."<td>Precio</td> \n"
		     ."<td>Total Art&iacute;culo</td> \n"
		     ."</tr> \n";
		$acm=0;
		$sql="select * from detalle_fac where nrofac='".$fac."'";
		$result=mysql_query($sql,$link);
		while ($row = mysql_fetch_row($result))
			{
			echo "<tr bgcolor=\"#FFFFFF\"> \n";
			echo "<td>".substr($row[1],9)."</a></td> \n";
			echo "<td>$row[2]</td> \n";
			echo "<td>".number_format($row[3],'2')."</td> \n";
			echo "<td>".number_format($row[4],'2')."</td> \n";
			$acm=$acm+$row[4];			
			//echo "<td>".$row[4]."</td> \n";
			//echo "<td>$row[8]</td> \n";
			//echo "<td>".$row[8]*($row[4]-$row[5])."</td> \n";
			echo "</tr> \n";
			}
		echo "<tr bgcolor=\"#FFFFFF\"> \n";    	 	 	
		echo "<td colspan=\"5\" align=\"right\">Total Factura: ".number_format($acm,'2')."</td> \n";
		echo "</tr> \n";
		echo "</table> \n";
		if (($_SESSION['tipo']=="cor")or($_SESSION['tipo']=="gte")){
			echo "<div align=center><a href=indexped.php?vend=".$_GET['vend']."&fecha=".$fecha."&cor=".$cord.">volver</a> \n";
		}
		else{
			echo "<div align=center><a href=indexped.php?vend=".$_SESSION['user']."&fecha=".$fecha.">volver</a> \n";
		}
		echo "<a href=logout.php>Cerrar Sesion</a></div> \n";
		
	        }
	else
		{
		};



foot();
?>
