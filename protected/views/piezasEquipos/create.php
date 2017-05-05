<?php
/* @var $this PiezasEquiposController */
/* @var $model PiezasEquipos */

$this->breadcrumbs=array(
	'Piezas Equiposes'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver PiezasEquipos', 'url'=>array('index')),
	array('label'=>'Administrar PiezasEquipos', 'url'=>array('admin')),
);
?>

<h1>Crear PiezasEquipos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>