<?php
/* @var $this RegistroHorometroController */
/* @var $model RegistroHorometro */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_REGISTRO_HOROM'); ?>
		<?php echo $form->textField($model,'ID_REGISTRO_HOROM'); ?>
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
		<?php echo $form->label($model,'HOROMETRO'); ?>
		<?php echo $form->textField($model,'HOROMETRO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_USUARIO'); ?>
		<?php echo $form->textField($model,'ID_USUARIO',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OBSERVACION'); ?>
		<?php echo $form->textArea($model,'OBSERVACION',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->