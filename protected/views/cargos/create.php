<?php
/* @var $this CargosController */
/* @var $model Cargos */

$this->breadcrumbs=array(
	'Cargoses'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver Cargos', 'url'=>array('index')),
	array('label'=>'Administrar Cargos', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Crear Cargos</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>