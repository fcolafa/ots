<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->NOMBRE_USUARIO=>array('view','id'=>$model->NOMBRE_USUARIO),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Usuario', 'url'=>array('index')),
	array('label'=>'Crear Usuario', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->SG()),
	array('label'=>'Ver Usuario', 'url'=>array('view', 'id'=>$model->NOMBRE_USUARIO)),
	array('label'=>'Administrar Usuarios', 'url'=>array('admin')),
);
?>

<h1>Modificar Usuario <?php echo $model->NOMBRE_USUARIO; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>