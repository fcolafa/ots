<?php
/* @var $this EspecifTecnicasController */
/* @var $model EspecifTecnicas */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_ESPEC_TECNICA'); ?>
		<?php echo $form->textField($model,'ID_ESPEC_TECNICA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_EQUIPO'); ?>
		<?php echo $form->textField($model,'ID_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_PIEZA'); ?>
		<?php echo $form->textField($model,'ID_PIEZA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CARACTERISTICA'); ?>
		<?php echo $form->textField($model,'CARACTERISTICA',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DESCRIPCION'); ?>
		<?php echo $form->textField($model,'DESCRIPCION',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->