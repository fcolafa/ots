
	<div class="view">
			<table width="600px" class="logo">
				<thead>
					<tr>
						<td width="40%">
							<h5><?=$model->empresa->NOMBRE_EMPRESA ?></h5>
						</td>
						<td rowspan="3"><h3 class="text-center"> ORDEN DE TRABAJO N° <?php echo $model->NUMERO_OT; ?></h3></td>
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
				<tr>
					<td><h5> Fecha OT </h5></td><td>: <?=Yii::app()->dateFormatter->format("d MMMM y",strtotime($model->FECHA_OT)) ?></td>
					<td><h6> Arriendo </h6></td><td>:</td><td class="table-bordered text-center"><?php if ($model->ID_TIPO_OT == 6) echo "X";?></td>
				</tr>
			</table>
			<HR style="background-color:black; height:1px;">
				<br>
			<table width="710px">
					<tr>
						<td width="60px"><h5>Solicitante </h5></td><td width="250px"><h5>: <small><?= @$model->solicitante->NOMBRE_PERSONA . ' ' . @$model->solicitante->APELLIDO_PERSONA ?></small></h5></td>
						<td width="110px"><h5>Supervisor </h5></td><td width="290px"><h5>: <small><?= @$model->personal->NOMBRE_PERSONA .' '.@$model->personal->APELLIDO_PERSONA ?></small></h5></td>
					</tr>
						
					<tr>
						<td><h5>Departamento </h5></td><td><h5>: <small><?=$model->departamentos->NOMBRE_DEPARTAMENTO ?></small></h5></td>
						<td><h5>Fecha Ejecución </h5></td><td><h5>: <small><?=Yii::app()->dateFormatter->format("d MMMM y",strtotime($model->FECHA_EJECUCION)) ?></small></h5></td>
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
			<table width="100%" class="table table-condensed bordered">
			<thead>
				<br><br>
				<tr> 
					<th colspan="9">
						<center>DISTRIBUCION DE COSTOS</center>
					</th>
				</tr>
			
			</thead>
                        </table>
                                <table>
                                    	<tr>
					<th width="5%" class="bordered"> N°</th>
					<th width="44%" class="bordered"> Descripción</th>
					<th width="12%" class="text-right bordered"> Valor Total</th>
					<th width="7%" class="text-right bordered"> Cotizacion</th>
					<th width="7%" class="bordered"> C. C.</th>
					<th width="9%" class="bordered"> C. C. C.</th>
					<th width="9%" class="bordered"> S. C. C.</th>
					<th width="7%" class="bordered"> S. E. C.</th>
				<tr>
				<?php // inicializo los acumuladores
				$tot_contrat = 0; 
				foreach ($detalle as $sub){	?>
						<tr>
							<td class="bordered"> <?=$sub->NUMERO_SUB_ITEM?> </td>
							<td class="bordered"> <?=$sub->NOMBRE_SUB_ITEM?> </td>
							<td class="text-right bordered"> <?=$this->getFormat($model->tipo_moneda->TIPO_MONEDA, $sub->COSTO_CONTRATISTA) ?> </td>
							<td class="text-right bordered"> <?=$sub->NRO_COTIZACION ?> </td>
							<td class="text-right bordered"> <?=@$sub->centroCosto->NUMERO_CENTRO ?> </td>
							<td class="text-right bordered"> <?=@$sub->iDCCC->NUMERO_CUENTA ?> </td>
							<td class="text-right bordered"> <?=@$sub->iDSCC->SCC_NUMERO ?> </td>
							<td class="text-right bordered"> <?=@$sub->iDSEC->SEC_NUMERO ?> </td>
						</tr>
					<?php $tot_contrat += $sub->COSTO_CONTRATISTA; 
                                } ?>
			
                    </table>
				<br>
			<table width="800px">
				<tr>
					<td width='70%'></td><td class="bordered" width='10%'>Neto <?=$model->tipo_moneda->SIGNO_MONEDA ?></td>
					<td width='20%' class="text-right bordered"> <?=$this->getFormat($model->tipo_moneda->TIPO_MONEDA,$tot_contrat)?>	</td>
				</tr>
				<?php if ($model->APLICA_IVA==1) : 
					$iva = $tot_contrat*0.19;
				?>
					<tr>
						<td width='70%'></td><td class="bordered" width='10%'>IVA <?=$model->tipo_moneda->SIGNO_MONEDA ?></td>
						<td width='20%' class="text-right bordered"> <?=$this->getFormat($model->tipo_moneda->TIPO_MONEDA,$iva)?>	</td>
					</tr>
					<tr>
						<td width='70%'></td><td class="bordered" width='10%'>Total <?=$model->tipo_moneda->SIGNO_MONEDA ?></td>
						<td width='20%' class="text-right bordered"> <?=$this->getFormat($model->tipo_moneda->TIPO_MONEDA,$tot_contrat+$iva)?>	</td>
					</tr>
				<?php elseif($model->APLICA_IVA==2):?>
					<tr>
						<td width='70%'></td><td class="bordered" width='10%'>IVA <?=$model->tipo_moneda->SIGNO_MONEDA ?></td>
						<td width='20%' class="text-right bordered"> 0	</td>
					</tr>
					<tr>
						<td width='70%'></td><td class="bordered" width='10%'>Total <?=$model->tipo_moneda->SIGNO_MONEDA ?></td>
						<td width='20%' class="text-right bordered"> <?=$this->getFormat($model->tipo_moneda->TIPO_MONEDA,$tot_contrat)?>	</td>
					</tr>
				<?php elseif($model->APLICA_IVA==3):?>
					<tr>
						<td width='70%'></td><td class="bordered" width='10%'> -10% <?=$model->tipo_moneda->SIGNO_MONEDA ?></td>
						<td width='20%' class="text-right bordered"> <?=$this->getFormat($model->tipo_moneda->TIPO_MONEDA,$tot_contrat*0.1)?>	</td>
					</tr>
					<tr>
						<td width='70%'></td><td class="bordered" width='10%'>Total <?=$model->tipo_moneda->SIGNO_MONEDA ?></td>
						<td width='20%' class="text-right bordered"> <?=$this->getFormat($model->tipo_moneda->TIPO_MONEDA,$tot_contrat*0.9)?>	</td>
					</tr>
				<?php endif; ?>

			</table>
			<br>
			
                        <?= $this->getFirmas($model);?>
	</div>


