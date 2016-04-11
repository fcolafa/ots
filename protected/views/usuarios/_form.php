<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuarios-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE_USUARIO'); ?>
		<?php echo $form->textField($model,'NOMBRE_USUARIO',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'NOMBRE_USUARIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CONTRASENA'); ?>
		<?php echo $form->textField($model,'CONTRASENA',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'CONTRASENA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_TIPO_USUARIO'); ?>
		<?php echo $form->textField($model,'COD_TIPO_USUARIO',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'COD_TIPO_USUARIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_PERSONA'); ?>
		<?php echo $form->textField($model,'ID_PERSONA'); ?>
		<?php echo $form->error($model,'ID_PERSONA'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->