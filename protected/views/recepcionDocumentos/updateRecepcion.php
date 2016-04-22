<?php
/* @var $this RecepciondocumentosController */
/* @var $model Recepciondocumentos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'recepciondocumentos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'FECHA_RECEPCION'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
								'name'=>'FECHA_RECEPCION',
								'language'=>'es',
								'model'=>$model,
								'attribute'=>'FECHA_RECEPCION',
								'flat'=>false,
								//'value' => '2015/07/14',
	   				 // additional javascript options for the date picker plugin
								'options'=>array(
									'showAnim'=>'fold',
									'constrainInput'=>true,
									//'buttonImage'=>Yii::app()->baseUrl.'/images/Iconos/calendario.png', 'buttonImageOnly'=>true, 'showButtonPanel'=>true, 'showOn'=>'both',
	       				// 'showOn'=>'both',
									'currentText'=>'2015/07/14',
									'dateFormat'=>'yy-mm-dd',
									),
								'htmlOptions'=>array("class"=>"form-control"),
								));
			?>
		<!--<?php //echo $form->textField($model,'FECHA_RECEPCION'); ?>-->
		<?php echo $form->error($model,'FECHA_RECEPCION'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_CONTRATISTA'); ?>
		<?php echo $form->dropDownList($model,'ID_CONTRATISTA',Contratista::model()->getContratistasAutorizados(), array('empty'=>'Seleccione Contratista')); ?>
		<?php echo $form->error($model,'ID_CONTRATISTA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_DOCUMENTO'); ?>
		<?php echo $form->dropDownList($model,'ID_DOCUMENTO',TipoDocumento::model()->getDocumentos(), array('empty'=>'Seleccione Documento')); ?>
		<?php echo $form->error($model,'ID_DOCUMENTO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ESTADO'); ?>
		<?php echo $form->dropDownList($model,'ESTADO',array("empty"=>"Seleccione",1=>"Entregado",0=>"Pendiente"));	 ?>
		<?php echo $form->error($model,'ESTADO'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>