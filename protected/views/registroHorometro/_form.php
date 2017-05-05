<?php
/* @var $this RegistroHorometroController */
/* @var $model RegistroHorometro */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registro-horometro-form',
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
		<?php echo $form->labelEx($model,'HOROMETRO'); ?>
		<?php echo $form->textField($model,'HOROMETRO'); ?>
		<?php echo $form->error($model,'HOROMETRO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_USUARIO'); ?>
		<?php echo $form->textField($model,'ID_USUARIO',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'ID_USUARIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'OBSERVACION'); ?>
		<?php echo $form->textArea($model,'OBSERVACION',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'OBSERVACION'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->