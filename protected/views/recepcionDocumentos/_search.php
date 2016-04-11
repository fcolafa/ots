<?php
/* @var $this RecepciondocumentosController */
/* @var $model Recepciondocumentos */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_RECEPCION'); ?>
		<?php echo $form->textField($model,'ID_RECEPCION'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_RECEPCION'); ?>
		<?php echo $form->textField($model,'FECHA_RECEPCION'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ESTADO'); ?>
		<?php echo $form->textField($model,'ESTADO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_CONTRATISTA'); ?>
		<?php echo $form->textField($model,'ID_CONTRATISTA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_DOCUMENTO'); ?>
		<?php echo $form->textField($model,'ID_DOCUMENTO'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->