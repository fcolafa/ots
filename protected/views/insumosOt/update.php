<?php
/* @var $this InsumosOtController */
/* @var $model InsumosOt */

$this->breadcrumbs=array(
	'Insumos Ots'=>array('index'),
	$model->ID_INSUMOS_OT=>array('view','id'=>$model->ID_INSUMOS_OT),
	'Modificar',
);

$this->menu=array(
	array('label'=>' Volver a la OT', 'url'=>array('ordenTrabajo/update','id'=>$model->ID_OT)),
	//array('label'=>'Crear InsumosOt', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->JDP()||Yii::app()->user->SG()),
	//array('label'=>'Ver InsumosOt', 'url'=>array('view', 'id'=>$model->ID_INSUMOS_OT)),
	//array('label'=>'Administrar InsumosOt', 'url'=>array('admin')),
    
);
?>

<h1>Modificar InsumosOt <?php echo $model->ID_INSUMOS_OT; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>