<?php
	session_start();	
	include ("funciones.php");
	head();
	//echo $_SESSION['jef'];	
	if ($_SESSION['tipo']!="gte"){	
	if ($_SESSION['tipo']!="cor"){
	if ($_SESSION['user']==""||$_SESSION['user']!=$_GET['vend'])
	   {
		//echo $_SESSION['jef'];
		echo "No ha iniciado ninguna session ";
		echo "<a href=index.php>volver</a>";
		session_destroy();	
		exit();
	   }}}

	$link=conectar();
	$vend=$_GET['vend'];
	$cord=$_GET['cor'];	
	$fecha=$_GET['fecha'];
	

	$sql="select zona,nombre,codven from usuarios where trim(usuario) = '$vend'";
	//echo $sql;
	$result=mysql_query($sql,$link);
	$row=mysql_fetch_row($result);
	if ($row[0]==""){
	echo "Vendedor No &eacute;xiste";
	}
	else{
		$zona=$row[0];
		
		echo "<table cellpadding=\"0px\" cellspacing=\"0px\" border=\"0\" > \n";
		echo "<tr> \n";
		echo "<td><img src=\"logo.jpg\"/><h2><b>Almacenadora Asoportuguesa S.A.</b></h2></td> \n";
		echo "</tr> \n";	
		if ($_SESSION['tipo']=="cor"){
			echo "<tr><td><b>Coordinador: ".$_SESSION['Nombre']."</b></td></tr> \n";
		}		
		
		echo "<tr> \n";
		echo "<td><b>Vendedor: $row[1] </b></td> \n";
		echo "</tr> \n";
		echo "<tr> \n";
		echo "<td><b>Mes: $fecha</b></td> \n";
		echo "</tr> \n";
		echo "</table> \n";
		
		echo "<div><p></p><div> \n"; //Una Linea De separacion
//Aqui comienza la meta
		echo "<table cellpadding=\"3px\" cellspacing=\"0px\" border = \"1\"> \n";
		echo "<tr bgcolor=\"#6699CC\">\n";
		echo "<td colspan=\"3\" align=\"center\">Meta del Vendedor</td> \n";
		echo "</tr>\n";
		//echo "<tr>\n";		
		//echo "<td>C&oacute;digo de Art&iacute;culo</td> \n";
		//echo "</tr> \n";	
		//echo "<tr> \n";	
		//echo "<td>Hasta Kg.</td> \n";
		//echo "<td>Total Pedido Kg.</td> \n";
		//echo "<td>Diferencia</td> \n";
		//echo "<td>% Comisi&oacute;n</td> \n";
		$sql="select codart, kgdes, kghas  from metaven where codven='".$row[2]."' and 				    	                  fechades='".fecha_des($fecha)."' and fechahas='".fecha_has($fecha)."'";
		//echo $sql;
		$result=mysql_query($sql,$link);
		while ($row=mysql_fetch_row($result)){
		     $codart=$row[0];	
 		     echo "<tr> \n";
		     echo "<td>Cod Art: ".substr($codart,9)."</td> \n";
		     echo "</tr> \n";
			  echo "<tr> \n";			  
			  echo "<td>Hasta Kg.</td> \n";
			  echo "<td>Total Kg.</td> \n";
			  echo "<td>Diferencia</td> \n";
			  //echo "<td>% Comisi&oacute;n</td> \n";		     
			  echo "</tr> \n";		     
		     echo "<tr> \n"; 
		     echo "<td align=\"right\">".number_format($row[2],2,'.',',')."</td> \n";
		     echo "<td align=\"right\">".number_format(sumaped($codart,$zona,$link,$fecha),2,'.',',')."</td> \n";
		     echo "<td align=\"right\">".number_format(($row[2]-sumaped($codart,$zona,$link,$fecha)),2,'.',',')."</td> \n";
		     //echo "<td align=\"right\">".number_format(((sumaped($codart,$zona,$link,$fecha)*100)/$row[2]),2,'.',',')."%</td> \n";
		     echo "</tr> \n";
		}
		
		echo "</table>\n";//Final de la Tabla de metas
		echo "<div aling=center><a href=logout.php>Cerrar Sesion</a> <a href=menuven.php?vend=".$_GET['vend']."&fecha=".$_GET['fecha'].">Volver</a> \n";

		//echo "comienza";
		//echo $_SESSION['tipo'];
		switch($_SESSION['tipo'])
		{
		 case "cor":
			echo "<a href=indexcor.php?vend=".$_SESSION['user']."&fecha=".$fecha.">volver</a> \n";
			break;
		 case "gte":	
			echo "<a href=indexcor.php?vend=".$cord."&fecha=".$fecha.">volver</a> \n";
			break;
		}

		echo "</div> \n";	

	}
	foot();
?>
