<?php
/* @var $this TipoDeOtController */
/* @var $model TipoDeOt */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_TIPO_OT'); ?>
		<?php echo $form->textField($model,'ID_TIPO_OT'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_TIPO_OT'); ?>
		<?php echo $form->textField($model,'NOMBRE_TIPO_OT',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DESCRIPCION_TIPO_OP'); ?>
		<?php echo $form->textArea($model,'DESCRIPCION_TIPO_OP',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->