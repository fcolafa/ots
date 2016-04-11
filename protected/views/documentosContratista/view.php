<?php
/* @var $this DocumentosContratistaController */
/* @var $model DocumentosContratista */

$this->breadcrumbs=array(
	'DocumentosContratistas'=>array('index'),
	$model->ID_DOCUMENTO,
);

$this->menu=array(
	array('label'=>'Ver Documentos Contratista', 'url'=>array('index')),
	array('label'=>'Crear Documentos Contratista', 'url'=>array('create')),
	array('label'=>'Actualizar Documentos Contratista', 'url'=>array('update', 'id'=>$model->ID_DOCUMENTO)),
	array('label'=>'Borrar Documentos Contratista', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_DOCUMENTO),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar Documentos Contratista', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Documento Contratista # <?php echo $model->NOMBRE_DOCUMENTO; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_DOCUMENTO',
		'NOMBRE_DOCUMENTO',
		'DESCRIPCION',
	),
)); ?>
