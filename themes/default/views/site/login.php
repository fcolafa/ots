<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Acceso';
//$this->breadcrumbs=array( 'Acceso',);

?>
<div class="span3">
</div>
<div class="page-header">
    <h2> Ingreso a Sistema de Aprobación de Documentos</h2>
</div>

<div class="row-fluid">    
    <div class="span6 offset3"> 
        <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>"Acceso Restringido",
            ));
            
        ?>
        <p>Por favor ingrese en los siguientes campos sus credenciales de ingreso al sistema:</p>
        
        <div class="form">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'login-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            )); ?>        
            <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

            <div>
                <div class="row">
                    <div class="span5 offset2">
                        <?php echo $form->labelEx($model,'username'); ?>
                        <?php echo $form->textField($model,'username'); ?>
                        <?php echo $form->error($model,'username'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="span5 offset2">
                        <?php echo $form->labelEx($model,'password'); ?>
                        <?php echo $form->passwordField($model,'password'); ?>
                        <?php echo $form->error($model,'password'); ?>
                    </div>
                </div>

<!--                <div class="row">
                    <div class="span5 offset2">
                        <?php // echo  $form->labelEx($model,'empresa'); ?>
                        <?php //echo $form->dropDownList($model,'empresa', array(''=>'-Seleccione Empresa-')+CHtml::listData(Empresa::model()->findAll(), 'ID_EMPRESA', 'NOMBRE_EMPRESA')); ?>
                        <?php //echo $form->error($model,'empresa'); ?>
                    </div>
                </div>-->

                <div class="row rememberMe">
                    <div class="span5 offset2">
                        <?php echo $form->checkBox($model,'rememberMe'); ?>
                        <?php echo $form->label($model,'rememberMe'); ?>
                        <?php echo $form->error($model,'rememberMe'); ?>
                    </div>
                </div>

                <div class="row buttons">
                    <div class="span3 offset2">
                        <?php echo CHtml::submitButton('Acceder',array('class'=>'btn btn btn-primary')); ?>
                    </div>
                </div>
            </div>

            <?php $this->endWidget(); ?>
        </div><!-- form -->
        <?php $this->endWidget();?>
    </div>
</div>

<div class="span6"> </div>
