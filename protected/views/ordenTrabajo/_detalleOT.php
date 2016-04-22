<?php
//error_reporting(E_ALL ^ E_NOTICE);
/* @var $this ItemPresupuestoController */
/* @var $model ItemPresupuesto */
/* @var $form CActiveForm */
?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/item_ppto.js');?>

<div class="form" style="min-width:1000px">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-presupuesto-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary(array( $new_sub_item)); ?>

	<div class="borde-azul">
		<table width="100%">
			<tr>
				<td width="6%"><b>Solicitante</b></td>
				<td width="26%">:
					<?=@$model->personal->NOMBRE_PERSONA ?>
				</td>
				<td width="4%"><b>Contratista</b></td>
				<td width="26%">:
					<?=$model->contratista->NOMBRE_CONTRATISTA ?>
				</td>

				<td width="8%"><b>Fecha OT</b></td>
				<td width="10%">:
					<?=$model->FECHA_OT ?>
				</td>
				<td width="10%"><b>F. Ejecución</b></td>
				<td width="10%">:
					<?=$model->FECHA_EJECUCION ?>
				</td>
			</tr>
			<tr>
				<td width="6%"><b>Descripción</b></td>
				<td colspan="9" width="94%">:
					<?=$model->DESCRIPCION_OT ?>
				</td>
			</tr>
		</table>
	</div>
	<br>

	<div class="row">
		<table id="tabla_items" width='100%' class='table table-condensed table-hover'>
			<thead class='borde-azul'>
				<tr class='primary'> 
					<th colspan='19'>Agregar Detalle</th> 
				</tr>
				<tr class='primary'>
				  	<th width='5%' class='min40 text-center'>Nro.</th>
				  	<th width='25%' class='min300'>Nombre Sub-item</th>
					<th width='15%' class='min120 text-center'>Costo Contrat.</th>
					<th width='10%' class='min80 text-center'>Nro Cotizacion</th>
					<th width='10%' class='min80 text-center'>CC</th>
					<th width='10%' class='min80 text-center'>CCC</th>
					<th width='10%' class='min80 text-center'>SCC</th>
					<th width='10%' class='min80 text-center'>SEC</th>
					<th width='10%' class='min80'>Opciones</th>
			  	</tr>

			  <tr>				  	<!-- style="display:none;" -->
					<td>
						<?php
							if ($new_sub_item->isNewRecord && ($new_sub_item->ID_OT > 0) ):
								$sql = InsumosOT::model()->findBySql("SELECT MAX(CAST( NUMERO_SUB_ITEM AS UNSIGNED )) AS NUMERO_SUB_ITEM FROM insumos_ot WHERE ID_OT = ".$model->ID_OT);
								if ($sql->NUMERO_SUB_ITEM == NULL) $ultimo = 1; else $ultimo = $sql->NUMERO_SUB_ITEM  + 1;
							else:
								$ultimo = @$sql->NUMERO_SUB_ITEM;
							endif;

							echo $form->textField($new_sub_item,'NUMERO_SUB_ITEM', array('class'=>'span12', 'value'=>$ultimo ));
							echo $form->error($new_sub_item,'NUMERO_SUB_ITEM');
						?>
					</td>					
					<td><?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			                        'name'=>'InsumosOT[NOMBRE_SUB_ITEM]',
			                        'model'=>$new_sub_item,
			                        'value'=>$new_sub_item->NOMBRE_SUB_ITEM,
			                        'sourceUrl'=>$this->createUrl("InsumosOT/ListarSubItems"),
			                        'options'=>array(
			                            'minLength'=>'2',
			                            'showAnim'=>'fold',
			                            'select' => 'js:function(event, ui)
			                                { $("#InsumosOT_NOMBRE_SUB_ITEM").val(ui.item.value);
			                                  event.preventDefault();}',
			                            'search'=> 'js:function(event, ui)
			                                { $("#InsumosOT_NOMBRE_SUB_ITEM").val(); }'
			                        ),
			                        'htmlOptions'=>array( 'class'=>'control span12' ),
			            		));

								//echo $form->textField($new_sub_item,'NOMBRE_SUB_ITEM',array('class'=>'span12'));
								echo $form->error($new_sub_item,'NOMBRE_SUB_ITEM');
							?>
					</td>
					<td><?php
							echo $form->textField($new_sub_item,'COSTO_CONTRATISTA',array('class'=>'span12 text-right'));
							echo $form->error($new_sub_item,'COSTO_CONTRATISTA');
							?>
					</td>
					<td><?php
							echo $form->textField($new_sub_item,'NRO_COTIZACION',array('class'=>'span12 text-right'));
							echo $form->error($new_sub_item,'NRO_COTIZACION');
						?>
					</td>
					<td width="10%">
						<?php
                            $criteria=new CDbCriteria();
                            $criteria->condition="ID_EMPRESA=".Yii::app()->getSession()->get('id_empresa');
                            $criteria->order='NUMERO_CENTRO';
							echo $form->dropDownList($new_sub_item,'ID_CENTRO_COSTO',
			                CHtml::listData(CentroDeCostos::model()->findAll($criteria),'ID_CENTRO_COSTO','NUMERO_CENTRO'),
			                        array(
			                            'ajax'=>array(
			                              'type'=>'POST',
			                              'url'=>CController::createUrl('OrdenTrabajo/SelectCuentas'),
			                              'update'=>'#'.CHtml::activeId($new_sub_item,'ID_CCC'),
			                              'beforeSend' => 'function(){
				                               $("#InsumosOT_ID_CCC").find("option").remove();
				                               $("#InsumosOT_ID_SCC").find("option").remove();
				                               $("#InsumosOT_ID_SEC").find("option").remove();
			                               }',
			                            ),
			                            'prompt'=>'Seleccione',
			                        )
			                    );
							$form->error($new_sub_item,'ID_CENTRO_COSTO'); 
						?>
					</td>
					<td><?php
		                $lista_dos = array();
		                echo $form->dropDownList($new_sub_item,'ID_CCC',$lista_dos,
		                        array(
		                            'ajax'=>array(
		                              	'type'=>'POST',
		                              	'url'=>CController::createUrl('OrdenTrabajo/SelectSubCentros'),
		                              	'update'=>'#'.CHtml::activeId($new_sub_item,'ID_SCC'),
		                              	'beforeSend' => 'function(){
		                              		$("#InsumosOT_ID_SCC").find("option").remove();
				                            $("#InsumosOT_ID_SEC").find("option").remove();
		                               	}',      
		                            ),
		                            'prompt'=>'Seleccione')
		                        );
						echo $form->error($new_sub_item,'ID_CCC');
						?>
					</td>
					<td><?php
							/*echo $form->dropDownList($new_sub_item,'ID_SCC', 
                            $this->getCC(), array( 'class'=>'span12')); 
							echo $form->error($new_sub_item,'ID_SCC');*/

							$lista_tres = array();
			                echo $form->dropDownList($new_sub_item,'ID_SCC',$lista_tres,
			                        array(
			                            'ajax'=>array(
			                              	'type'=>'POST',
			                              	'url'=>CController::createUrl('OrdenTrabajo/SelectSecciones'),
			                              	'update'=>'#'.CHtml::activeId($new_sub_item,'ID_SEC'),
			                              	'beforeSend' => 'function(){
					                            $("#InsumosOT_ID_SEC").find("option").remove();
			                               	}',      
			                            ),
			                            'prompt'=>'Seleccione')
			                        );
							echo $form->error($new_sub_item,'ID_SCC');
						?>
					</td>
					<td>
						<?php 
							echo $form->dropDownList($new_sub_item,'ID_SEC', 
                            $this->getCC(), array( 'class'=>'span12')); 
							echo $form->error($new_sub_item,'ID_SEC');
						?>
					</td>
					<td class="min80"> 
						<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-primary', 'name' => 'sub_item_ot')); ?>
					</td>
			  </tr>
			</thead> <!-- fin creacion new subitem-->
			<thead><tr></tr><td class="text-right" colspan="9">.</td></thead>
			<tbody> <!--  subitem creados -->
				<?php // inicializo los acumuladores
				$tot_contrat = 0; 

				foreach ($sub_items as $sub): 	?>
						<tr>
							<td> <?=$sub->NUMERO_SUB_ITEM?> </td>
							<td> <?=$sub->NOMBRE_SUB_ITEM?> </td>
							<td class="text-right"> <?=number_format($sub->COSTO_CONTRATISTA,0,',','.')?> </td>
							<td class="text-right"> <?=$sub->NRO_COTIZACION?> </td>
							<td class="text-right"> <?=@$sub->centroCosto->NUMERO_CENTRO/*' ('.$sub->centroCosto->NOMBRE_CENTRO_COSTO.')'*/?> </td>
							<td class="text-right"> <?=@$sub->iDCCC->NUMERO_CUENTA/**' ('.$sub->iDSUBCENTROCOSTO->SUB_CC_DESCRIPCION.')'*/?> </td>
							<td class="text-right"> <?=@$sub->iDSCC->SCC_NUMERO/**' ('.$sub->iDSUBCENTROCOSTO->SUB_CC_DESCRIPCION.')'*/?> </td>
							<td class="text-right"> <?=@$sub->iDSEC->SEC_NUMERO /***' ('.$sub->iDCCSECCION->SECCION_CC_DESCRIPCION.')'*/?> </td>
							<td class="text-center">
								<?php 
								if ($model->VOBO_JEFE_DPTO != 1):
									echo CHtml::link('<img src='.'"'. Yii::app()->theme->baseUrl.'/img/small_icons/table_edit.png" title="Modificar" alt="Modificar"  width="20" />', array('InsumosOT/update', 'id'=> $sub->ID_INSUMOS_OT));

								 	echo " ".CHtml::link('<img src='.'"'. Yii::app()->theme->baseUrl.'/img/small_icons/delete.png" title="Eliminar" alt="Eliminar"  width="20" />', $this->createUrl('InsumosOT/delete', array('id' => $sub->ID_INSUMOS_OT)), 
									    array(								       
									       'onclick' => '{' . 
									       		CHtml::ajax(array(
											        'beforeSend' => 'js:function(){if(confirm("Seguro de eliminar este subitem ?"))return true;else return false;}',
											        'type'=> 'POST',
											        'url'=> $this->createUrl('InsumosOT/delete', array('id' => $sub->ID_INSUMOS_OT,'ajax'=>'delete')),
									       			'success' => "js:function(data){window.location='".Yii::app()->request->baseUrl."?r=OrdenTrabajo/update&id=".$sub->ID_OT."';}")) .
									       'return false;}', // returning false prevents the default navigation to another url on a new page 									       
									       'class' => 'delete-icon', 'id' => 'x' . $sub->ID_INSUMOS_OT)
									   );
								endif;
								?>
							</td>

							<?php $tot_contrat += $sub->COSTO_CONTRATISTA; ?>
						</tr>
				<?php endforeach; ?>

					<tr class="success">
						<td></td>
						<td colspan="1" class="text-right"><b>Neto</b></td>
						<td class="text-right">
							<b><?php echo @$model->tipo_moneda->SIGNO_MONEDA?></b>
							<?php if (@$model->tipo_moneda->ID_TIPO_MONEDA == 1) { ?>
								<b><?=number_format($tot_contrat,0,',','.')?></b>
							<?php } else { ?>
								<b><?=number_format($tot_contrat,2,',','.')?></b>
							<?php } ?>
						</td>
						<td></td>
					</tr>
					<?php if ($model->APLICA_IVA == 1) { ?>
						<tr class="success">
							<td></td>
							<td colspan="1" class="text-right"><b>IVA</b></td>
							<td class="text-right">
								<b><?php echo @$model->tipo_moneda->SIGNO_MONEDA?></b>
								<?php if (@$model->tipo_moneda->ID_TIPO_MONEDA == 1) { ?>
									<b><?=number_format(($tot_contrat*0.19),0,',','.')?></b>
								<?php } else { ?>
									<b><?=number_format(($tot_contrat*0.19),2,',','.')?></b>
								<?php } ?>
							</td>
							<td></td>
						</tr>
						<tr class="success">
							<td></td>
							<td colspan="1" class="text-right"><b>Total</b></td>
							<td class="text-right">
								<b><?php echo @$model->tipo_moneda->SIGNO_MONEDA?></b>
								<?php if (@$model->tipo_moneda->ID_TIPO_MONEDA == 1) { ?>
									<b><?=number_format(($tot_contrat*1.19),0,',','.')?></b>
								<?php } else { ?>
									<b><?=number_format(($tot_contrat*1.19),2,',','.')?></b>
								<?php } ?>
							</td>
							<td></td>
						</tr
					<?php } ?>
			</tbody>
	  </table>
	</div>

	<?php $this->endWidget();?>

</div><!-- form -->
