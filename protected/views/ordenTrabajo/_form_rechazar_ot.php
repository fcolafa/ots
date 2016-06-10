<?php
/* @var $this TicketMessageController */
/* @var $model TicketMessage */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rechazar_ot_form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        //'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note"> <?php echo Yii::t('validation','Fields with')?> <span class="required">*</span> <?php echo Yii::t('validation','are required')?> </p>

	<?php echo $form->errorSummary($model); ?>
   
	<div class="row">
		<?php echo $form->labelEx($model,'MOTIVO_RECHAZO'); ?>
		<?php echo $form->textArea($model,'MOTIVO_RECHAZO',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'MOTIVO_RECHAZO'); ?>
	</div>
   
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions','Guardar') : Yii::t('actions','Guardar'),array('class'=>'btn btn-danger')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->