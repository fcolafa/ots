<?php
/* @var $this CentroDeCostosController */
/* @var $model CentroDeCostos */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_CENTRO_COSTO'); ?>
		<?php echo $form->textField($model,'ID_CENTRO_COSTO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_EMPRESA'); ?>
		<?php echo $form->textField($model,'ID_EMPRESA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_CLIENTE'); ?>
		<?php echo $form->textField($model,'ID_CLIENTE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NUMERO_CENTRO'); ?>
		<?php echo $form->textField($model,'NUMERO_CENTRO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_CENTRO_COSTO'); ?>
		<?php echo $form->textField($model,'NOMBRE_CENTRO_COSTO',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DESCRIPCION_CENTRO_COSTO'); ?>
		<?php echo $form->textArea($model,'DESCRIPCION_CENTRO_COSTO',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->