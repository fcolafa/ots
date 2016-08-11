<?php
/* @var $this ConsultaController */
/* @var $model Consulta */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_CONSULTA'); ?>
		<?php echo $form->textField($model,'ID_CONSULTA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CONSULTA'); ?>
		<?php echo $form->textArea($model,'CONSULTA',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_CONSULTA'); ?>
		<?php echo $form->textField($model,'FECHA_CONSULTA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TIPO_MENSAJE'); ?>
		<?php echo $form->textField($model,'TIPO_MENSAJE',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_PERSONA'); ?>
		<?php echo $form->textField($model,'ID_PERSONA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_OT'); ?>
		<?php echo $form->textField($model,'ID_OT'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_CONSULTADO'); ?>
		<?php echo $form->textField($model,'ID_CONSULTADO'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->