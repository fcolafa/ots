<?php
/* @var $this UsuarioAprobacionController */
/* @var $model UsuarioAprobacion */

$this->breadcrumbs=array(
	'Usuario Aprobacions'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver UsuarioAprobacion', 'url'=>array('index')),
	array('label'=>'Administrar UsuarioAprobacion', 'url'=>array('admin')),
);
?>

<h1>Crear UsuarioAprobacion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>