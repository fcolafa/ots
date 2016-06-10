<?php
/* @var $this CotizacionController */
/* @var $model Cotizacion */

$this->breadcrumbs=array(
	$model->ID_COTIZACION,
);

$this->menu=array(
	array('label'=>' volver', 'url'=>array('ordenTrabajo/view','id'=>$model->ID_OT)),
	);
?>


<h1> Cotizacion #<?php echo $model->ID_COTIZACION.' '.$model->NOMBRE_ARCHIVO; ?> Aprobada</h1>


