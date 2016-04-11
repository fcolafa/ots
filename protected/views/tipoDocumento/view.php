<?php
/* @var $this TipoDocumentoController */
/* @var $model TipoDocumento */

$this->breadcrumbs=array(
	'Tipo Documentos'=>array('index'),
	$model->ID_TIPO_DOC,
);

$this->menu=array(
	array('label'=>'Ver TipoDocumento', 'url'=>array('index')),
	array('label'=>'Crear TipoDocumento', 'url'=>array('create')),
	array('label'=>'Actualizar TipoDocumento', 'url'=>array('update', 'id'=>$model->ID_TIPO_DOC)),
	array('label'=>'Borrar TipoDocumento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_TIPO_DOC),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar TipoDocumento', 'url'=>array('admin')),
);
?>

<h1> TipoDocumento #<?php echo $model->ID_TIPO_DOC; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_TIPO_DOC',
		'NOMBRE_DOC',
	),
)); ?>
