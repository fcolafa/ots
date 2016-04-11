<?php
/* @var $this TipoDocumentoController */
/* @var $model TipoDocumento */

$this->breadcrumbs=array(
	'Tipo Documentos'=>array('index'),
	$model->ID_TIPO_DOC=>array('view','id'=>$model->ID_TIPO_DOC),
	'Modificar',
);

$this->menu=array(
	array('label'=>' TipoDocumento', 'url'=>array('index')),
	array('label'=>'Crear TipoDocumento', 'url'=>array('create')),
	array('label'=>'Ver TipoDocumento', 'url'=>array('view', 'id'=>$model->ID_TIPO_DOC)),
	array('label'=>'Administrar TipoDocumento', 'url'=>array('admin')),
);
?>

<h1>Modificar TipoDocumento <?php echo $model->ID_TIPO_DOC; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>