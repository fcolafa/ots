<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>
      
	<div class="row">
		<div class="span2">
			<?php echo $form->labelEx($model,'NOMBRE_USUARIO'); ?>
			<?php echo $form->textField($model,'NOMBRE_USUARIO',array('class'=>'span12','maxlength'=>20)); ?>
			<?php echo $form->error($model,'NOMBRE_USUARIO'); ?>
		</div>
		<div class="span2">
			<?php echo $form->labelEx($model,'COD_TIPO_USUARIO'); ?>
			<?php echo $form->dropDownList($model,'COD_TIPO_USUARIO', CHtml::listData(TipoUsuario::model()->findAll(array( 'group'=>'COD_TIPO_USUARIO',)), 'COD_TIPO_USUARIO', 'NOMBRE_TIPO_USUARIO'), array('empty'=> 'Elegir tipo de usuario', 'class'=>'span12')); ?>
			<?php echo $form->error($model,'COD_TIPO_USUARIO'); ?>
		</div>
		<div class="span2">
			<?php echo $form->labelEx($model,'RUT_USUARIO'); ?>
			<?php echo $form->textField($model,'RUT_USUARIO',array('class'=>'span12','maxlength'=>13)); ?>
			<?php echo $form->error($model,'RUT_USUARIO'); ?>
		</div>
	</div>
        

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'NOMBRE_PERSONA'); ?>
			<?php echo $form->textField($model,'NOMBRE_PERSONA',array('class'=>'span12','maxlength'=>150)); ?>
			<?php echo $form->error($model,'NOMBRE_PERSONA'); ?>
		</div>
		<div class="span4">
			<?php echo $form->labelEx($model,'APELLIDO_PERSONA'); ?>
			<?php echo $form->textField($model,'APELLIDO_PERSONA',array('class'=>'span12','maxlength'=>150)); ?>
			<?php echo $form->error($model,'APELLIDO_PERSONA'); ?>
		</div>
	</div>

	<div class="row buttons">
		<div class="span1 offset3">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->