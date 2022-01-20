<html>
<head><title>Generador de claves</title></head>
<body>
<?
// Por Daniel Rodríguez Herrera (http://programacion.com)

// Creamos la semilla para la función rand()
function crear_semilla() {
   list($usec, $sec) = explode(" ",microtime());
   return (float) $sec + ((float) $usec * 100000);
}
srand(crear_semilla());

// Generamos la clave
//$clave=\"\";
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
echo $clave;
?>
</body>
</html>