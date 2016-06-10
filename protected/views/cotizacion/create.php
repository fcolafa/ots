<?php
/* @var $this CotizacionController */
/* @var $model Cotizacion */

$this->breadcrumbs=array(
	'Cotizacions'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver Cotizacion', 'url'=>array('index')),
	array('label'=>'Administrar Cotizacion', 'url'=>array('admin')),
);
?>

<h1>Crear Cotizacion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>