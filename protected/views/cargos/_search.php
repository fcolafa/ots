<?php
/* @var $this CargosController */
/* @var $model Cargos */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_CARGO'); ?>
		<?php echo $form->textField($model,'ID_CARGO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_EMPRESA'); ?>
		<?php echo $form->textField($model,'ID_EMPRESA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DEPENDENCIA_CARGO'); ?>
		<?php echo $form->textField($model,'DEPENDENCIA_CARGO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_CARGO'); ?>
		<?php echo $form->textField($model,'NOMBRE_CARGO',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DESCRIPCION_CARGO'); ?>
		<?php echo $form->textArea($model,'DESCRIPCION_CARGO',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->