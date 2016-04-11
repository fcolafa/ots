<?php
/* @var $this UsuarioAprobacionController */
/* @var $model UsuarioAprobacion */

$this->breadcrumbs=array(
	'Usuario Aprobacions'=>array('index'),
	$model->ID_USUARIO_APROBACION=>array('view','id'=>$model->ID_USUARIO_APROBACION),
	'Modificar',
);

$this->menu=array(
	array('label'=>' UsuarioAprobacion', 'url'=>array('index')),
	array('label'=>'Crear UsuarioAprobacion', 'url'=>array('create')),
	array('label'=>'Ver UsuarioAprobacion', 'url'=>array('view', 'id'=>$model->ID_USUARIO_APROBACION)),
	array('label'=>'Administrar UsuarioAprobacion', 'url'=>array('admin')),
);
?>

<h1>Modificar UsuarioAprobacion <?php echo $model->ID_USUARIO_APROBACION; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>