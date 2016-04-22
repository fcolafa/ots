<?php
/* @var $this EmpresaController */
/* @var $model Empresa */
/* @var $form CActiveForm */
?>


<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/Masks.js');?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/Validate.js');?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'empresa-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'NOMBRE_EMPRESA'); ?>
			<?php echo $form->textField($model,'NOMBRE_EMPRESA',array('class'=>'span12', 'maxlength'=>150)); ?>
			<?php echo $form->error($model,'NOMBRE_EMPRESA'); ?>
		</div>
		<div class="span4">
			<?php echo $form->labelEx($model,'RUT_EMPRESA'); ?>
			<?php echo $form->textField($model,'RUT_EMPRESA',array('class'=>'span12', 'maxlength'=>150,'style' => 'text-align:right;','placeholder'=>'Ejemplo: 12345678-9', 'onkeyup' =>"this.value = MaskRut(this.value,true)")) ; ?>
			<?php echo $form->error($model,'RUT_EMPRESA'); ?>
		</div>
		<div class="span4">
			<?php echo $form->labelEx($model,'CASA_MATRIZ'); ?>
			<?php echo $form->textField($model,'CASA_MATRIZ',array('class'=>'span12', 'maxlength'=>150)); ?>
			<?php echo $form->error($model,'CASA_MATRIZ'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'CIUDAD'); ?>
			<?php echo $form->textField($model,'CIUDAD',array('class'=>'span12', 'maxlength'=>50)); ?>
			<?php echo $form->error($model,'CIUDAD'); ?>
		</div>
		<div class="span4">
			<?php echo $form->labelEx($model,'FONO'); ?>
			<?php echo $form->textField($model,'FONO',array('class'=>'span12', 'maxlength'=>150)); ?>
			<?php echo $form->error($model,'FONO'); ?>
		</div>
		<div class="span4">
			<?php echo $form->labelEx($model,'FAX'); ?>
			<?php echo $form->textField($model,'FAX',array('class'=>'span12', 'maxlength'=>150)); ?>
			<?php echo $form->error($model,'FAX'); ?>
		</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Logo Empresa'); ?>
		<?php //echo $form->textArea($model,'URL_FOTO_BARCO',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo CHtml::activeFileField($model,'image'); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>
	<div class="row">
	<?php if($model->isNewRecord!='1'){ ?>
		<div class="row">
			<?php echo CHtml::image(Yii::app()->request->baseUrl."/archivos/empresas/".$model->URL_LOGO,'URL_LOGO',array("width"=>200)); ?> 
		</div>
	<?php } ?>
	</div>
	<br>
	<div class="row">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar' ,array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->