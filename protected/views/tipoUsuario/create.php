<?php
/* @var $this TipoUsuarioController */
/* @var $model TipoUsuario */

$this->breadcrumbs=array(
	'Tipo Usuarios'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver Tipo Usuario', 'url'=>array('index')),
	array('label'=>'Administrar Tipo Usuario', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Crear Tipo Usuario</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>