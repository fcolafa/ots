<?php
/* @var $this PersonalController */
/* @var $model Personal */
/* @var $form CActiveForm */
?>

<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/Masks.js');?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/Validates.js');?>

<script type="text/javascript">
	$( document ).ready(function() {
		//$('#formApruebaDocs').hide();

		if ( !$('.checkUsuario').is(':checked') ) {
			$('#formUsuario').hide();
		}

		if ( !$('#checkDocumentacion').is(':checked') ) {
			$('#formDocumentacion').hide();
		}

		$('.checkUsuario').click(function(){
			if (!$(this).is(':checked')) {
	            $('#formUsuario').hide("fast");
	        }else{
	        	$('#formUsuario').show("fast");
	        }
		});

		$('#checkDocumentacion').click(function(){
			if (!$(this).is(':checked')) {
	            $('#formDocumentacion').hide("fast");
	        }else{
	        	$('#formDocumentacion').show("fast");
	        }
		});
	});
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'personal-form',
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
				
		<div class="span3">
					<?php echo $form->labelEx($model,'RUT_PERSONA', array('class'=>'valida_rut')); ?>
					<?php echo $form->textField($model,'RUT_PERSONA',array('class'=>'span12 text-right','maxlength'=>13,'placeholder'=>'Ejemplo: 12345678-9', 'onkeyup' =>"this.value = MaskRut(this.value,true); ValidateRut(this.value);", 'is_numeric'=>"true")) ; ?>
					<?php echo $form->error($model,'RUT_PERSONA'); ?>
				</div>
		
		<div class="span4">
		<?php echo $form->labelEx($model,'NOMBRE_PERSONA'); ?>
		<?php echo $form->textField($model,'NOMBRE_PERSONA',array('class'=>'span12', 'maxlength'=>80)); ?>
		<?php echo $form->error($model,'NOMBRE_PERSONA'); ?>
		</div>

	<div class="span4">		
		<?php echo $form->labelEx($model,'APELLIDO_PERSONA'); ?>
		<?php echo $form->textField($model,'APELLIDO_PERSONA',array('class'=>'span12', 'maxlength'=>80)); ?>
		<?php echo $form->error($model,'APELLIDO_PERSONA'); ?>
	</div>
		
		
	</div>
	
	<div class="row">
		<div class="span3">
			<?php echo $form->labelEx($model,'TELEFONO'); ?>
			<?php echo $form->textField($model,'TELEFONO',array('class'=>'span12', 'maxlength'=>80)); ?>
			<?php echo $form->error($model,'TELEFONO'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'EMAIL'); ?>
			<?php echo $form->textField($model,'EMAIL',array('class'=>'span12', 'maxlength'=>80)); ?>
			<?php echo $form->error($model,'EMAIL'); ?>
		</div>
                
          

	
		
	</div>

	<div class="row">
	
	      <div class="span4">
		<?php echo $form->labelEx($model,'firma'); ?>
		<?php //echo $form->textArea($model,'URL_FOTO_BARCO',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo CHtml::activeFileField($model,'firma'); ?>
		<?php echo $form->error($model,'firma'); ?>
	</div>	
	
		
	
	</div>

	


	
	

	
	<div class="row">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar' ,array('class'=>'btn btn-primary', 'name'=>'modificar_personal')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->