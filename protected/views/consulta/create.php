<?php
/* @var $this ConsultaController */
/* @var $model Consulta */

$this->breadcrumbs=array(
	'Consultas'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Ver Consulta', 'url'=>array('index')),
	//array('label'=>'Administrar Consulta', 'url'=>array('admin')),
);
?>

<h1>Crear Consulta</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>