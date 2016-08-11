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
	array('label'=>'Crear Orden de Trabajo', 'url'=>array('create'),'visible'=> !Yii::app()->user->GG()),
	array('label'=>'Actualizar Orden de Trabajo', 'url'=>array('update', 'id'=>$model->ID_OT),'visible'=> $model->VOBO_GERENTE_GRAL!=1),
	//array('label'=>'Borrar Orden de Trabajo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_OT),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar Orden de Trabajo', 'url'=>array('admin')),
);
$clname='borde-azul';
if($model->RECHAZAR_OT==1)
   $clname='borde-rojo';
else
if($model->VOBO_GERENTE_GRAL==1)
   $clname='borde-verde';
?>


	<div class="<?php echo $clname ?>" id="ot-aprobada">
		<br>
		<table width="100%">
			<thead>
				<tr>
					<td width="20%">
						<b><?=$model->empresa->NOMBRE_EMPRESA ?></b>
					</td>
					<td rowspan="4">
						<center>
							<h3 class="text-center"> 
							ORDEN DE TRABAJO N° : <?php echo $model->ID_OT;?>	
							</h3>
						</center>
					</td>
				</tr>
				<tr>
					<td width="20%"> <b>RUT : 
						<?=$model->empresa->RUT_EMPRESA ?></b>
					</td>
				</tr>
				<tr>
					<td width="20%">
						<b><?=$model->empresa->CASA_MATRIZ ?></b>
					</td>
				</tr>
				<tr>
					<td width="20%">
						<b><?=$model->empresa->CIUDAD ?></b>
					</td>
				</tr>
			</thead>
		</table>
		<hr style="border-top: 1px solid #9A9696; margin-bottom: 0px">
		<table width="100%">
			<thead>
				<tr><td colspan="3"><br></td></tr>
			</thead>
			<tbody class="borde-abajo">
				<tr>
					<td width="40%"><b>Señor (es) : </b>
						<?=$model->contratista->NOMBRE_CONTRATISTA ?>
					</td>
					<td width="30%"><b>Fecha OT : </b>
						<?=$model->FECHA_OT ?>
					</td>
					<td width="30%"></td>
				</tr>
				<tr>
					<td><b>Dirección : </b>
						<?=$model->contratista->DIRECCION_CONTRATISTA ?>
					</td>
					<td><b>Ciudad :</b>
						<?=$model->contratista->CIUDAD_CONTRATISTA ?>
					</td>
					<td><b>Telefono :</b>
						<?=$model->contratista->TELEFONO_CONTRATISTA ?>
					</td>
				</tr>

			</tbody>
			<tbody class="borde-abajo	">
				<tr>
					<td colspan="2"><b>Solicitante :</b>
					</td>
					<td><b>Tipo de OT :</b>
						<?=$model->tipo_de_ot->NOMBRE_TIPO_OT ?>
					</td>
				</tr>
				<tr>
					<td colspan="2"><b>Supervisor :</b>
						<?=@$model->personal->NOMBRE_PERSONA ?>
					</td>
					<td>
						
					</td>
				</tr>
				<tr>
					<td colspan="2"><b>Departamento :</b>
						<?=$model->departamentos->NOMBRE_DEPARTAMENTO ?>
					</td>
					<td> <b>Fecha Ejecución :</b>
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
					<th colspan="9">
						<center>DISTRIBUCION DE COSTOS</center>
					</th>
				</tr>
				<tr>
					<th width="5%" class="bordered"> N°</th>
					<th width="50%" class="bordered"> Descripción</th>
					<th width="10%" class="text-right bordered"> Valor Total</th>
					<th width="7%" class="text-right bordered"> Cotizacion</th>
					<th width="5%" class="bordered"> C. C.</th>
					<th width="9%" class="bordered"> C. C. C.</th>
					<th width="7%" class="bordered"> S. C. C.</th>
					<th width="7%" class="bordered"> Sección</th>
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
							<td class="text-right bordered"> <?=$sub->NRO_COTIZACION ?> </td>
							<td class="text-right bordered"> <?=$sub->centroCosto->NUMERO_CENTRO ?> </td>
							<td class="text-right bordered"> <?=$sub->iDCCC->NUMERO_CUENTA ?> </td>
							<td class="text-right bordered"> <?=$sub->iDSCC->SCC_NUMERO ?> </td>
							<td class="text-right bordered"> <?=$sub->iDSEC->SEC_NUMERO ?> </td>
						</tr>
					<?php $tot_contrat += $sub->COSTO_CONTRATISTA; 
				endforeach; ?>
			</tbody>
		</table>
		<br>
		<table width="100%">
			<tr>
				<td width='70%'></td><td class="bordered" width='15%'><b>Neto</b></td>
				<td width='15%' class="text-right bordered"> <?=number_format($tot_contrat,0,',','.')?>	</td>
				<!--<td width='23%'></td>-->
			</tr>
			<?php if ($model->APLICA_IVA) : ?>
				<tr>
					<td width='70%'></td><td class="bordered" width='15%'><b>IVA</b></td>
					<td width='15%' class="text-right bordered"> <?=number_format(($tot_contrat*19/100),0,',','.')?></td>
					<!--<td width='23%'></td>-->
				</tr>
				<tr>
					<td width='70%'></td><td class="bordered" width='15%'><b>Total</b></td>
					<td width='15%' class="text-right bordered"> <?=number_format(($tot_contrat+($tot_contrat*19/100)),0,',','.')?>	</td>
					<!--<td width='23%'></td>-->
				</tr>
			<?php else : ?>
				<tr>
					<td width='70%'></td><td class="bordered" width='15%'>IVA</td>
					<td width='15%' class="text-right bordered"> 	</td>
					<!--<td width='23%'></td>-->
				</tr>
				<tr>
					<td width='70%'></td><td class="bordered" width='15%'>Total</td>
					<td width='15%' class="text-right bordered"> <?=number_format($tot_contrat,0,',','.')?>	</td>
					<!--<td width='23%'></td>-->
				</tr>
			<?php endif; ?>
		</table>
		<br>
		<table width="100%">
			<tr>
                <td width='40%' class="bordered h7 text-center" valign="top" rowspan="4">V°B° Jefe Depto. <br> <?php echo $this->getFirma($model->USUARIO_VOBO_JDPTO)?></td>
                <td class="bordered h7" colspan="3" width='60%'>Autorizado por:</td>
                                
			</tr>
			<tr>
				<td width='20%' class="bordered"> <?php echo $this->getFirma($model->USUARIO_VOBO_ADMIN)?></td><td width='20%' class="bordered"><?php echo $this->getFirma($model->USUARIO_VOBO_GOP)?></td><td width='20%' class="bordered"><?php echo $this->getFirma($model->USUARIO_VOBO_GG)?></td>
			</tr>
			<tr>
				<td width='20%' class="bordered h7 text-center"> V°B° Jefe Administrativo</td><td width='20%' class="bordered h7 text-center">V°B° Gerente Planta</td><td width='20%' class="bordered h7 text-center">V°B° Gerente Zonal</td>
			</tr>
			<tr>
				<td width='20%' class="bordered h7 text-center"> Monto hasta USD 2.500</td><td width='40%' class="bordered h7 text-center" colspan="2">Monto sobre USD 2.500</td>
			</tr>
		</table>
                <?php  if($model->RECHAZAR_OT==1 ){ ?>
                <h3>Observaciones:</h3>
                 <?php 
                $persona=  Personal::model()->findByPk($model->USUARIO_RECHAZA);
                $nombre=$persona->NOMBRE_PERSONA.' '.$persona->APELLIDO_PERSONA;
                ?>
                <p>Orden rechazada por:<b><?php echo $nombre?></b><br> motivo:<?php echo $model->MOTIVO_RECHAZO?></p>
                <?php } ?>
	</div>
	<?php
	if ($model->APROBADO_I25) :
