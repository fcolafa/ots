<?php
/* @var $this MarcaEquipoController */
/* @var $model MarcaEquipo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_MARCA_EQUIPO'); ?>
		<?php echo $form->textField($model,'ID_MARCA_EQUIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_MARCA_EQUIPO'); ?>
		<?php echo $form->textField($model,'NOMBRE_MARCA_EQUIPO',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->