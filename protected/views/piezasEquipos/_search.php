<?php
/* @var $this PiezasEquiposController */
/* @var $model PiezasEquipos */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_PIEZA'); ?>
		<?php echo $form->textField($model,'ID_PIEZA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_EQUIPO'); ?>
		<?php echo $form->textField($model,'ID_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_PIEZA'); ?>
		<?php echo $form->textField($model,'NOMBRE_PIEZA',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IMAGEN_PIEZA'); ?>
		<?php echo $form->textField($model,'IMAGEN_PIEZA',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->