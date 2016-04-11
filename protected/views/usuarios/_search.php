<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_USUARIO'); ?>
		<?php echo $form->textField($model,'ID_USUARIO',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_USUARIO'); ?>
		<?php echo $form->textField($model,'NOMBRE_USUARIO',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CONTRASENA'); ?>
		<?php echo $form->textField($model,'CONTRASENA',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COD_TIPO_USUARIO'); ?>
		<?php echo $form->textField($model,'COD_TIPO_USUARIO',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_PERSONA'); ?>
		<?php echo $form->textField($model,'ID_PERSONA'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->