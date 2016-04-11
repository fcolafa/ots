<?php
/* @var $this UsuarioAprobacionController */
/* @var $model UsuarioAprobacion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-aprobacion-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_USUARIO'); ?>
		<?php echo $form->textField($model,'ID_USUARIO',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'ID_USUARIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_NIVEL_APROB'); ?>
		<?php echo $form->textField($model,'ID_NIVEL_APROB',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'ID_NIVEL_APROB'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->