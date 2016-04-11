<?php
/* @var $this TipoUsuarioController */
/* @var $model TipoUsuario */

$this->breadcrumbs=array(
	'Tipo Usuarios'=>array('index'),
	$model->COD_TIPO_USUARIO=>array('view','id'=>$model->COD_TIPO_USUARIO),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Tipo Usuario', 'url'=>array('index')),
	array('label'=>'Crear Tipo Usuario', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()),
	array('label'=>'Ver Tipo Usuario', 'url'=>array('view', 'id'=>$model->COD_TIPO_USUARIO)),
	array('label'=>'Administrar Tipo Usuario', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Modificar Tipo Usuario <?php echo $model->COD_TIPO_USUARIO; ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>