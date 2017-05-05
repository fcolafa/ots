<?php
/* @var $this ModelEquipoController */
/* @var $model ModelEquipo */

$this->breadcrumbs=array(
	'Model Equipos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver ModelEquipo', 'url'=>array('index')),
	array('label'=>'Administrar ModelEquipo', 'url'=>array('admin')),
);
?>

<h1>Crear ModelEquipo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>