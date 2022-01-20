<?php
include("funciones.php"); 
	head();
	
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
				 <option value=septiembre>Enero</option>				 
				 <option value=septiembre>Febrero</option>				 
				 <option value=septiembre>Marzo</option>				 
				 <option value=septiembre>Abril</option>
				 <option value=septiembre>Mayo</option>				 
				 <option value=septiembre>Junio</option>				 
				 <option value=septiembre>Julio</option>
				 <option value=septiembre>Agosto</option>             
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
   		
  </table>	
</form>

<?php
	
foot();
?>
