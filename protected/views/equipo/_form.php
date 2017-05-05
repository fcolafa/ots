<?php
/* @var $this EquipoController */
/* @var $model Equipo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'equipo-form',
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
		<?php echo $form->labelEx($model,'TAG_EQUIPO'); ?>
		<?php echo $form->textField($model,'TAG_EQUIPO',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'TAG_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_TIPO_EQUIPO'); ?>
		<?php echo $form->textField($model,'ID_TIPO_EQUIPO'); ?>
		<?php echo $form->error($model,'ID_TIPO_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE_EQUIPO'); ?>
		<?php echo $form->textField($model,'NOMBRE_EQUIPO',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'NOMBRE_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_MODELO_EQUIPO'); ?>
		<?php echo $form->textField($model,'ID_MODELO_EQUIPO'); ?>
		<?php echo $form->error($model,'ID_MODELO_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TIEMPO_MANTENCION'); ?>
		<?php echo $form->textField($model,'TIEMPO_MANTENCION'); ?>
		<?php echo $form->error($model,'TIEMPO_MANTENCION'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'YEAR_EQUIPO'); ?>
		<?php echo $form->textField($model,'YEAR_EQUIPO'); ?>
		<?php echo $form->error($model,'YEAR_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NUMERO_EQUIPO'); ?>
		<?php echo $form->textField($model,'NUMERO_EQUIPO',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'NUMERO_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UBICACION_EQUIPO'); ?>
		<?php echo $form->textField($model,'UBICACION_EQUIPO',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'UBICACION_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CAPACIDAD'); ?>
		<?php echo $form->textField($model,'CAPACIDAD',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'CAPACIDAD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FECHA_ADQUISICION'); ?>
		<?php echo $form->textField($model,'FECHA_ADQUISICION'); ?>
		<?php echo $form->error($model,'FECHA_ADQUISICION'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FECHA_EMPRESA'); ?>
		<?php echo $form->textField($model,'FECHA_EMPRESA'); ?>
		<?php echo $form->error($model,'FECHA_EMPRESA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IMAGEN_EQUIPO'); ?>
		<?php echo $form->textField($model,'IMAGEN_EQUIPO',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'IMAGEN_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ESTADO_EQUIPO'); ?>
		<?php echo $form->textField($model,'ESTADO_EQUIPO',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'ESTADO_EQUIPO'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->