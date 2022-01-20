<?php
	include("funciones.php");
//	head();
	
	$ped=$_POST['id'];	
	$cocli=$_POST['cliente'];
	
	$conpag=$_POST['conpag'];
	$plazo=$_POST['plazo'];
	$dec=$_POST['desc'];
	$obs=$_POST['obs'];
	
	$vend=$_GET['vend'];
	$fecha=$_GET['fecha'];
	$zona=$_GET['zona'];	
	
	$url_relativa="pedidos.php?vend=$vend&fecha=$fecha&zona=$zona";
	
//DETALLE PEDIDO	
	if (!empty($_POST['Chek'])){	
	$Art=implode(',',$_POST['Chek']);
	}
	if (!empty($_POST['Cantidad'])){
	$cant=implode(',',$_POST['Cantidad']);
	}
	if (!empty($_POST['promo'])){
	$promo=implode(',',$_POST['promo']);
	}
	
	if (!empty($ped)&&!empty($cocli)&&!empty($conpag)&&!empty($Art)&&!empty($cant)){
		$link=conectar();		
		$sql="select * from pedidosql where nropedido='".$ped."'";
		$result=mysql_query($sql,$link);
		$row=mysql_fetch_row($result);
		if (empty($row))
			{		
		echo $fecha;
			$sql="insert into pedidosql (nropedido,fecha,codcliente,plazo,descuento,observacion)
		 	values ('".$ped."','".cambiaf_a_mysql(date('d/m/Y'))."','".$cocli."','".$plazo."','".$dec."','".$obs."')";
			// echo $sql;
			$result=mysql_query($sql,$link);
		
			$ar_art=explode(',',$Art);
			//$ar_cant=explode(',',$cant);
			//$ar_promo=explode(',',$promo);
			$i=0;
	while ($i<count($cant)){
		if ($cant[$i]!="")
			{
			$ar_cant=$cant[$i];
			}
		}				
			
			$i=0;
			while($i<count($ar_art)) {
				$sql="insert into detallesql (nropedido,codarticulo,cantidad,promo) values ('".$ped."','".$ar_art[$i]."','".$ar_cant[$i]."','".$ar_promo[$i]."')";
				$result=mysql_query($sql,$link); 
				$i++;
				$msj="Exito";		
				}
			}else
				{
				$msj="Error el Pedido ya existe";
				echo "<script language='JavaScript'>alert(\"$msj\")</script>";
				}
	
	}
	else
	{ //$error="El Pedido anterior no se registro";
	 $msj="Error";	
	echo "<script language='JavaScript'>alert(\"$msj\")</script>";
   
	}	
		
	echo "<div>".$msj."<a href=".$url_relativa.">Volver</a></div>";
	//foot();
?>
