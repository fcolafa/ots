<?php
/* @var $this ContratistaController */
/* @var $model Contratista */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_CONTRATISTA'); ?>
		<?php echo $form->textField($model,'ID_CONTRATISTA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_EMPRESA'); ?>
		<?php echo $form->textField($model,'ID_EMPRESA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_CONTRATISTA'); ?>
		<?php echo $form->textField($model,'NOMBRE_CONTRATISTA',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUT_CONTRATISTA'); ?>
		<?php echo $form->textField($model,'RUT_CONTRATISTA',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DIRECCION_CONTRATISTA'); ?>
		<?php echo $form->textField($model,'DIRECCION_CONTRATISTA',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CIUDAD_CONTRATISTA'); ?>
		<?php echo $form->textField($model,'CIUDAD_CONTRATISTA',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TELEFONO_CONTRATISTA'); ?>
		<?php echo $form->textField($model,'TELEFONO_CONTRATISTA',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GIRO_AREA'); ?>
		<?php echo $form->textField($model,'GIRO_AREA',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ENCARGADO'); ?>
		<?php echo $form->textField($model,'ENCARGADO',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'AUTORIZADO'); ?>
		<?php echo $form->textField($model,'AUTORIZADO'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->