<?php
/* @var $this TipoMonedaController */
/* @var $model TipoMoneda */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_TIPO_MONEDA'); ?>
		<?php echo $form->textField($model,'ID_TIPO_MONEDA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TIPO_MONEDA'); ?>
		<?php echo $form->textField($model,'TIPO_MONEDA',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->