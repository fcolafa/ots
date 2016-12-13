<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_TICKET'); ?>
		<?php echo $form->textField($model,'ID_TICKET'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ASUNTO_TICKET'); ?>
		<?php echo $form->textField($model,'ASUNTO_TICKET',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DESCRIPCION_TICKET'); ?>
		<?php echo $form->textArea($model,'DESCRIPCION_TICKET',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_TICKET'); ?>
		<?php echo $form->textField($model,'FECHA_TICKET'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_PERSONA'); ?>
		<?php echo $form->textField($model,'ID_PERSONA'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->