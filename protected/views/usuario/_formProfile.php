<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuarios-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('class'=>'form-horizontal'),
	)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>
        <?php
        if($model->PRIMER_LOGIN==0){ ?>
            <p class="note">Antes de poder realizar cualquier accion debe actualizar sus datos </p>
        <?php }?>
	<?php echo $form->errorSummary($model); ?>
        
       
	<div class="form-group">

		<div class="col-md-6">
			<?php echo $form->labelEx($model,'NOMBRE_USUARIO'); ?>
			<?php echo $form->textField($model,'NOMBRE_USUARIO',array("class"=>"form-control", 'maxlength'=>50)); ?>
			<?php echo $form->error($model,'NOMBRE_USUARIO'); ?>
		</div>
     
                <div  class="col-md-6">
			<?php echo $form->labelEx($model,'EMAIL_USUARIO'); ?>
			<?php echo $form->textField($model,'EMAIL_USUARIO', array( 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'EMAIL_USUARIO'); ?>
		</div>
                
	</div>
        <div class="form-group">
             <?php
             
             if(!$model->isNewRecord){
             if(Yii::app()->user->getUser_Id()==$model->ID_USUARIO ){ ?>
                <div class="col-md-4">
                    <?php echo $form->labelEx($model,'_PASSANTIGUA'); ?>
                    <?php echo $form->passwordField($model,'_PASSANTIGUA',array("class"=>"form-control", 'maxlength'=>50)); ?>
                    <?php echo $form->error($model,'_PASSANTIGUA'); ?>
                </div>
                 <?php } ?>
		<div class="col-md-4">
			<?php echo $form->labelEx($model,'CONTRASENA'); ?>
			<?php echo $form->passwordField($model,'CONTRASENA',array("class"=>"form-control", 'maxlength'=>50)); ?>
			<?php echo $form->error($model,'CONTRASENA'); ?>
		</div>
               <div class="col-md-4">  
             <?php echo $form->label($model,'_RPT_CONTRASENA'); ?>    
             <?php echo $form->passwordField($model,'_RPT_CONTRASENA',array("class"=>"form-control", 'maxlength'=>50)); ?>    
             <?php echo $form->error($model,'_RPT_CONTRASENA'); } ?> 
        </div>
        </div>


        <br>
	<div class="form-group">
		<div class="col-md-offset-4 col-sm-8">
			<?php echo CHtml::submitButton($model->isNewRecord ? ' Crear ' : ' Guardar ',array('class'=>'btn btn-success')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


