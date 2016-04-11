<?php
/* @var $this DocumentosContratistaController */
/* @var $model DocumentosContratista */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'DocumentosContratista-form',
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
		<?php echo $form->labelEx($model,'NOMBRE_DOCUMENTO'); ?>
		<?php echo $form->textField($model,'NOMBRE_DOCUMENTO',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'NOMBRE_DOCUMENTO'); ?>
		</div>
		
		<div class="span5">
		<?php echo $form->labelEx($model,'DESCRIPCION'); ?>
		<?php echo $form->textArea($model,'DESCRIPCION',array('rows'=>2, 'class'=>'span12')); ?>
		<?php echo $form->error($model,'DESCRIPCION'); ?>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar' ,array('class'=>'btn btn-primary offset1')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->