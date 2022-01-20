<?php
	include("funciones.php");
//	head();
	
	$ped=$_POST['id'];	
	$cocli=$_POST['cliente'];
	$Dfecha=date('d/m/Y');
	$conpag=$_POST['conpag'];
//	$plazo=$_POST['plazo'];
	$dec=$_POST['desc'];
	$obs=$_POST['obs'];
	
	$vend=$_GET['vend'];
	$fecha=$_GET['fecha'];
	$zona=$_GET['zona'];	
	
	$url_relativa="pedidos.php?vend=$vend&fecha=$fecha&zona=$zona";
	
	if(strlen($ped)!=6){
		$msj="error el Numero de Pedido debe tener 6 digitos";
		echo "<div>".$msj."<a href=".$url_relativa.">Volver</a></div>";
		exit;
	}
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
	if (!empty($_POST['promo'])){
	$precio=implode(',',$_POST['precio']);
	}
	
	if (!empty($ped)&&!empty($cocli)&&!empty($conpag)&&!empty($Art)&&!empty($cant)){
		$link=conectar();		
		$sql="select * from pedidosql where nropedido='".$ped."'";
		$result=mysql_query($sql,$link);
		$row=mysql_fetch_row($result);
		if (empty($row))
			{		
		
			$sql="insert into pedidosql (nropedido,fecha,codcliente,plazo,descuento,observacion,status)
		 	values ('".$ped."','".cambiaf_a_mysql($Dfecha)."','".$cocli."','".$conpag."','".$dec."','".$obs."','A')";
//			 echo $sql;
			$result=mysql_query($sql,$link);
			
			// Insercion para consulta directa en la web. "falta buscar la zona que es necesaria para la busqueda"
			$sql="insert into pedidos(nropedido,fecha_ped,codcli,monped,zona,status) values ('".$ped."','".cambiaf_a_mysql($Dfecha)."','".$cocli."','0','".$zona."','T')";
			
			$result=mysql_query($sql,$link);
			//****************************************************************************************************
			
		//	$ar_art=explode(',',$Art);
		//	$ar_cant=explode(',',$cant);
		//	$ar_promo=explode(',',$promo);		
		//	$i=0;
		
			$ar_art=explode(',',$Art);
			$ar_cant=explode(',',$cant);
			$ar_promo=explode(',',$promo);
			$ar_precio=explode(',',$precio); 
	
			$i=0;
			$j=0;	
	while ($i<count($ar_cant)){
		if ($ar_cant[$i]!="")
			{
			//echo $j." - ".$ar_cant[$i];			
			$arx_cant[$j]=$ar_cant[$i];
			$arx_precio[$j]=$ar_precio[$i];
			$arx_promo[$j]=$ar_promo[$i];
			$j++;
			}
		$i++;
		}						
		
		$i=0;
			while($i<count($ar_art)) {
				$sql="insert into detallesql (nropedido,codarticulo,precio,cantidad,promo) values ('".$ped."','".$ar_art[$i]."','".$arx_precio[$i]. "','".$arx_cant[$i]."','".$arx_promo[$i]."')";
				$result=mysql_query($sql,$link); 

//Insercion para consulta directa de los pedidos en linea al postearlos
				
				$sql="select relart from articulo where cod_articulo='".$ar_art[$i]."'";
				#echo $sql;
				$result=mysql_query($sql,$link);
				$row=mysql_fetch_row($result);
				$relart=$row[0];
			//	echo $relart;					
				$kilo=$relart*$arx_cant[$i];

				$sql="insert into detalle_ped (nropedido,cod_art,cant_ord,cant_ajust,cant_desp,cant_total,precio,kilo)
				values ('".$ped."','".$ar_art[$i]."','".$arx_cant[$i]."','0','0','".$arx_cant[$i]."','".$arx_precio[$i]."','".$kilo."')";
				
				$result=mysql_query($sql,$link);
//************************************************************************
				$i++;
				$msj="Pedido Guardado con Exito, Su estatus sera T (Trnasito) ";		
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
