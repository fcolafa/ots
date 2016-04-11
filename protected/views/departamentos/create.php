<?php
/* @var $this DepartamentosController */
/* @var $model Departamentos */

$this->breadcrumbs=array(
	//'Departamentos'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Ver Departamentos', 'url'=>array('index')),
	array('label'=>'Administrar Departamentos', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Crear Departamentos</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>