<?php
/* @var $this OrdenTrabajoController */
/* @var $model OrdenTrabajo */

$this->breadcrumbs=array(
	'Orden Trabajos'=>array('index'),
	$model->ID_OT,
);

$this->menu=array(
	//array('label'=>'Ver Orden de Trabajo', 'url'=>array('index')),
	array('label'=>'Exportar a PDF', 'url'=>array('viewPDF', 'id'=>$model->ID_OT), 'visible'=>$model->APROBADO_I25==1?1:0, 'linkOptions' => array('target'=>'_blank')),
	array('label'=>'Crear Orden de Trabajo', 'url'=>array('create')),
	array('label'=>'Actualizar Orden de Trabajo', 'url'=>array('update', 'id'=>$model->ID_OT)),
	array('label'=>'Borrar Orden de Trabajo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_OT),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar Orden de Trabajo', 'url'=>array('admin')),
);
?>




	<div class="borde-azul">
		<table width="100%">
			<thead class="borde-abajo">
				<tr>
					<td width="20%">
						<b><?=$model->empresa->NOMBRE_EMPRESA ?></b>
					</td>
					<td rowspan="4"><h3 class="text-center"> ORDEN DE TRABAJO N° : <?php echo $model->ID_OT; ?></h3></td>
				</tr>
				<tr>
					<td width="20%"> RUT : 
						<?=$model->empresa->RUT_EMPRESA ?>
					</td>
				</tr>
				<tr>
					<td width="20%">
						<?=$model->empresa->CASA_MATRIZ ?>
					</td>
				</tr>
				<tr>
					<td width="20%">
						<?=$model->empresa->CIUDAD ?>
					</td>
				</tr>
			</thead>
		</table>
		<table width="100%">
			<thead>
				<tr><td colspan="3"><br></td></tr>
			</thead>
			<tbody class="borde-abajo">
				<tr>
					<td width="40%"><b>Señor (es) : 
						<?=$model->contratista->NOMBRE_CONTRATISTA ?></b>
					</td>
					<td width="30%">Fecha OT : 
						<?=$model->FECHA_OT ?>
					</td>
					<td width="30%"></td>
				</tr>
				<tr>
					<td>Dirección : 
						<b><?=$model->contratista->DIRECCION_CONTRATISTA ?></b>
					</td>
					<td>Ciudad :
						<?=$model->contratista->CIUDAD_CONTRATISTA ?>
					</td>
					<td>Telefono :
						<?=$model->contratista->TELEFONO_CONTRATISTA ?>
					</td>
				</tr>

			</tbody>
			<tbody class="borde-abajo	">
				<tr>
					<td colspan="2">Solicitante :
					</td>
					<td>Tipo de OT :
						<b><?=$model->tipo_de_ot->NOMBRE_TIPO_OT ?></b>
					</td>
				</tr>
				<tr>
					<td colspan="2">Supervisor :
						<?=@$model->personal->NOMBRE_PERSONA ?>
					</td>
					<td>
						
					</td>
				</tr>
				<tr>
					<td colspan="2">Departamento :
						<?=$model->departamentos->NOMBRE_DEPARTAMENTO ?>
					</td>
					<td> Fecha Ejecución :
						<?=$model->FECHA_EJECUCION ?>
					</td>
				</tr>
			</tbody>

			<tbody class="borde-abajo">
				<tr>
					<td><br><b>DESCRIPCION DEL TRABAJO</b></td>
				</tr>
				<tr>
					<td colspan="3">:
						<?=$model->DESCRIPCION_OT ?>
					</td>
				</tr>
				<tr>
					<td colspan="3"></td>
				</tr>
			</tbody>
		</table>

		<table width="100%" class="table table-condensed bordered">
			<thead>
				<br><br>
				<tr> 
					<th colspan="5">
						DISTRIBUCION DE COSTOS:
					</th>
				</tr>
				<tr>
					<th width="7%" class="bordered"> N°</th>
					<th width="60%" class="bordered"> Descripción</th>
					<th width="10%" class="text-right bordered"> Valor Total</th>
					<th width="10%" class="text-right bordered"> Factura</th>
					<th width="13%" class="bordered"> Centro de Costos</th>
				<tr>
			</thead>
			<tbody>
				<?php // inicializo los acumuladores
				$tot_contrat = 0; 

				foreach ($sub_items as $sub): 	?>
						<tr>
							<td class="bordered"> <?=$sub->NUMERO_SUB_ITEM?> </td>
							<td class="bordered"> <?=$sub->NOMBRE_SUB_ITEM?> </td>
							<td class="text-right bordered"> <?=number_format($sub->COSTO_CONTRATISTA,0,',','.')?> </td>
							<td class="text-right bordered"> <?=$sub->NRO_COTIZACION?> </td>
							<td class="text-right bordered"> --- </td>
						</tr>
					<?php $tot_contrat += $sub->COSTO_CONTRATISTA; 
				endforeach; ?>
			</tbody>
		</table>

		<table width="100%">
			<tr>
				<td width='57%'></td><td class="bordered" width='10%'>Neto</td>
				<td width='10%' class="text-right bordered"> <?=number_format($tot_contrat,0,',','.')?>	</td>
				<td width='23%'></td>
			</tr>
			<?php if ($model->APLICA_IVA) : ?>
				<tr>
					<td width='57%'></td><td class="bordered" width='10%'>IVA</td>
					<td width='10%' class="text-right bordered"> <?=number_format(($tot_contrat*19/100),0,',','.')?>	</td>
					<td width='23%'></td>
				</tr>
				<tr>
					<td width='57%'></td><td class="bordered" width='10%'>Total</td>
					<td width='10%' class="text-right bordered"> <?=number_format(($tot_contrat+($tot_contrat*19/100)),0,',','.')?>	</td>
					<td width='23%'></td>
				</tr>
			<?php else : ?>
				<tr>
					<td width='57%'></td><td class="bordered" width='10%'>IVA</td>
					<td width='10%' class="text-right bordered"> 	</td>
					<td width='23%'></td>
				</tr>
				<tr>
					<td width='57%'></td><td class="bordered" width='10%'>Total</td>
					<td width='10%' class="text-right bordered"> <?=number_format($tot_contrat,0,',','.')?>	</td>
					<td width='23%'></td>
				</tr>
			<?php endif; ?>
		</table>
		<br>
		<table width="100%">
			<tr>
                            <td width='40%' class="bordered h7 text-center" valign="top" rowspan="4">V°B° J. Departamento <br> <?php echo $this->getFirma($model->USUARIO_VOBO_JDPTO)?></td>
                            <td class="bordered h7" colspan="3" width='60%'>Autorizado por:</td>
                                
			</tr>
			<tr>
				<td width='20%' class="bordered"> <?php echo $this->getFirma($model->USUARIO_VOBO_ADMIN)?></td><td width='20%' class="bordered"><?php echo $this->getFirma($model->USUARIO_VOBO_GOP)?></td><td width='20%' class="bordered"><?php echo $this->getFirma($model->USUARIO_VOBO_GG)?></td>
			</tr>
			<tr>
				<td width='20%' class="bordered h7 text-center"> V°B° Administrador</td><td width='20%' class="bordered h7 text-center">V°B° G.OP.</td><td width='20%' class="bordered h7 text-center">V°B° G.G</td>
			</tr>
			<tr>
				<td width='20%' class="bordered h7 text-center"> Monto hasta USD 2.500</td><td width='40%' class="bordered h7 text-center" colspan="2">Monto sobre USD 2.500</td>
			</tr>
		</table>
	</div>
	<br>
	<?php 
		if(Yii::app()->user->ADM() || Yii::app()->user->JDP() || Yii::app()->user->GOP() || Yii::app()->user->GG()){
			echo CHtml::link('<div  class="btn btn-success">
		    	<h4> <span class="glyphicon glyphicon-ok"></span> Aprobar Orden de Trabajo</h4>
			</div>', 
			array('OrdenTrabajo/aprobarOtView', 'id'=>$model->ID_OT),
	        array('confirm' => 'Desea Aprobar Ot?'));     
		}
	?>

<style type="text/css">
	.table-bordered th, .table-bordered td, .table-bordered{border:1px solid #0B0B3B !important;} .bordered{border:1px solid #0B0B3B !important;}
  table {border-spacing:0; border-collapse:collapse;}
	.h7{font-size: 10px;} 
</style>
