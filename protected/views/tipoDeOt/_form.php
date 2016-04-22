<?php
/* @var $this TipoDeOtController */
/* @var $model TipoDeOt */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tipo-de-ot-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'NOMBRE_TIPO_OT'); ?>
			<?php echo $form->textField($model,'NOMBRE_TIPO_OT',array('size'=>60,'maxlength'=>250,'class'=>'span12')); ?>
			<?php echo $form->error($model,'NOMBRE_TIPO_OT'); ?>
		</div>
	</div>
	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'DESCRIPCION_TIPO_OP'); ?>
			<?php echo $form->textArea($model,'DESCRIPCION_TIPO_OP',array('rows'=>2, 'class'=>'span12')); ?>
			<?php echo $form->error($model,'DESCRIPCION_TIPO_OP'); ?>
			</div>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar' ,array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->