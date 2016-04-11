<?php
/* @var $this OrdenTrabajoController */
/* @var $model OrdenTrabajo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_OT'); ?>
		<?php echo $form->textField($model,'ID_OT'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_EMPRESA'); ?>
		<?php echo $form->textField($model,'ID_EMPRESA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_CONTRATISTA'); ?>
		<?php echo $form->textField($model,'ID_CONTRATISTA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USUARIO_CREADOR'); ?>
		<?php echo $form->textField($model,'USUARIO_CREADOR'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SOLICITANTE'); ?>
		<?php echo $form->textField($model,'SOLICITANTE',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SUPERVISOR'); ?>
		<?php echo $form->textField($model,'SUPERVISOR'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_DEPARTAMENTO'); ?>
		<?php echo $form->textField($model,'ID_DEPARTAMENTO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_EJECUCION'); ?>
		<?php echo $form->textField($model,'FECHA_EJECUCION'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_TIPO_OT'); ?>
		<?php echo $form->textField($model,'ID_TIPO_OT'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DESCRIPCION_OT'); ?>
		<?php echo $form->textArea($model,'DESCRIPCION_OT',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_OT'); ?>
		<?php echo $form->textField($model,'FECHA_OT'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VOBO_JEFE_DPTO'); ?>
		<?php echo $form->textField($model,'VOBO_JEFE_DPTO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VOBO_ADMIN'); ?>
		<?php echo $form->textField($model,'VOBO_ADMIN'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VOBO_GERENTE_OP'); ?>
		<?php echo $form->textField($model,'VOBO_GERENTE_OP'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VOBO_GERENTE_GRAL'); ?>
		<?php echo $form->textField($model,'VOBO_GERENTE_GRAL'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ARCHIVO_ADJUNTO'); ?>
		<?php echo $form->textField($model,'ARCHIVO_ADJUNTO',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->