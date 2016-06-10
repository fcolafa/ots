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
          
           
                <div class="span3">
                    <?php echo $form->labelEx($usuario,'_PASSANTIGUA'); ?>
                    <?php echo $form->passwordField($usuario,'_PASSANTIGUA',array("class"=>"span12", 'maxlength'=>60)); ?>
                    <?php echo $form->error($usuario,'_PASSANTIGUA'); ?>
                </div>
                 
		<div class="span4">
			<?php echo $form->labelEx($usuario,'CONTRASENA'); ?>
			<?php echo $form->passwordField($usuario,'CONTRASENA',array("class"=>"span12", 'maxlength'=>60)); ?>
			<?php echo $form->error($usuario,'CONTRASENA'); ?>
		</div>
               <div class="span4">  
             <?php echo $form->label($usuario,'_RPT_CONTRASENA'); ?>    
             <?php echo $form->passwordField($usuario,'_RPT_CONTRASENA',array("class"=>"span12", 'maxlength'=>60)); ?>    
             <?php echo $form->error($usuario,'_RPT_CONTRASENA');  ?> 
            </div>
        </div>

	<div class="row">
	
	         <?php 

        $this->widget('ext.EFineUploader.EFineUploader',
         array(
               'id'=>'cotizacion',
               'config'=>array(
                   'autoUpload'=>true,
                   'multiple'=> true,
                               'request'=>array(
                                  'endpoint'=>$this->createUrl('personal/upload'),
                                  'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                                               ),
                               'retry'=>array('enableAuto'=>true,'preventRetryResponseProperty'=>true),
                               'chunking'=>array('enable'=>true,'partSize'=>100),//bytes
                               'callbacks'=>array(
                                                //'onComplete'=>"js:function(id, name, response){ $('li.qq-upload-success').remove(); }",
                                                //'onError'=>"js:function(id, name, errorReason){ }",
                                                 ),
                               'validation'=>array(
                                         'allowedExtensions'=>array('pdf','jpg','jpeg','png'),
                                         'sizeLimit'=>5 * 1024 * 1024,//maximum file size in bytes
                                       //  'minSizeLimit'=>0*1024*1024,// minimum file size in bytes
                                                  ),
                   'callbacks'=>array(
          'onComplete'=>"js:function(id, name, response){
              var valid=true;

             $('#Personal__firma').val(response.filename);
                  
           }",
           'onError'=>"js:function(id, name, errorReason){ }",
          'onValidateBatch' => "js:function(fileOrBlobData) {}", // because of crash
        ),
                              )
              ));

        ?>
         <div class="row" style="display: none;">
	
             
		<?php echo $form->labelEx($model,'_firma'); ?>
		<?php echo $form->textField($model,'_firma'); ?>
		<?php echo $form->error($model,'_firma'); ?>
  
	</div>	
	<br>
	<div class="row">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar' ,array('class'=>'btn btn-success', 'name'=>'modificar_personal')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->