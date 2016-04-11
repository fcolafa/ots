<?php
/* @var $this DocumentosContratistaController */
/* @var $model DocumentosContratista */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_DOCUMENTO'); ?>
		<?php echo $form->textField($model,'ID_DOCUMENTO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_DOCUMENTO'); ?>
		<?php echo $form->textField($model,'NOMBRE_DOCUMENTO',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DESCRIPCION'); ?>
		<?php echo $form->textField($model,'DESCRIPCION',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->