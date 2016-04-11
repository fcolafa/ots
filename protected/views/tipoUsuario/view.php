<?php
/* @var $this TipoUsuarioController */
/* @var $model TipoUsuario */

$this->breadcrumbs=array(
	'Tipo Usuarios'=>array('index'),
	$model->COD_TIPO_USUARIO,
);

$this->menu=array(
	array('label'=>'Ver Tipo Usuario', 'url'=>array('index')),
	array('label'=>'Crear Tipo Usuario', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()),
	array('label'=>'Actualizar Tipo Usuario', 'url'=>array('update', 'id'=>$model->COD_TIPO_USUARIO), 'visible'=>Yii::app()->user->A1()),
	array('label'=>'Borrar Tipo Usuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->COD_TIPO_USUARIO),'confirm'=>'¿Está usted seguro que desea eliminar del sistema este elemento?'), 'visible'=>Yii::app()->user->A1()),
	array('label'=>'Administrar Tipo Usuario', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Tipo Usuario #<?php echo $model->COD_TIPO_USUARIO; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'COD_TIPO_USUARIO',
		'NOMBRE_TIPO_USUARIO',
		'DESCRIPCION_TIPO_USUARIO',
	),
)); ?>
