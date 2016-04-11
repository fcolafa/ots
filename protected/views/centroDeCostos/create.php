<?php
/* @var $this CentroDeCostosController */
/* @var $model CentroDeCostos */

$this->breadcrumbs=array(
	'Centro De Costos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver Centro De Costos', 'url'=>array('index')),
	array('label'=>'Administrar Centro De Costos', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Crear Centro De Costos</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>