//	    Yii::import('ext.mPrint.mPrint');
//	    $this->widget('ext.mPrint.mPrint', array(
//	        'title' => 'Elemento PDF.',
//	        'tooltip' => 'HTML PDF',
//	        'text' => 'Imprimir',
//	        'element' => '#ot-aprobada',
//	        /*'exceptions' => array(     
//	            '.summary',
//	        ),
//	        'publishCss' => true,*/
//	        'id' => 'PRINT_BUTTON_ID',
//	    ));
	endif;
	?>
    
	<?php 
		if(Yii::app()->user->ADM() || Yii::app()->user->JDP() || Yii::app()->user->GOP() || Yii::app()->user->GG()){
                    
                    if($model->RECHAZAR_OT==0 && $model->VOBO_GERENTE_GRAL!=1){
			echo CHtml::link('<div  class="btn btn-success">
		    	<h4> <span class="glyphicon glyphicon-ok"></span> Aprobar Orden de Trabajo</h4>
			</div>', 
			array('OrdenTrabajo/aprobarOtView', 'id'=>$model->ID_OT),
                        array('confirm' => 'Desea Aprobar Ot?'));     
		
                	
                	echo CHtml::link('<div  class="btn btn-danger">
		    	<h4> <span class="glyphicon glyphicon-ok"></span> Rechazar Orden de Trabajo</h4>
			</div>', 
			array('OrdenTrabajo/rechazarOtView', 'id'=>$model->ID_OT),
                        array('confirm' => 'Esta seguro que desea rechazar la Orden de trabajo?'));     
                    }elseif($model->RECHAZAR_OT==1){
                        echo CHtml::link('<div  class="btn btn-success">
		    	<h4> <span class="glyphicon glyphicon-ok"></span> Reaprobar Orden de Trabajo</h4>
			</div>', 
			array('OrdenTrabajo/reaprobarOtView', 'id'=>$model->ID_OT),
                        array('confirm' => 'Confirma que se hicieron las modificaciones pertinentes para reaprobar la Orden de trabajo?'));  
                    }
             
                echo '<h4>Cotizaciones:</h4>';
                echo $model->getCotFile();
                }
	?>
    <br>
       <?php
        echo '<h4>Consultas:</h4>';
        echo $this->getOTMessages($model->ID_OT);
        echo CHtml::link('<div  class="btn btn-warning">
		    	<h4> <span class="glyphicon glyphicon-ok"></span> Consulta</h4>
			</div>', 
			array('consulta/create', 'id'=>$model->ID_OT));     
        ?>
    

<style type="text/css">
	.table-bordered th, .table-bordered td, .table-bordered{border:1px solid #0B0B3B !important;} .bordered{border:1px solid #0B0B3B !important;}
  table {border-spacing:0; border-collapse:collapse;}
	.h7{font-size: 10px;} 
</style>
