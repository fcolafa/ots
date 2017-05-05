<?php
/* @var $this ModelEquipoController */
/* @var $model ModelEquipo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'model-equipo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_MARCA_EQUIPO'); ?>
		<?php echo $form->textField($model,'ID_MARCA_EQUIPO'); ?>
		<?php echo $form->error($model,'ID_MARCA_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE_MODELO_EQUIPO'); ?>
		<?php echo $form->textField($model,'NOMBRE_MODELO_EQUIPO',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'NOMBRE_MODELO_EQUIPO'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->