<style type="text/css">
    .firma{
    text-align: center;
}
.firma img{
    height:auto; 
    width:90px;
}
  .table-bordered th, .table-bordered td, .table-bordered{border:1px solid #0B0B3B !important;} .bordered{border:1px solid #0B0B3B !important;}
  table {border-spacing:0; border-collapse:collapse;}
  .text-left{text-align:left;} .text-right{text-align: right;} .text-center{text-align: center;}
	h1{font-size:30px;} h2{font-size:24px;} h3{font-size: 18px;} h4{font-size:14px;} h5{font-size: 12px;} h6{font-size: 10px;} .h7{font-size: 8px;} 
	h1 small, h2 small, h3 small, h4 small, h5 small, h6 small{font-weight:normal !important;}
        div.firma{
    text-align: center;
}

div.firma{
    text-align: center;
}
div.firma img{
    height:auto; 
    width:900px;
}
/*.firma img{
    height:auto; 
    width:90px;
}
.firma p{
    font-size:10px;
    font-weight: bold; 
    font-style: italic;
}*/
	.logo {background-image:url('<?=$_SERVER["SERVER_NAME"]."/../archivos/empresas/".Yii::app()->getSession()->get('id_empresa').'.jpg'?>'); background-repeat:no-repeat;	background-position: 10px 15px; background-size: 60px 60px;}

</style>