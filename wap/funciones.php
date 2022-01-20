<?php

function conectar()
        {
	$sql_host = "localhost";
	$sql_usuario = "ventasweb";
	$sql_pass = "xventas142.xrRt";
	$sql_db = "ventasweb";
        if (!($link=mysql_connect("$sql_host","$sql_usuario","$sql_pass")))
                {echo "Error conectando a la base de datos."; exit(); }
        if (!mysql_select_db("$sql_db",$link))
                {echo "Error seleccionando la base de datos."; exit(); }
        return $link;
        }

////////////////////////////////////////////////////
//Convierte fecha de mysql a normal
////////////////////////////////////////////////////
function cambiaf_a_normal($fecha){
    ereg("([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
    return $lafecha;
}

////////////////////////////////////////////////////
//Convierte fecha de normal a mysql
////////////////////////////////////////////////////


function cambiaf_a_mysql($fecha){
    ereg("([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
    return $lafecha;
} 

function busca_fac($pedido,$link){
	$sql="select nrofac from factura where nropedido='".$pedido."'";
	$result=mysql_query($sql,$link);
	$row=mysql_fetch_row($result);
	if ($row[0]!=""){
	return $row[0];
	}else{
	return "No facturado";
	}
}

function busca_fec_fac($pedido,$link){
	$sql="select fecfac from factura where nropedido='".$pedido."'";
	$result=mysql_query($sql,$link);
	$row=mysql_fetch_row($result);
	if ($row[0]!=""){
	return cambiaf_a_normal($row[0]);
	}else{
	return "";
	}
}
function fecha_des($mes){
	switch($mes)
	{
	case "enero":
	return ('2007-12-28');
	break;
	
	case "febrero":
	return ('2008-01-26');
	break;

	case "marzo":
	return ('2008-03-01');
	break;

	case "abril":
	return ('2008-04-01');
	break;

	case "mayo":
	return ('2008-05-01');
	break;

	case "junio":
	return ('2008-06-01');
	break;

	case "julio":
	return ('2008-07-01');
	break;

	case "agosto":
	return ('2008-08-01');
	break;

	case "septiembre":
	return ('2008-09-01');
	break;

	case "octubre":
	return ('2008-10-01');
	break;

	case "noviembre":
	return ('2008-11-01');
	break;

	case "diciembre":
	return ('2008-12-01');
	break;
	}
}

function fecha_has($mes){
switch($mes)
	{
	case "enero":
	return ('2008-01-25');
	break;
	
	case "febrero":
	return ('2008-02-29');
	break;

	case "marzo":
	return ('2008-03-31');
	break;

	case "abril":
	return ('2008-04-30');
	break;

	case "mayo":
	return ('2008-05-31');
	break;

	case "junio":
	return ('2008-06-30');
	break;

	case "julio":
	return ('2008-07-27');
	break;

	case "agosto":
	return ('2008-08-29');
	break;

	case "septiembre":
	return ('2008-09-28');
	break;

	case "octubre":
	return ('2008-10-27');
	break;

	case "noviembre":
	return ('2008-11-30');
	break;

	case "diciembre":
	return ('2008-12-31');
	break;
	}
}

function sumaped($codart, $zona, $link,$mes){
		
	$sql="select sum(a.kilo) from detalle_ped a, pedidos b, usuarios c  where a.nropedido=b.nropedido and 	 		b.zona=c.zona  and a.cod_art='".$codart."' and b.zona='".$zona."' and b.fecha_ped between '".fecha_des($mes)."' and 		'".fecha_has($mes)."'";
	//echo $sql;
	$result=mysql_query($sql,$link);
	$row=mysql_fetch_row($result);
	if ($row>0){
		return $row[0];}
	else{
		return 0;}
	
}


function head() {
	echo ("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">\n")
	. ("<html>\n<head>\n<title>Sistema de Ventas Web Almacenadora Asoportuguesa S.A. ver: 0.2rc2</title>\n")
	. ("<meta name=\"generator\" content=\"Bluefish-mozilla-ubuntu\">\n")
	. ("<meta name=\"copyright\" content=\"\">\n")
	. ("<meta name=\"keywords\" content=\"\">\n")
	. ("<meta name=\"description\" content=\"\">\n")
	. ("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=ISO-8859-15\">\n")
	. ("<meta http-equiv=\"Content-Type\" content=\"application/xhtml+xml; charset=ISO-8859-15\">\n")
	. ("<link href=\"estilo.css\" type=\"text/css\" rel=\"Stylesheet\" rev=\"Stylesheet\">\n")
	. ("</head>\n<body>\n<div class=\"main\">\n")
	."<LINK REL=\"SHORTCUT ICON\" HREF=\"LOGO.ico\">";
}

function jscript($nombre)
	{
	echo '
<script type="text/javascript">
function Disable()
{
var x=document.getElementById("'.$nombre.'")
x.disabled=true
}
</script>';
	}

function ini_tabla() {
	echo ("<table cellpadding=\"0px\" cellspacing=\"0px\" border=\"1px\" align=\"center\" width=\"800px\">\n")
	. ("<tr>\n	<td class=\"bi\"></td>\n")
	. ("	<td align=\"center\" class=\"bc\">\n");
}

function logo() {
	echo ("		<div class=\"logo\"></div>\n");
}

function links() {
	echo ("		<div class=\"links\">\n")
	. ("			<ul id=\"links\">\n")
	. ("				<li><a href=\"index.php\">Inicio</a></li>\n")
	. ("				<li><a href=\"noticias.php\">Noticias</a></li>\n")
	. ("				<li><a href=\"sedes.php\">Sedes</a></li>\n")
	. ("				<li><a href=\"inscripciones.php\">Inscripciones</a></li>\n")
	. ("			</ul>\n")
	. ("		</div>\n");
}

function infoindex()
	{
		echo ("		<div class=\"info\">\n")
		. ("			&nbsp;&nbsp;&nbsp;El Congreso Nacional de Software Libre nace para concentrar a una selecci&oacute;n de expertos en el uso de GNU/Linux y el Software Libre de todo el territorio nacional en un ciclo itinerante de charlas y demostraciones para ofrecer al participante una muestra integral de qu&eacute; es el Software Libre y GNU/Linux, c&oacute;mo es su implementaci&oacute;n, caracter&iacute;sticas y posibilidades.<br><br>\n")
		. ("			&nbsp;&nbsp;&nbsp;El Congreso Nacional de Software Libre, asimismo, dar&aacute; espacio para que los mas destacados ponentes locales de cada regi&oacute;n expongan sus temas en el evento y demustren el potencial que existe en nuestras regiones.\n")
		. ("		</div>\n")
		. ("		<div class=\"info2\">\n")
		. ("			<i><b>Palabras de Richard Stallman sobre el PRIMER CONGRESO NACIONAL DE SOFTWARE LIBRE:</b><br>\n")
		. ("			\"El mundo entero ha visto muchas actividades locales para promover el Software Libre<br> o el sistema operativo GNU/Linux. Ahora por la primera vez vemos una actividad al <br> nivel nacional que intenta difundir las ideas de libertad en la inform&aacute;tica no s&oacute;lo<br> en el capital sino en todos partes del pa&iacute;s.<br><br> Que se imite en todos paises!\"<br></i>\n")
		. ("		</div>\n")
		. ("		<div class=\"info\">\n")
		. ("			<b>Objetivo General </b>\n")
		. ("			<br>\n")
		. ("			<ul>\n")
		. ("				<li>Impulsar la implementaci&oacute;n del Software Libre en Venezuela a trav&eacute;s de una estructura de soporte y apoyo a este movimiento y a la implementaci&oacute;n de esta tecnolog&iacute;a.</li>\n")
		. ("			</ul>\n")
		. ("			<b>Objetivos Espec&iacute;ficos</b>\n")
		. ("			<ul>\n")
		. ("				<li>Ofrecer a la poblaci&oacute;n del pa&iacute;s una muestra integral del Software Libre, sus caracter&iacute;sticas y posibilidades, llevando el conocimiento hasta ellos en un evento de alcance nacional.</li>\n")
		. ("				<li>Reunir y organizar a una comunidad de expertos de las diversas &aacute;reas de la Tecnolog&iacute;a relacionadas con el Software Libre a lo largo de todo el territorio nacional en un ciclo itinerante de charlas y demostraciones pr&aacute;cticas de esta tecnolo&iacute;a, propulsando el crecimiento profesional en las distintas regiones del pa&iacute;s.</li>\n")
		. ("				<li>Generar un documental que pueda difundir los beneficios del Software Libre y los resultados obtenidos del Congreso Nacional de Software Libre.</li>\n")
		. ("				<li>Complementar la ya existente estructura de apoyo a los Grupos de Usuarios lograda por el Primer Congreso Nacional de Software Libre</li>\n")
		. ("			</ul>\n")
		. ("		</div>\n")
		. ("		<p>Venezuela - 2006</p>\n");
	}

function aviso() {
	echo ("		<div class=\"info3\">Disponible Pronto</div>\n")
	. ("		<p>Venezuela - 2006</p>\n");
}

function fin_tabla() {
	echo ("	</td>\n	<td class=\"bd\"></td>\n</tr>\n</table>\n")
	. ("<table cellpadding=\"0px\" cellspacing=\"0px\" border=\"0px\" align=\"center\" width=\"800px\">")
	. ("<tr>\n")
	. ("	<td class=\"br1\"></td>\n")
	. ("	<td class=\"bp\"></td>\n")
	. ("	<td class=\"br2\"></td>\n")
	. ("</tr>\n")
	. ("</table>\n");
}

function foot() {
	echo ("</div>\n</body>\n</html>");
}

function foot_sedes() {
	echo ("</div>\n<div style=\"position: absolute; visibility: hidden; z-index:100;\" id=\"tipDiv\"></div>\n</body>\n</html>");
}

function crear_semilla() {
   list($usec, $sec) = explode(" ",microtime());
   return (float) $sec + ((float) $usec * 100000);
}
function GeneraClave(){
	srand(crear_semilla());
	$max_chars = round(rand(10,10));  // tendrá 10 caracteres
	$chars = array();
	for ($i="a"; $i<"z"; $i++) $chars[] = $i;  // creamos vector de letras
		$chars[] = "z";
		for ($i=0; $i<$max_chars; $i++) {
  			$letra = round(rand(0, 1));  // primero escogemos entre letra y número
  			if ($letra) // es letra
				$clave .= $chars[round(rand(0, count($chars)-1))];
		    else // es numero
				$clave .= round(rand(0, 10));
			}
return $clave;
}
?>
