<?php
/* @var $this PiezasEquiposController */
/* @var $model PiezasEquipos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'piezas-equipos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_PIEZA'); ?>
		<?php echo $form->textField($model,'ID_PIEZA'); ?>
		<?php echo $form->error($model,'ID_PIEZA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_EQUIPO'); ?>
		<?php echo $form->textField($model,'ID_EQUIPO'); ?>
		<?php echo $form->error($model,'ID_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE_PIEZA'); ?>
		<?php echo $form->textField($model,'NOMBRE_PIEZA',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'NOMBRE_PIEZA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IMAGEN_PIEZA'); ?>
		<?php echo $form->textField($model,'IMAGEN_PIEZA',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'IMAGEN_PIEZA'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->