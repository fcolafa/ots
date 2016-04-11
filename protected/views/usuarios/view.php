<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

$this->breadcrumbs=array(
	'Usuarioses'=>array('index'),
	$model->ID_USUARIO,
);

$this->menu=array(
	array('label'=>'Ver Usuarios', 'url'=>array('index')),
	array('label'=>'Crear Usuarios', 'url'=>array('create')),
	array('label'=>'Actualizar Usuarios', 'url'=>array('update', 'id'=>$model->ID_USUARIO)),
	array('label'=>'Borrar Usuarios', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_USUARIO),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar Usuarios', 'url'=>array('admin')),
);
?>

<h1> Usuarios #<?php echo $model->ID_USUARIO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_USUARIO',
		'NOMBRE_USUARIO',
		'CONTRASENA',
		'COD_TIPO_USUARIO',
		'ID_PERSONA',
	),
)); ?>
