<?php
/* @var $this InsumosOtController */
/* @var $model InsumosOt */

$this->breadcrumbs=array(
	'Insumos Ots'=>array('index'),
	$model->ID_INSUMOS_OT,
);

$this->menu=array(
	array('label'=>'Ver InsumosOt', 'url'=>array('index')),
	array('label'=>'Crear InsumosOt', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->JP()||Yii::app()->user->SG()),
	array('label'=>'Actualizar InsumosOt', 'url'=>array('update', 'id'=>$model->ID_INSUMOS_OT), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->JP()||Yii::app()->user->SG()),
	array('label'=>'Borrar InsumosOt', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_INSUMOS_OT),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?'), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->JP()||Yii::app()->user->SG()),
	array('label'=>'Administrar InsumosOt', 'url'=>array('admin')),
);
?>

<h1> InsumosOt #<?php echo $model->ID_INSUMOS_OT; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_INSUMOS_OT',
		'ID_OT',
		'NUMERO_SUB_ITEM',
		'NOMBRE_SUB_ITEM',
		'COSTO_CONTRATISTA',
		'NRO_COTIZACION',
	),
)); ?>
