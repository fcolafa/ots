<?php
/* @var $this InsumosOtController */
/* @var $model InsumosOt */

$this->breadcrumbs=array(
	'Insumos Ots'=>array('index'),
	$model->ID_INSUMOS_OT=>array('view','id'=>$model->ID_INSUMOS_OT),
	'Modificar',
);

$this->menu=array(
	array('label'=>' InsumosOt', 'url'=>array('index')),
	//array('label'=>'Crear InsumosOt', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->JDP()||Yii::app()->user->SG()),
	array('label'=>'Ver InsumosOt', 'url'=>array('view', 'id'=>$model->ID_INSUMOS_OT)),
	array('label'=>'Administrar InsumosOt', 'url'=>array('admin')),
);
?>

<h1>Modificar Insumo Orden de Trabajo <?php echo $model->ID_INSUMOS_OT; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>