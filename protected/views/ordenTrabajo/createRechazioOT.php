<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	Yii::t('database','Orden de trabajo')=>array('admin'),
	Yii::t('actions','Create'),
);
$this->menu=array(
	array('label'=>Yii::t('actions','Administrar')." ". Yii::t('database','Ordenes de Trabajo'), 'url'=>array('admin')),
);
     

   $link="Orden de trabajo nº: ". CHtml::link(CHtml::encode($model->ID_OT), Yii::app()->baseUrl . '/ordenTrabajo/'.$model->ID_OT, array('target'=>'_blank'));
    

?>
<h1><?php echo Yii::t('actions','Rechazar').' '. $link?></h1>
<?php $this->renderPartial('_form_rechazar_ot', array('model'=>$model)); ?>