<?php
/* @var $this NivelAprobacionController */
/* @var $model NivelAprobacion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'nivel-aprobacion-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_TIPO_DOC'); ?>
		<?php echo $form->textField($model,'ID_TIPO_DOC'); ?>
		<?php echo $form->error($model,'ID_TIPO_DOC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE_NIVEL'); ?>
		<?php echo $form->textField($model,'NOMBRE_NIVEL',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'NOMBRE_NIVEL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NIVEL_APROB'); ?>
		<?php echo $form->textField($model,'NIVEL_APROB',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'NIVEL_APROB'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MONTO_APROB'); ?>
		<?php echo $form->textField($model,'MONTO_APROB',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'MONTO_APROB'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->