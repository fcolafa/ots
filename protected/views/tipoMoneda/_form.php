<?php
/* @var $this TipoMonedaController */
/* @var $model TipoMoneda */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tipo-moneda-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_TIPO_MONEDA'); ?>
		<?php echo $form->textField($model,'ID_TIPO_MONEDA'); ?>
		<?php echo $form->error($model,'ID_TIPO_MONEDA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TIPO_MONEDA'); ?>
		<?php echo $form->textField($model,'TIPO_MONEDA',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'TIPO_MONEDA'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->