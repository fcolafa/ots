<?php
/* @var $this CotizacionController */
/* @var $model Cotizacion */

$this->breadcrumbs=array(
	$model->ID_COTIZACION=>array('approveCot','id'=>$model->ID_COTIZACION),
	'Aprobar Cotizacion',
);

$this->menu=array(
	array('label'=>' volver', 'url'=>array('ordenTrabajo/view','id'=>$model->ID_OT)),);
?>

<h1>Aprobar Cotización </h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>