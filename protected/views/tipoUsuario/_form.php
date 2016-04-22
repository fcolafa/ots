<?php
/* @var $this TipoUsuarioController */
/* @var $model TipoUsuario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tipo-usuario-form',
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
			<?php echo $form->labelEx($model,'COD_TIPO_USUARIO'); ?>
			<?php echo $form->textField($model,'COD_TIPO_USUARIO',array('size'=>5,'maxlength'=>5)); ?>
			<?php echo $form->error($model,'COD_TIPO_USUARIO'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'NOMBRE_TIPO_USUARIO'); ?>
			<?php echo $form->textField($model,'NOMBRE_TIPO_USUARIO',array('size'=>50,'maxlength'=>50, 'class'=>'span12')); ?>
			<?php echo $form->error($model,'NOMBRE_TIPO_USUARIO'); ?>
		</div>
	</div>
	<div class="row">
		<div class="span7">
			<?php echo $form->labelEx($model,'DESCRIPCION_TIPO_USUARIO'); ?>
			<?php echo $form->textArea($model,'DESCRIPCION_TIPO_USUARIO',array('rows'=>2, 'class'=>'span12')); ?>
			<?php echo $form->error($model,'DESCRIPCION_TIPO_USUARIO'); ?>
		</div>
	</div>
	<br>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar' ,array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->