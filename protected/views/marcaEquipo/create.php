<?php
/* @var $this MarcaEquipoController */
/* @var $model MarcaEquipo */

$this->breadcrumbs=array(
	'Marca Equipos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver MarcaEquipo', 'url'=>array('index')),
	array('label'=>'Administrar MarcaEquipo', 'url'=>array('admin')),
);
?>

<h1>Crear MarcaEquipo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>