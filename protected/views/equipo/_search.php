<?php
/* @var $this EquipoController */
/* @var $model Equipo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'NUMERO_EQUIPO'); ?>
		<?php echo $form->textField($model,'NUMERO_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_EQUIPO'); ?>
		<?php echo $form->textField($model,'NOMBRE_EQUIPO',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MODELO_EQUIPO'); ?>
		<?php echo $form->textField($model,'MODELO_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TIEMPO_MANTENCION'); ?>
		<?php echo $form->textField($model,'TIEMPO_MANTENCION',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IMAGEN_EQUIPO'); ?>
		<?php echo $form->textField($model,'IMAGEN_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CAPACIDAD'); ?>
		<?php echo $form->textField($model,'CAPACIDAD'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UBICACION_EQUIPO'); ?>
		<?php echo $form->textField($model,'UBICACION_EQUIPO'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->