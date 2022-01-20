<?php
	include ("funciones.php");
	session_start();	
	head();	
	if ($_SESSION['user']==""||$_GET['vend']!=$_SESSION['user']){
			echo "No ha iniciado ninguna sesi&oacute;n";
			echo "<a href=index.php>volver</a>";
			session_destroy();
			exit();
	}
	
	$fecha=$_GET['fecha'];
	$link=conectar();	
	$sql="select nombre from usuarios where usuario='".$_SESSION['user']."'";
	$result=mysql_query($sql,$link);	
	$row=mysql_fetch_row($result);
	echo "<table cellpadding=\"0px\" cellspacing=\"0px\" border=\"0\" > \n";
	echo "<tr> \n";
	echo "<td><img src=\"logo.jpg\"/><h2><b>Almacenadora Asoportuguesa S.A.</b></h2></td> \n";
	echo "</tr> \n";	
	echo "<tr> \n";
	echo "<td><b>Gerente: $row[0] </b></td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
	echo "<td><b>Mes: $fecha</b></td> \n";
	echo "</tr> \n";
	echo "</table> \n";
	
	echo "<div><p></p><div> \n"; //Una Linea De separacion


	$sql="select usuario, nombre from usuarios where jefe is null and usuario<>'".$_GET['vend']."'";
	//echo $sql;
	$result=mysql_query($sql,$link);
	echo "<table cellpadding=\"3px\" cellspacing=\"0px\" border = \"1\"> \n";
	echo "<tr  bgcolor=\"#6699CC\" align=\"center\"><td colspan=\"5\">Listado de Coordinadores</td><tr>";	
	while ($row = mysql_fetch_row($result))
		{
		echo "<tr> \n";
		echo "<td><a href=\"indexcor.php?vend=$row[0]&fecha=$fecha\">$row[1]</a></td> \n";
		//echo "<td>$row[1]</td> \n";
		echo "</tr> \n";
		}
	echo "</table> \n";
	echo "<div aling=center><a href=logout.php>Cerrar Sesion</a></div> \n";
	echo "<a href=menugte.php?vend=".$_SESSION['user']."&fecha=".$fecha.">volver</a></div>";		
	
?>
