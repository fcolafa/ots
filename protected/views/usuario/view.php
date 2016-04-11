<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->NOMBRE_USUARIO,
);

$this->menu=array(
	array('label'=>'Ver Usuario', 'url'=>array('index')),
	array('label'=>'Crear Usuario', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->SG()),
	array('label'=>'Actualizar Usuario', 'url'=>array('update', 'id'=>$model->NOMBRE_USUARIO), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->SG()),
	array('label'=>'Borrar Usuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->NOMBRE_USUARIO),'confirm'=>'¿Está usted seguro que desea eliminar del sistema este elemento?'), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->SG()),
	array('label'=>'Administrar Usuarios', 'url'=>array('admin')),
);
?>

<h1> Usuario #<?php echo $model->NOMBRE_USUARIO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'NOMBRE_USUARIO',
		'COD_TIPO_USUARIO',
		'RUT_USUARIO',
		'NOMBRE_PERSONA',
		'APELLIDO_PERSONA',
	),
)); ?>
