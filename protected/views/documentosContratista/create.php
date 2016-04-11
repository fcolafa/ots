<?php
/* @var $this DocumentosContratistaController */
/* @var $model DocumentosContratista */

$this->breadcrumbs=array(
	//'DocumentosContratistas'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Ver Documentos Contratista', 'url'=>array('index')),
	array('label'=>'Administrar Documentos Contratista', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Crear Documentos Contratista</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>