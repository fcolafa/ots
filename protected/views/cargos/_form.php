<?php
/* @var $this CargosController */
/* @var $model Cargos */
/* @var $form CActiveForm */
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cargos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('class'=>'form-horizontal'),
)); ?>
	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php $empresa = Yii::app()->user->getEmpresaUser(); ?>
		
		<div class="span3">

			<?php echo $form->labelEx($model,'ID_EMPRESA'); ?>
			<?php echo $form->dropDownList($model,'ID_EMPRESA', array(''=>'-Seleccione Empresa-')+CHtml::listData(Empresa::model()->findAll(), 'ID_EMPRESA', 'NOMBRE_EMPRESA'),array('id'=>'cb_empresas', 'class'=>'span12', 'maxlength'=>80)); ?>
			<?php echo $form->error($model,'ID_EMPRESA'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'NOMBRE_CARGO'); ?>
			<?php echo $form->textField($model,'NOMBRE_CARGO',array('class'=>'span12', 'maxlength'=>150)); ?>
			<?php echo $form->error($model,'NOMBRE_CARGO'); ?>
			</div>
		<div class="span3">
		<!-- select cargos dependiente de empresa    -->
			<?php 
				echo $form->labelEx($model,'DEPENDENCIA_CARGO');
				if ($empresa>0)
					echo $form->dropDownList($model,'DEPENDENCIA_CARGO', array(''=>'-Seleccione Cargo-')+CHtml::listData(Cargos::model()->findAllByAttributes(array('ID_EMPRESA'=>$empresa)), 'ID_CARGO', 'NOMBRE_CARGO') ,array('id'=>'cb_cargos', 'class'=>'form-control'));
				else
					echo $form->dropDownList($model,'DEPENDENCIA_CARGO', array() ,array('id'=>'cb_cargos', 'class'=>'form-control'));
				echo $form->error($model,'DEPENDENCIA_CARGO');
			?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span10">
			<?php echo $form->labelEx($model,'DESCRIPCION_CARGO'); ?>
			<?php echo $form->textArea($model,'DESCRIPCION_CARGO',array('rows'=>2, 'class'=>'span12')); ?>
			<?php echo $form->error($model,'DESCRIPCION_CARGO'); ?>
		</div>
	</div>
	<br>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar' ,array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->