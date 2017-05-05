<?php
/* @var $this RegistroMantencionController */
/* @var $model RegistroMantencion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_REGISTRO'); ?>
		<?php echo $form->textField($model,'ID_REGISTRO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_EQUIPO'); ?>
		<?php echo $form->textField($model,'ID_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_REGISTRO'); ?>
		<?php echo $form->textField($model,'FECHA_REGISTRO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'REGISTRO_MARCADO'); ?>
		<?php echo $form->textField($model,'REGISTRO_MARCADO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COMENTARIO_REGISTRO'); ?>
		<?php echo $form->textArea($model,'COMENTARIO_REGISTRO',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->