<?php
/* @var $this ConsultaController */
/* @var $model Consulta */

$this->breadcrumbs=array(
	'Consultas'=>array('index'),
	$model->ID_CONSULTA=>array('view','id'=>$model->ID_CONSULTA),
	'Modificar',
);

$this->menu=array(
	array('label'=>' Consulta', 'url'=>array('index')),
	array('label'=>'Crear Consulta', 'url'=>array('create')),
	array('label'=>'Ver Consulta', 'url'=>array('view', 'id'=>$model->ID_CONSULTA)),
	array('label'=>'Administrar Consulta', 'url'=>array('admin')),
);
?>

<h1>Modificar Consulta <?php echo $model->ID_CONSULTA; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>