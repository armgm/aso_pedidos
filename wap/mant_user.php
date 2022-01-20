<?php
	include("funciones.php");
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
		echo "<a href=../index.php>volver</a>";
		session_destroy();	
		exit();
	   }

	////////////////// Cambio de Clave ///////////////////
	$clave1=$_POST['clave01'];
	$clave2=$_POST['clave02'];
	
	if ($clave1!=""&&$clave1==$clave2)
	{
	
	$newpasswd=$clave1;
	$encriptpass=md5($newpasswd);
	
	
	$link=conectar();
	$sql="update usuarios set passwd='".$encriptpass."' where usuario='".$vend."' and status='A'";
	$result=mysql_query($sql,$link);
//	$row=mysql_fetch_row($result);
	echo "CAMBIADA CON EXITO";
	//$cabeceras = 'From: no-reply@cantv.net'
	mail("jean@asoportuguesa.org.ve","Cambio de Clave en Sistema de Ventas con Blackberry","Usuario:".$_SESSION['user']." Clave: ".$newpasswd); 
		mail("jdavila@asoportuguesa.com","Cambio de Clave en Sistema de Ventas con Blackberry","Usuario:".$_SESSION['user']." Clave: ".$newpasswd); 

	}
	$url="?vend=".$vend."&fecha=".$fecha."&zona=".$zona;	
?>


<table cellpadding="3px" cellspacing="0px" border="1">
  <!--DWLayoutTable-->
<form name="pasword" action="<?php echo $url; ?>" method="post" >
  <tr>
    <td colspan="2"><img src="logo.jpg" width="71" height="52" />Cambio de Clave</td>
    
  </tr>
  <tr>
    <td>Nueva Clave:</td>
    <td ><input type="password" maxlength="20" name="clave01"></td>
  </tr>
  <tr>
    <td>Confirme Nueva Clave</td>
    <td><input type="password" maxlength="20" name="clave02"></td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="enviar" value="Enviar">
	  <input type="reset" value="limpiar"></td>
  </tr>
 </form>
</table>

<?php
	echo "<div aling=center><a href=logout.php>Cerrar Sesion</a> \n";
	if ($_SESSION['tipo']=="ven"){
echo "<a href=menuven.php?vend=".$_GET['vend']."&fecha=".$_GET['fecha']."&zona=".$zona.">Volver</a> \n";
	}
	if ($_SESSION['tipo']=="cor"){
	echo "<a href=menucor.php?vend=".$_GET['vend']."&fecha=".$_GET['fecha']."&zona=".$zona.">Volver</a> \n";
	}
	if ($_SESSION['tipo']=="gte"){
	echo "<a href=menugte.php?vend=".$_GET['vend']."&fecha=".$_GET['fecha']."&zona=".$zona.">Volver</a> \n";
	}

	foot();
?>
