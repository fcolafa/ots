<?php
/* @var $this DepartamentosController */
/* @var $model Departamentos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'departamentos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	
		<div class="span4">
		<?php echo $form->labelEx($model,'ID_EMPRESA'); ?>
		<?php echo $form->dropDownList($model,'ID_EMPRESA', array(''=>'-Seleccione Empresa-')+CHtml::listData(Empresa::model()->findAll(), 'ID_EMPRESA', 'NOMBRE_EMPRESA'),array('id'=>'cb_empresas', 'class'=>'span12', 'maxlength'=>80)); ?>
		<?php echo $form->error($model,'ID_EMPRESA'); ?>
	</div>

		<div class="span3">
			<?php echo $form->labelEx($model,'NOMBRE_DEPARTAMENTO'); ?>
			<?php echo $form->textField($model,'NOMBRE_DEPARTAMENTO',array('class'=>'span12', 'maxlength'=>80)); ?>
			<?php echo $form->error($model,'NOMBRE_DEPARTAMENTO'); ?>
		</div>
		<div class="span5">
			<?php echo $form->labelEx($model,'DESCRIPCION_DEPARTAMENTO'); ?>
			<?php echo $form->textArea($model,'DESCRIPCION_DEPARTAMENTO',array('rows'=>2, 'class'=>'span12')); ?>
			<?php echo $form->error($model,'DESCRIPCION_DEPARTAMENTO'); ?>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar' ,array('class'=>'btn btn-primary offset1')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->