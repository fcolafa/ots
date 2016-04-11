<?php
/* @var $this DocumentosContratistaController */
/* @var $model DocumentosContratista */

$this->breadcrumbs=array(
	//'DocumentosContratistas'=>array('index'),
	$model->ID_DOCUMENTO=>array('view','id'=>$model->ID_DOCUMENTO),
	'Modificar',
);

$this->menu=array(
	array('label'=>' Documentos Contratista', 'url'=>array('index')),
	array('label'=>'Crear Documentos Contratista', 'url'=>array('create')),
	//array('label'=>'Ver Documentos Contratista', 'url'=>array('view', 'id'=>$model->ID_DOCUMENTO)),
	array('label'=>'Administrar Documentos Contratista', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Modificar Documento Contratista <?php echo $model->NOMBRE_DOCUMENTO; ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>