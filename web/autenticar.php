<?php
	include ("funciones.php");	

	if (!empty($_POST['user']) && (!empty($_POST['passwd'])))
		{
		$user=$_POST['user'];
		$passwd=$_POST['passwd'];
		$fecha=$_POST['fecha'];
		$tipo=$_POST['tipo'];
		$link=conectar();
		$sql="select * from usuarios where trim(usuario)='$user' and trim(passwd)='$passwd'";
		//echo $sql;		
		$result=mysql_query($sql,$link);
		$row=mysql_fetch_row($result);
		if ($row>0)
		   {
		   session_start();
  		   session_register('user');
		   $_SESSION['Nombre'] = $row[3];
		   session_register('id_usuario');
		   $_SESSION['user'] = $user;
	           session_register('tipo');
		   switch($row[2])
			{
			case "V":
			$url_relativa = "menuven.php?vend=$user&fecha=$fecha&zona=$row[5]";
			$_SESSION['tipo']="ven";
			break;
			
			case "C":
			$url_relativa = "indexcor.php?vend=$user&fecha=$fecha";
			$_SESSION['tipo']="cor";
			break;
			case "G":
			$url_relativa = "indexgte.php?vend=$user&fecha=$fecha";
			$_SESSION['tipo']="gte";
			break;
			}
		   
		   header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/" .$url_relativa);

		   }else
			{echo "Nombre de usuario o Contraseña Incorrecta ";
			echo "<a href=index.php>volver</a>";			
			}			
		}
	else 
		{
		echo "Ningun Campo debe quedar vacio";
		};
?>
