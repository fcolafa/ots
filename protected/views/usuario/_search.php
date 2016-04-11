<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_USUARIO'); ?>
		<?php echo $form->textField($model,'NOMBRE_USUARIO',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COD_TIPO_USUARIO'); ?>
		<?php echo $form->textField($model,'COD_TIPO_USUARIO',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUT_USUARIO'); ?>
		<?php echo $form->textField($model,'RUT_USUARIO',array('size'=>13,'maxlength'=>13)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_PERSONA'); ?>
		<?php echo $form->textField($model,'NOMBRE_PERSONA',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'APELLIDO_PERSONA'); ?>
		<?php echo $form->textField($model,'APELLIDO_PERSONA',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->