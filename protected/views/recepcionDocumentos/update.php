<?php
/* @var $this RecepciondocumentosController */
/* @var $model Recepciondocumentos */

$this->breadcrumbs=array(
	'Recepciondocumentoses'=>array('index'),
	$model->ID_RECEPCION=>array('view','id'=>$model->ID_RECEPCION),
	'Modificar',
);

$this->menu=array(
	array('label'=>' Recepciondocumentos', 'url'=>array('index')),
	array('label'=>'Crear Recepciondocumentos', 'url'=>array('create')),
	array('label'=>'Ver Recepciondocumentos', 'url'=>array('view', 'id'=>$model->ID_RECEPCION)),
	array('label'=>'Administrar Recepciondocumentos', 'url'=>array('admin')),
);
?>

<h3>Modificar Recepcion Documentos <?php echo $model->iDCONTRATISTAS->NOMBRE_CONTRATISTA; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model,'model_contratista'=>$model_contratista,'model_documentos'=>$model_documentos)); ?>