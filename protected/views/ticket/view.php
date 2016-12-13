<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs = array(
    $model->ID_TICKET,
);

$this->menu = array(
    array('label' => 'Crear Ticket', 'url' => array('create')),
    //array('label'=>'Actualizar Ticket', 'url'=>array('update', 'id'=>$model->ID_TICKET)),
    //array('label'=>'Borrar Ticket', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_TICKET),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
    array('label' => 'Administrar Ticket', 'url' => array('admin')),
);
?>

<div class="bodyticket">
    <div class="title"><h3> Ticket N° <?= $model->ID_TICKET . ' ' . $model->ASUNTO_TICKET; ?></h3></div>
    <br>
    <?= $model->DESCRIPCION_TICKET ?>

    <br>
    <div class="fechaancha">
        <div class="mes"><?= Yii::app()->dateFormatter->format("MMMM", strtotime($model->FECHA_TICKET)) ?></div>                        
        <div class="dia"><?= Yii::app()->dateFormatter->format("d", strtotime($model->FECHA_TICKET)) ?> </div>
        <div class="año"><?= Yii::app()->dateFormatter->format("y", strtotime($model->FECHA_TICKET)) ?></div> 
        <div class="hora"><?= Yii::app()->dateFormatter->format("hh:mm", strtotime($model->FECHA_TICKET)) ?></div>
        <br>
    </div>
    <br>
    <?=$this->getFiles($model->ID_TICKET)?>
    <br>
    <?=$this->getMessages($model->ID_TICKET)?>
</div>

<?php if($model->ESTADO_TICKET!='Cerrado'){
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'ticket-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<?php echo $form->textArea($message, 'TICKET_MENSAJE', array('style' => 'width:100%;margin: 0 0 20px;')) ?>
<?php echo $form->error($message, 'TICKET_MENSAJE') ?>
<br>
<?php $this->widget('CCaptcha'); ?>
<?php echo $form->textField($message, '_verifyCode'); ?>
<?php echo $form->error($message, '_verifyCode'); ?>

<?php echo CHtml::submitButton('Añadir comentario', array('name' => 'message','class'=>'btn btn-success')); ?>
<?php echo CHtml::submitButton('Cerrar Ticket', array('name' => 'closeticket','class'=>'btn btn-success','confirm'=>'Esta Seguro que desea cerrar el ticket')); ?>

<?php $this->endWidget(); }?>