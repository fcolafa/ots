<?php
/* @var $this TipoDocumentoController */
/* @var $model TipoDocumento */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_TIPO_DOC'); ?>
		<?php echo $form->textField($model,'ID_TIPO_DOC'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_DOC'); ?>
		<?php echo $form->textField($model,'NOMBRE_DOC',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->