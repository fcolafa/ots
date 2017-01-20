<?php
/* @var $this ContratistaController */
/* @var $model Contratista */
/* @var $form CActiveForm */
?>

<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/Masks.js');?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/Validates.js');?>

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

			<div class="row">
				<div class="span3">
					<?php echo $form->labelEx($model,'RUT_CONTRATISTA', array('class'=>'valida_rut')); ?>
					<?php echo $form->textField($model,'RUT_CONTRATISTA',array('class'=>'span12 text-right','maxlength'=>13,'placeholder'=>'Ejemplo: 12345678-9', 'onkeyup' =>"this.value = MaskRut(this.value,true); ValidateRut(this.value);", 'is_numeric'=>"true")) ; ?>
					<?php echo $form->error($model,'RUT_CONTRATISTA'); ?>
				</div>
				
				<div class="span5">
					<?php echo $form->labelEx($model,'NOMBRE_CONTRATISTA'); ?>
					<?php echo $form->textField($model,'NOMBRE_CONTRATISTA',array('class'=>'span12', 'maxlength'=>150)); ?>
					<?php echo $form->error($model,'NOMBRE_CONTRATISTA'); ?>
				</div>
				
				<div class="span2">
					<?php //$mUsuario= Usuario::model()->findbyAttributes(array('NOMBRE_USUARIO'=>Yii::app()->user->id));
					//$rol=$mUsuario->COD_TIPO_USUARIO;
						if ( Yii::app()->user->A1() ){
							echo $form->labelEx($model,'AUTORIZADO');
							echo $form->checkBox($model,'AUTORIZADO');
						}
					?>
					
					<?php echo $form->error($model,'AUTORIZADO'); ?>
				</div>
			</div>

			<div class="row">
                            <?php if (Yii::app()->user->allCompany()) { ?>
				<div class="span3">
					<?php echo $form->labelEx($model,'ID_EMPRESA'); ?>
					<?php echo $form->dropDownList($model,'ID_EMPRESA', array(''=>'-Seleccione Empresa-')+CHtml::listData(Empresa::model()->findAll(), 'ID_EMPRESA', 'NOMBRE_EMPRESA'),array('id'=>'cb_empresas', 'class'=>'span12', 'maxlength'=>80)); ?>
					<?php echo $form->error($model,'ID_EMPRESA'); ?>
				</div> 
                            <?php }?>
				<div class="span4">
					<?php echo $form->labelEx($model,'ENCARGADO'); ?>
					<?php echo $form->textField($model,'ENCARGADO',array('class'=>'span12', 'maxlength'=>150)); ?>
					<?php echo $form->error($model,'ENCARGADO'); ?>
				</div>
				<div class="span5">
					<?php echo $form->labelEx($model,'DIRECCION_CONTRATISTA'); ?>
					<?php echo $form->textField($model,'DIRECCION_CONTRATISTA',array('class'=>'span12', 'maxlength'=>50)); ?>
					<?php echo $form->error($model,'DIRECCION_CONTRATISTA'); ?>
				</div>
			</div>

			<div class="row">
				<div class="span3">
					<?php echo $form->labelEx($model,'CIUDAD_CONTRATISTA'); ?>
					<?php echo $form->textField($model,'CIUDAD_CONTRATISTA',array('class'=>'span12','maxlength'=>150)); ?>
					<?php echo $form->error($model,'CIUDAD_CONTRATISTA'); ?>
				</div>
				<div class="span3">
					<?php echo $form->labelEx($model,'TELEFONO_CONTRATISTA'); ?>
					<?php echo $form->textField($model,'TELEFONO_CONTRATISTA',array('class'=>'span12','maxlength'=>50)); ?>
					<?php echo $form->error($model,'TELEFONO_CONTRATISTA'); ?>
				</div>

				<div class="span4">
					<?php if ($model->GIRO_AREA!='')//campo del modelo
						                        $value=$model->GIRO_AREA;
						                    else
						                        $value='';

						               // echo $form->textField($model, 'GIRO_AREA',array());
						                echo $form->labelEx($model,'GIRO_AREA');
						                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
						                         'attribute'=>'GIRO_AREA',
						                            'model'=>$model,
						                            'value'=>$value,
						                            'sourceUrl'=>$this->createUrl('ListarContratistas'),//metodo del controlador
						                            'options'=>array(
						                                'minLength'=>'2',
						                                'showAnim'=>'fold',
						                                'select' => 'js:function(event, ui)
						                                    { jQuery("#Contratista_GIRO_AREA").val(ui.item.id);
						                                    jQuery("#Contratista_GIRO_AREA").val(ui.item.value);
						                                    	event.preventDefault();}',
						                                'search'=> 'js:function(event, ui)
						                                    { jQuery("#Contratista_ID_CONTRATISTA").val(0); }'               
						                            ),
							                        'htmlOptions'=>array('class'=>'span12')
						                ));
					?>
				</div>
			</div>
	
	</table>
	<br>
	<div class="row">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->