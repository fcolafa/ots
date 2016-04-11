<?php
/* @var $this DepartamentosController */
/* @var $model Departamentos */

$this->breadcrumbs=array(
	'Departamentos'=>array('index'),
	$model->ID_DEPARTAMENTO=>array('view','id'=>$model->ID_DEPARTAMENTO),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Departamentos', 'url'=>array('index')),
	array('label'=>'Crear Departamento', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->JA()||Yii::app()->user->SG()),
	array('label'=>'Ver Departamentos', 'url'=>array('view', 'id'=>$model->ID_DEPARTAMENTO)),
	array('label'=>'Administrar Departamentos', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Modificar Departamento <?php echo $model->NOMBRE_DEPARTAMENTO; ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>