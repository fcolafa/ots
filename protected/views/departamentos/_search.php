<?php
/* @var $this DepartamentosController */
/* @var $model Departamentos */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_DEPARTAMENTO'); ?>
		<?php echo $form->textField($model,'ID_DEPARTAMENTO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_DEPARTAMENTO'); ?>
		<?php echo $form->textField($model,'NOMBRE_DEPARTAMENTO',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DESCRIPCION_DEPARTAMENTO'); ?>
		<?php echo $form->textArea($model,'DESCRIPCION_DEPARTAMENTO',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->