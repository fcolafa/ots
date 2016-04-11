
	<div class="view">
			<table width="600px" class="logo">
				<thead>
					<tr>
						<td width="40%">
							<h5><?=$model->empresa->NOMBRE_EMPRESA ?></h5>
						</td>
						<td rowspan="3"><h3 class="text-center"> ORDEN DE TRABAJO N° <?php echo $model->ID_OT; ?></h3></td>
					</tr>
					<tr>
						<td><h6> RUT : 
							<?=$model->empresa->RUT_EMPRESA ?></h6>
						</td>
					</tr>
					<tr>
						<td><h6>
							<?=$model->empresa->CASA_MATRIZ ?></h6>
						</td>
					</tr>
					<tr>
						<td><h6>
							<?=$model->empresa->CIUDAD ?></h6>
						</td>
					</tr>
				</thead>
			</table>
				<br><br>
			<table width="700px">
				<tr>
					<td width="50px"><h5> Señor (es) </h5></td><td width="430px">:<?=$model->contratista->NOMBRE_CONTRATISTA ?> </td>
					<td width="80x"><h6> Transporte </h6></td><td width="5px">:</td><td class="table-bordered text-center"  width="35px"><?php if ($model->ID_TIPO_OT == 2) echo "X";?></td>
				</tr>
				<tr>
					<td><h5> RUT </h5></td><td>: <?=$model->contratista->RUT_CONTRATISTA ?> </td>
					<td><h6> Obra Vendida </h6></td><td>:</td><td class="table-bordered text-center"><?php if ($model->ID_TIPO_OT == 3) echo "X";?></td>
				</tr>
				<tr>
					<td><h5> Dirección </h5></td><td>: <?=$model->contratista->DIRECCION_CONTRATISTA ?> </td>
					<td><h6> Mano de Obra </h6></td><td>:</td><td class="table-bordered text-center"> <?php if ($model->ID_TIPO_OT == 4) echo "X";?></td>
				</tr>
				<tr>
					<td><h5> Giro </h5></td><td>: <?=$model->contratista->GIRO_AREA ?> </td>
					<td><h6> Reparación </h6></td><td>:</td><td class="table-bordered text-center"><?php if ($model->ID_TIPO_OT == 5) echo "X";?></td>
				</tr>
			</table>
			<HR style="background-color:black; height:1px;">
				<br>
			<table width="710px">
					<tr>
						<td width="60px"><h5>Solicitante </h5></td><td width="250px"><h5>: <small><?=$model->SOLICITANTE ?></small></h5></td>
						<td width="110px"><h5>Supervisor </h5></td><td width="290px"><h5>: <small><?=$model->SUPERVISOR ?></small></h5></td>
					</tr>
						
					<tr>
						<td><h5>Departamento </h5></td><td><h5>: <small><?=$model->departamentos->NOMBRE_DEPARTAMENTO ?></small></h5></td>
						<td><h5>Fecha Ejecución </h5></td><td><h5>: <small><?=$model->FECHA_EJECUCION ?></small></h5></td>
					</tr>
			</table>
					<br>
			<table width="710px">
				<font size="4">
					<tr>
						<td><h4> Descripcion del Trabajo : <small> <?=$model->DESCRIPCION_OT ?></small> </h4></td>								
					</tr>
				</font>
			</table>
				<br><br>
			<table width="800px">

				<!-- <td colspan='3'><b> Fecha : </b><?php//echo$model->FECHA_OT?> </td> -->

			  <tr class='table-bordered'>
					<th width='5%' class="text-center">Nro</th>
					<th width='50%'>Descripción</th>
					<th width='13%'>Valor Total</th>
					<th width='12%'>Factura</th>
					<th width='20%'> Centro Costos </th>
			  </tr>

				<?php  $item_actual = ""; $neto = 0; $iva = 0; $total = 0;
						foreach ($detalle as $det): ?>

						<tr class="table-bordered">
							<td class="text-right"><small><?=$det->NUMERO_SUB_ITEM.". "?></small></td>
							<td><small><?=$det->NOMBRE_SUB_ITEM ?></small></td>
							<td class="text-right"><small><?=$det->CANTIDAD?></small></td>
							<td class="text-right"><small><?=number_format($det->COSTO_CONTRATISTA,0,',','.')?></small></td>
							<td class="text-right"><small><?=@number_format($det->FACTURA,0,',','.')?></small></td>
						</tr>
						<?php $neto += $det->COSTO_CONTRATISTA;
						endforeach; 
							$iva = ($neto * 19 / 100) ;
							$total = $neto + $iva;
				?>
			</table>
				<br>
			<table width="800px">
				<tr>
					<td width='70%'></td><td class="bordered" width='10%'>Neto</td>
					<td width='20%' class="text-right bordered"> <?=number_format($neto,0,',','.')?>	</td>
				</tr>
				<?php if ($model->APLICA_IVA) : ?>
					<tr>
						<td width='70%'></td><td class="bordered" width='10%'>IVA</td>
						<td width='20%' class="text-right bordered"> <?=number_format($iva,0,',','.')?>	</td>
					</tr>
					<tr>
						<td width='70%'></td><td class="bordered" width='10%'>Total</td>
						<td width='20%' class="text-right bordered"> <?=number_format($total,0,',','.')?>	</td>
					</tr>
				<?php else : ?>
					<tr>
						<td width='70%'></td><td class="bordered" width='10%'>IVA</td>
						<td width='20%' class="text-right bordered"> 0	</td>
					</tr>
					<tr>
						<td width='70%'></td><td class="bordered" width='10%'>Total</td>
						<td width='20%' class="text-right bordered"> <?=number_format($neto,0,',','.')?>	</td>
					</tr>
				<?php endif; ?>

			</table>
			<br>
			<table width="800px">
				<tr>
					<td width='40%' class="bordered h7 text-center" valign="top" rowspan="4">V°B° J. Departamento</td><td class="bordered h7" colspan="3" width='60%'>Autorizado por:</td>
				</tr>
				<tr>
					<td width='20%' class="bordered"><br><br><br><br></td><td width='20%' class="bordered"><br><br><br><br></td><td width='20%' class="bordered"><br><br><br><br></td>
				</tr>
				<tr>
					<td width='20%' class="bordered h7 text-center"> V°B° Administrador</td><td width='20%' class="bordered h7 text-center">V°B° G.OP.</td><td width='20%' class="bordered h7 text-center">V°B° G.G</td>
				</tr>
				<tr>
					<td width='20%' class="bordered h7 text-center"> Monto hasta USD 2.500</td><td width='40%' class="bordered h7 text-center" colspan="2">Monto sobre USD 2.500</td>
				</tr>
			</table>	
	</div>


<style type="text/css">
  .table-bordered th, .table-bordered td, .table-bordered{border:1px solid #0B0B3B !important;} .bordered{border:1px solid #0B0B3B !important;}
  table {border-spacing:0; border-collapse:collapse;}
  .text-left{text-align:left;} .text-right{text-align: right;} .text-center{text-align: center;}
	h1{font-size:30px;} h2{font-size:24px;} h3{font-size: 18px;} h4{font-size:14px;} h5{font-size: 12px;} h6{font-size: 10px;} .h7{font-size: 8px;} 
	h1 small, h2 small, h3 small, h4 small, h5 small, h6 small{font-weight:normal !important;} 
	.logo {background-image:url('<?=$_SERVER["SERVER_NAME"]."/../themes/default/img/icons/logoastilleros.png"?>'); background-repeat:no-repeat;	background-position: 10px 15px; background-size: 60px 60px;}

</style>