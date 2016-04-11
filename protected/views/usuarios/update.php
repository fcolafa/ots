<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

$this->breadcrumbs=array(
	'Usuarioses'=>array('index'),
	$model->ID_USUARIO=>array('view','id'=>$model->ID_USUARIO),
	'Modificar',
);

$this->menu=array(
	array('label'=>' Usuarios', 'url'=>array('index')),
	array('label'=>'Crear Usuarios', 'url'=>array('create')),
	array('label'=>'Ver Usuarios', 'url'=>array('view', 'id'=>$model->ID_USUARIO)),
	array('label'=>'Administrar Usuarios', 'url'=>array('admin')),
);
?>

<h1>Modificar Usuarios <?php echo $model->ID_USUARIO; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>