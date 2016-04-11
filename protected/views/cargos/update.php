<?php
/* @var $this CargosController */
/* @var $model Cargos */

$this->breadcrumbs=array(
	'Cargoses'=>array('index'),
	$model->ID_CARGO=>array('view','id'=>$model->ID_CARGO),
	'Modificar',
);

$this->menu=array(
	array('label'=>' Cargos', 'url'=>array('index')),
	array('label'=>'Crear Cargos', 'url'=>array('create')),
	array('label'=>'Ver Cargos', 'url'=>array('view', 'id'=>$model->ID_CARGO)),
	array('label'=>'Administrar Cargos', 'url'=>array('admin')),
);
?>
<h2 class="text-center">Modificar Cargos <?php echo $model->ID_CARGO; ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>