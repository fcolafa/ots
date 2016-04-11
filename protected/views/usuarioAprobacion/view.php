<?php
/* @var $this UsuarioAprobacionController */
/* @var $model UsuarioAprobacion */

$this->breadcrumbs=array(
	'Usuario Aprobacions'=>array('index'),
	$model->ID_USUARIO_APROBACION,
);

$this->menu=array(
	array('label'=>'Ver UsuarioAprobacion', 'url'=>array('index')),
	array('label'=>'Crear UsuarioAprobacion', 'url'=>array('create')),
	array('label'=>'Actualizar UsuarioAprobacion', 'url'=>array('update', 'id'=>$model->ID_USUARIO_APROBACION)),
	array('label'=>'Borrar UsuarioAprobacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_USUARIO_APROBACION),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar UsuarioAprobacion', 'url'=>array('admin')),
);
?>

<h1> UsuarioAprobacion #<?php echo $model->ID_USUARIO_APROBACION; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_USUARIO_APROBACION',
		'ID_USUARIO',
		'ID_NIVEL_APROB',
	),
)); ?>
