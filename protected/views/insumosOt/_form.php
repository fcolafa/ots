<?php
/* @var $this InsumosOtController */
/* @var $model InsumosOt */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'insumos-ot-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_OT'); ?>
		<?php echo $form->textField($model,'ID_OT'); ?>
		<?php echo $form->error($model,'ID_OT'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NUMERO_SUB_ITEM'); ?>
		<?php echo $form->textField($model,'NUMERO_SUB_ITEM',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'NUMERO_SUB_ITEM'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE_SUB_ITEM'); ?>
		<?php echo $form->textField($model,'NOMBRE_SUB_ITEM',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'NOMBRE_SUB_ITEM'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COSTO_CONTRATISTA'); ?>
		<?php echo $form->textField($model,'COSTO_CONTRATISTA',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'COSTO_CONTRATISTA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NRO_COTIZACION'); ?>
		<?php echo $form->textField($model,'NRO_COTIZACION',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'NRO_COTIZACION'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_CENTRO_COSTO'); ?>
		<?php echo $form->dropDownList($model,'ID_CENTRO_COSTO', CHtml::listData(CentroDeCostos::model()->findAll(),'ID_CENTRO_COSTO', 'NOMBRE_CENTRO_COSTO'), array('empty'=>'Indicar Centro Costo') ); ?>
		<?php echo $form->error($model,'ID_CENTRO_COSTO'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->