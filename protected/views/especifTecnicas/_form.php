<?php
/* @var $this EspecifTecnicasController */
/* @var $model EspecifTecnicas */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'especif-tecnicas-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_ESPEC_TECNICA'); ?>
		<?php echo $form->textField($model,'ID_ESPEC_TECNICA'); ?>
		<?php echo $form->error($model,'ID_ESPEC_TECNICA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_EQUIPO'); ?>
		<?php echo $form->textField($model,'ID_EQUIPO'); ?>
		<?php echo $form->error($model,'ID_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_PIEZA'); ?>
		<?php echo $form->textField($model,'ID_PIEZA'); ?>
		<?php echo $form->error($model,'ID_PIEZA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CARACTERISTICA'); ?>
		<?php echo $form->textField($model,'CARACTERISTICA',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'CARACTERISTICA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DESCRIPCION'); ?>
		<?php echo $form->textField($model,'DESCRIPCION',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'DESCRIPCION'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->