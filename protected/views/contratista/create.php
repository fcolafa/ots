<?php
/* @var $this ContratistaController */
/* @var $model Contratista */

$this->breadcrumbs=array(
	//'Contratistas'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Ver Contratistas', 'url'=>array('index')),
	array('label'=>'Administrar Contratistas', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Crear Contratista</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>