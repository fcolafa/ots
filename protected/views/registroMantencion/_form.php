<?php
/* @var $this RegistroMantencionController */
/* @var $model RegistroMantencion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registro-mantencion-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_EQUIPO'); ?>
		<?php echo $form->textField($model,'ID_EQUIPO'); ?>
		<?php echo $form->error($model,'ID_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FECHA_REGISTRO'); ?>
		<?php echo $form->textField($model,'FECHA_REGISTRO'); ?>
		<?php echo $form->error($model,'FECHA_REGISTRO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'REGISTRO_MARCADO'); ?>
		<?php echo $form->textField($model,'REGISTRO_MARCADO'); ?>
		<?php echo $form->error($model,'REGISTRO_MARCADO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COMENTARIO_REGISTRO'); ?>
		<?php echo $form->textArea($model,'COMENTARIO_REGISTRO',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'COMENTARIO_REGISTRO'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->