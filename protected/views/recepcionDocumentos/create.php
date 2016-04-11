<?php
/* @var $this RecepciondocumentosController */
/* @var $model Recepciondocumentos */

$this->breadcrumbs=array(
	'Recepciondocumentoses'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver Recepciondocumentos', 'url'=>array('index')),
	array('label'=>'Administrar Recepciondocumentos', 'url'=>array('admin')),
);
?>

<h1>Crear Recepcion Documentos</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'model_contratista'=>$model_contratista,'model_documentos'=>$model_documentos)); ?>