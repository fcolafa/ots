<?php
/* @var $this NivelAprobacionController */
/* @var $model NivelAprobacion */

$this->breadcrumbs=array(
	'Nivel Aprobacions'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver NivelAprobacion', 'url'=>array('index')),
	array('label'=>'Administrar NivelAprobacion', 'url'=>array('admin')),
);
?>

<h1>Crear NivelAprobacion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>