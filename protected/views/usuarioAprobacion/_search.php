<?php
/* @var $this UsuarioAprobacionController */
/* @var $model UsuarioAprobacion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_USUARIO_APROBACION'); ?>
		<?php echo $form->textField($model,'ID_USUARIO_APROBACION'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_USUARIO'); ?>
		<?php echo $form->textField($model,'ID_USUARIO',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_NIVEL_APROB'); ?>
		<?php echo $form->textField($model,'ID_NIVEL_APROB',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->