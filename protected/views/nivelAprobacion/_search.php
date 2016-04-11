<?php
/* @var $this NivelAprobacionController */
/* @var $model NivelAprobacion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_NIVEL_APROB'); ?>
		<?php echo $form->textField($model,'ID_NIVEL_APROB',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_TIPO_DOC'); ?>
		<?php echo $form->textField($model,'ID_TIPO_DOC'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_NIVEL'); ?>
		<?php echo $form->textField($model,'NOMBRE_NIVEL',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NIVEL_APROB'); ?>
		<?php echo $form->textField($model,'NIVEL_APROB',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MONTO_APROB'); ?>
		<?php echo $form->textField($model,'MONTO_APROB',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->