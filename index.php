<?php
	include ("funciones.php");	

	head();
	

//echo $_SERVER["HTTP_USER_AGENT"];	
	
?>
<script type="text/JavaScript">
<!--

function validaSubmite(){ 

	if (document.form.user.value == "")

		window.alert("Debe introducir su nombre")

	else

	if (document.form.passwd.value == "")

		window.alert("Debe introducir su Apellido")

	else
	
		document.form.submit()
}
	
//-->
</script> 


 <?php
	
 ?>
<LINK REL="SHORTCUT ICON" HREF="LOGO.ico">
 <form id="form" name="form" method="post" action="autenticar.php">
  <table border='0'>
   <tr><td><img src="logo.jpg"/></td></tr>
   <tr>
	<td>Usuario:</td>
   </tr>	
   <tr>
	<td>
	    <input type="text" name="user" />
	</td>
   </tr>	
   <tr>
	<td>Clave:</td>
   </tr>	
   <tr>
	<td>
  	    <input type="password" name="passwd" />
	</td>
   </tr>
   <tr>
	<td>Mes:</td>
   </tr>		
   <tr>
	<td>
	    <select name='fecha'><option value=''>- seleccione -</option>
				 <option value=enero>Enero</option>				 
				 <option value=febrero>Febrero</option>				 
				 <option value=marzo>Marzo</option>				 
				 <option value=abril>Abril</option>
				 <option value=mayo>Mayo</option>				 
				 <option value=junio>Junio</option>				 
				 <option value=julio>Julio</option>
				 <option value=agosto>Agosto</option>             
             <option value=septiembre>septiembre</option>
             <option value=octubre>Octubre</option>
             <option value=noviembre>Noviembre</option>
             <option value=diciembre>Diciembre</option>
            </select>
	  </td>
   </tr>   
	
   <tr>
	<td>		
	   <label>
	   <input type="submit" name="evnviar" value="Enviar" onclick="validaSubmite()" />
	   </label>
	   <label>
	   <input type="reset" name="borrar" value="borrar" />
	   </label>
	</td>
   </tr>
   <tr><td>El sistema Ya se encuentra disponible.</td></tr>		
   <tr><td>Por Mantenimiento fueron restauradas todas las claves al  numero de cedula nuevamente.</td></tr>		
  </table>	
</form>

<?php
	
foot();
?>
