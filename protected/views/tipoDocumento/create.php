<?php
/* @var $this TipoDocumentoController */
/* @var $model TipoDocumento */

$this->breadcrumbs=array(
	'Tipo Documentos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver TipoDocumento', 'url'=>array('index')),
	array('label'=>'Administrar TipoDocumento', 'url'=>array('admin')),
);
?>

<h1>Crear TipoDocumento</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>