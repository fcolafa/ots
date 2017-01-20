<?php
/* @var $this CentroDeCostosController */
/* @var $model CentroDeCostos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'centro-de-costos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
            <?php if(Yii::app()->user->allCompany() && Yii::app()->user->A1()){ ?>
		<div class="span3">
			<?php echo $form->labelEx($model,'ID_EMPRESA'); ?>
			<?php echo $form->dropDownList($model,'ID_EMPRESA', array(''=>'-Seleccione Empresa-')+CHtml::listData(Empresa::model()->findAll(), 'ID_EMPRESA', 'NOMBRE_EMPRESA'),array('id'=>'cb_empresas', 'class'=>'span12', 'maxlength'=>80)); ?>
			<?php echo $form->error($model,'ID_EMPRESA'); ?>
		</div> 
            <?php } ?>
		<div class="span3">
		<?php echo $form->labelEx($model,'NUMERO_CENTRO'); ?>
		<?php echo $form->textField($model,'NUMERO_CENTRO'); ?>
		<?php echo $form->error($model,'NUMERO_CENTRO'); ?>
		</div>

		<div class="span4">
		<?php echo $form->labelEx($model,'NOMBRE_CENTRO_COSTO'); ?>
		<?php echo $form->textField($model,'NOMBRE_CENTRO_COSTO',array('size'=>60,'maxlength'=>250, 'class'=>'span12')); ?>
		<?php echo $form->error($model,'NOMBRE_CENTRO_COSTO'); ?>
		</div>
	</div>
	<div class="row">
		<div class="span10">
		<?php echo $form->labelEx($model,'DESCRIPCION_CENTRO_COSTO'); ?>
		<?php echo $form->textArea($model,'DESCRIPCION_CENTRO_COSTO',array('rows'=>2, 'class'=>'span12')); ?>
		<?php echo $form->error($model,'DESCRIPCION_CENTRO_COSTO'); ?>
		</div>
	</div>
	
	<!--<div class="row">
		<?php echo $form->labelEx($model,'ID_CLIENTE'); ?>
		<?php echo $form->textField($model,'ID_CLIENTE'); ?>
		<?php echo $form->error($model,'ID_CLIENTE'); ?>
	</div>
	-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar' ,array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->