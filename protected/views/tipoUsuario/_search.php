<?php
/* @var $this TipoUsuarioController */
/* @var $model TipoUsuario */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'COD_TIPO_USUARIO'); ?>
		<?php echo $form->textField($model,'COD_TIPO_USUARIO',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_TIPO_USUARIO'); ?>
		<?php echo $form->textField($model,'NOMBRE_TIPO_USUARIO',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DESCRIPCION_TIPO_USUARIO'); ?>
		<?php echo $form->textArea($model,'DESCRIPCION_TIPO_USUARIO',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->