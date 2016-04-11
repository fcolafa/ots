<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

$this->breadcrumbs=array(
	'Usuarioses'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver Usuarios', 'url'=>array('index')),
	array('label'=>'Administrar Usuarios', 'url'=>array('admin')),
);
?>

<h1>Crear Usuarios</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>