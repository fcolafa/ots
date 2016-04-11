<?php
/* @var $this InsumosOtController */
/* @var $model InsumosOt */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_INSUMOS_OT'); ?>
		<?php echo $form->textField($model,'ID_INSUMOS_OT'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_OT'); ?>
		<?php echo $form->textField($model,'ID_OT'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NUMERO_SUB_ITEM'); ?>
		<?php echo $form->textField($model,'NUMERO_SUB_ITEM',array('size'=>10,'maxlength'=>10)); ?>
	</div> 
	
	<div class="row">
		<?php echo $form->label($model,'NOMBRE_SUB_ITEM'); ?>
		<?php echo $form->textField($model,'NOMBRE_SUB_ITEM',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COSTO_CONTRATISTA'); ?>
		<?php echo $form->textField($model,'COSTO_CONTRATISTA',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NRO_COTIZACION'); ?>
		<?php echo $form->textField($model,'NRO_COTIZACION',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->