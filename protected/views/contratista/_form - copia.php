<?php
/* @var $this ContratistaController */
/* @var $model Contratista */
/* @var $form CActiveForm */
?>

<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/Masks.js');?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/Validate.js');?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contratista-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>
	<table>
		<tr>
			<td>
				<div class="row">
					<? if ($model->NOMBRE_CONTRATISTA!='')//campo del modelo
						                        $value=$model->NOMBRE_CONTRATISTA;
						                    else
						                        $value='';

						               // echo $form->textField($model, 'NOMBRE_CONTRATISTA',array());
						                echo $form->labelEx($model,'NOMBRE_CONTRATISTA');
						                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
						                         'attribute'=>'NOMBRE_CONTRATISTA',
						                            'model'=>$model,
						                            'value'=>$value,
						                            'sourceUrl'=>$this->createUrl('ListarContratistas'),//metodo del controlador
						                            'options'=>array(
						                                'minLength'=>'4',
						                                'showAnim'=>'fold',
						                                'select' => 'js:function(event, ui)
						                                    { jQuery("#Contratista_NOMBRE_CONTRATISTA").val(ui.item.id);
						                                    jQuery("#Contratista_NOMBRE_CONTRATISTA").val(ui.item.value);
						                                    	event.preventDefault();}',
						                                'search'=> 'js:function(event, ui)
						                                    { jQuery("#Contratista_ID_CONTRATISTA").val(0); }'               
						                            ),

						                ));
					?>
				</div>
			</td>
			<td>
				<div class="row">

				</div>
			</td>
			<td>
				<div class="row span12">
					<?php $mUsuario= Usuario::model()->findbyAttributes(array('NOMBRE_USUARIO'=>Yii::app()->user->id));
					$rol=$mUsuario->COD_TIPO_USUARIO;
					if($rol=='A1'||$rol=='GE' ||$rol=='SA' ||$rol=='SG' ){
						echo $form->labelEx($model,'AUTORIZADO');
						echo $form->checkBox($model,'AUTORIZADO');
					}else{
						echo $form->hiddenField($model,'AUTORIZADO');
					}
					?>
					
					<?php echo $form->error($model,'AUTORIZADO'); ?>
				</div>
			</td>
		</tr>

		<tr>
			<td>
				<div class="row">
					<?php echo $form->labelEx($model,'RUT_CONTRATISTA'); ?>
					<?php echo $form->textField($model,'RUT_CONTRATISTA',array('size'=>13,'maxlength'=>13,'style' => 'text-align:Center;','placeholder'=>'Ejemplo: 12345678-9', 'onkeyup' =>"this.value = MaskRut(this.value,true)", 'is_numeric'=>"true")) ; ?>
					<?php echo $form->error($model,'RUT_CONTRATISTA'); ?>
				</div>
			</td>
		</tr>

		<tr>
			<td>
				<div class="row">
					<?php echo $form->labelEx($model,'DIRECCION_CONTRATISTA'); ?>
					<?php echo $form->textArea($model,'DIRECCION_CONTRATISTA',array('rows'=>6, 'cols'=>50)); ?>
					<?php echo $form->error($model,'DIRECCION_CONTRATISTA'); ?>
				</div>
			</td>
		</tr>

		<tr>
			<td>
				<div class="row">
					<?php echo $form->labelEx($model,'CIUDAD_CONTRATISTA'); ?>
					<?php echo $form->textField($model,'CIUDAD_CONTRATISTA',array('size'=>60,'maxlength'=>150)); ?>
					<?php echo $form->error($model,'CIUDAD_CONTRATISTA'); ?>
				</div>
			</td>
		</tr>

		<tr>
			<td>
				<div class="row">
					<?php echo $form->labelEx($model,'TELEFONO_CONTRATISTA'); ?>
					<?php echo $form->textField($model,'TELEFONO_CONTRATISTA',array('size'=>60,'maxlength'=>250)); ?>
					<?php echo $form->error($model,'TELEFONO_CONTRATISTA'); ?>
				</div>
			</td>
		</tr>

		<tr>
			<td>
				<div class="row">
					<?php echo $form->labelEx($model,'GIRO_AREA'); ?>
					<?php echo $form->textField($model,'GIRO_AREA',array('size'=>60,'maxlength'=>250)); ?>
					<?php echo $form->error($model,'GIRO_AREA'); ?>
				</div>
			</td>
		</tr>
	
	</table>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->