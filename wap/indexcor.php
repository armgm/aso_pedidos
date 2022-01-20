<?php
	session_start();	
	include ("funciones.php");
	head();
		
	if ($_SESSION['tipo']!="gte"){	
	if ($_SESSION['user']==""||$_SESSION['user']!=$_GET['vend'])
	   {
		echo "No ha iniciado ninguna session ";
		echo "<a href=index.php>volver</a>";
		session_destroy();	
		exit();
	   }}

	$link=conectar();
	$vend=$_GET['vend'];
	$fecha=$_GET['fecha'];
	

	$sql="select nombre,codven from usuarios where trim(usuario) = '$vend'";
//	echo $sql;	
	$result=mysql_query($sql,$link);
	$row=mysql_fetch_row($result);
	if ($row[0]==""){
	echo "Coordinador No &eacute;xiste";
	}
	else{
		$codcor=$row[1];
		
		echo "<table cellpadding=\"0px\" cellspacing=\"0px\" border=\"0\" > \n";
		echo "<tr> \n";
		echo "<td><img src=\"logo.jpg\"/><h2><b>Almacenadora Asoportuguesa S.A.</b></h2></td> \n";
		echo "</tr> \n";	
		echo "<tr> \n";
		echo "<td><b>Coordinador: $row[0] </b></td> \n";
		echo "</tr> \n";
		echo "<tr> \n";
		echo "<td><b>Mes: $fecha</b></td> \n";
		echo "</tr> \n";
		echo "</table> \n";
		
		echo "<div><p></p><div> \n"; //Una Linea De separacion

		
		echo "<div><p></p></div> \n";
//Aqui comienza el detelle de los vendedores a su cargo		
		$sql="select nombre,zona,usuario from usuarios where nivel='V' and jefe='".$codcor."' order by zona";
	//	echo $sql;
		$result=mysql_query($sql,$link);
		echo "<table cellpadding=\"3px\" cellspacing=\"0px\" border = \"1\"> \n";
		echo "<tr  bgcolor=\"#6699CC\" align=\"center\"><td colspan=\"5\">Detalle Vendedor/Zona</td><tr> \n";		
		echo "<tr> \n";
		echo "<td><b>Nombre Vendedor</b></td> \n";
		echo "<td><b>Zona</b></td> \n";
		
		echo "</tr> \n";
		while ($row = mysql_fetch_row($result)){
			echo "<tr> \n";
			echo "<td><a href=\"indexped.php?vend=$row[2]&fecha=$fecha&cor=$vend\">$row[0]</a></td> \n";
			echo "<td>$row[1]</td> \n";
			echo "</tr> \n";
			}
		echo "</table> \n";
		
		if ($_SESSION['tipo']=="gte")
		{
		echo "<div aling=center><a href=logout.php>Cerrar Sesion</a> \n";
		echo "<a href=indexgte.php?vend=".$_SESSION['user']."&fecha=".$fecha.">volver</a></div>";	
		}else
		{
		echo "<div aling=center><a href=logout.php>Cerrar Sesion</a></div> \n";
		echo "<a href=menucor.php?vend=".$_SESSION['user']."&fecha=".$fecha.">volver</a></div>";		
		}

	}
	foot();
?>
