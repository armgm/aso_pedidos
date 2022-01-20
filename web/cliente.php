<?php 
session_start(); 
$cadena=mysql_connect("localhost","root","");
		mysql_select_db("edifici");

if ($_SESSION['error_login']=="")
{
$_SESSION['error_login'] = "Login";
}

if ($_POST['login']=="si")
	{
	
		$usuario=$_POST['user'];
		$cuenta=$_POST['pass'];
	
		if (($usuario=="") || ($cuenta==""))
		{
			
			$_SESSION['error_login']="¡Datos en blanco!";
			$url_relativa = "cliente.php";
			header ("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']). "/" .$url_relativa);
		
		}
		else
		{
		
		$sql = mysql_query("SELECT UsuariCliente,claveCliente FROM usuaricliente WHERE UsuariCliente='$usuario'");
		$row = mysql_fetch_array($sql);
		
		if($row>0)
		{
			if($row[1] == $cuenta)
			{
		
			session_start();
			session_register('nombreusuario');
			$_SESSION['nombreusuario'] = $usuario;
			session_register('id_usuario');
			$_SESSION['id_usuario'] = $row[0];
			$url_relativa = "consulta.php";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/" .$url_relativa);
			}else{
			$_SESSION['error_login']="¡Contraseña incorrecta!";
			$url_relativa="cliente.php";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) .  "/" .$url_relativa);
			}
			
			}
			else
			{
			
			$_SESSION['error_login']="¡Usuario incorrecto!";
			$url_relativa="cliente.php";
			header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/" . $url_relativa);
			
			}
			
		mysql_free_result($sql);
	}
mysql_close();
	}else{
	
session_destroy();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
</head>
<body bgcolor="#FFFFFF" text="#000000" style="font-family:'Trebuchet MS'; font-size:12px;">
<div id="LoginUsuario" style="background-color:#DADADA; border:solid; border-width:1px; border-color:#666666; height:46px; width:250px; margin-left:auto; margin-right:auto;">
	<form method="post" name="form">
	  <table width="287" height="24" border="0">
        <tr>
          <td height="20">&nbsp;</td>
          <td height="20" colspan="2">&nbsp;</td>
        </tr>
      </table>
	  <table width="287" height="94" border="0">
        <tr>
          <td width="140" height="46" rowspan="2"><p align="center"><img src="iconos/mycomputer.png" alt="" width="65" height="59" /><br/>
              <span style="color:#FF0000;"><?php echo ($_SESSION['error_login']); ?></span></p></td>
          <td width="45" height="20"><div align="right">Usuario:</div></td>
          <td width="88">
		  <input name="user" type="text" size="10" maxlength="10" align="right" style="font:'Trebuchet MS'; font-size:10px;">		  </td>
        </tr>
        <tr>
          <td height="20"><div align="right">Clave:</div></td>
          <td>
		  <input name="pass" type="password" size="13" maxlength="5" align="right" style="font:'Trebuchet MS'; font-size:10px;">		  </td>
        </tr>
        <tr>
          <td height="20">&nbsp;</td>
          <td height="20" colspan="2">
            <div align="left">
              <input type="submit" name="Submit" value="Conexión" style="font:'Trebuchet MS'; font-size:9px;border-width:1px;border-style:solid;border-color:#003366; width:64px;"/>
              <input type="reset" name="Submit2" value="Vaciar" style="font:'Trebuchet MS'; font-size:9px;border-width:1px;border-style:solid;border-color:#003366; width:53px;"/>
              <input name="login" type="hidden" value="si">
            </div>
			</td>
        </tr>
      </table>
	  </form>
	</div>
</body>
</html>
