<?php
/* @var $this CotizacionController */
/* @var $model Cotizacion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cotizacion-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		
		<?php echo $model->getFile($model->ID_COTIZACION); ?>
	
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'COMENTARIOS_COTIZACION'); ?>
		<?php echo $form->textArea($model,'COMENTARIOS_COTIZACION',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'COMENTARIOS_COTIZACION'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aprobar' : 'Aprobar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->