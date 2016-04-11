<?php
/* @var $this PersonalController */
/* @var $model Personal */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_PERSONA'); ?>
		<?php echo $form->textField($model,'ID_PERSONA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_EMPRESA'); ?>
		<?php echo $form->textField($model,'ID_EMPRESA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUT_PERSONA'); ?>
		<?php echo $form->textField($model,'RUT_PERSONA',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_PERSONA'); ?>
		<?php echo $form->textField($model,'NOMBRE_PERSONA',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'APELLIDO_PERSONA'); ?>
		<?php echo $form->textField($model,'APELLIDO_PERSONA',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TELEFONO'); ?>
		<?php echo $form->textField($model,'TELEFONO',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EMAIL'); ?>
		<?php echo $form->textField($model,'EMAIL',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_CARGO'); ?>
		<?php echo $form->textField($model,'ID_CARGO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_DEPARTAMENTO'); ?>
		<?php echo $form->textField($model,'ID_DEPARTAMENTO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ES_SUPERVISOR'); ?>
		<?php echo $form->textField($model,'ES_SUPERVISOR',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ESTADO_TRABAJADOR'); ?>
		<?php echo $form->textField($model,'ESTADO_TRABAJADOR',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->