<?php
/* @var $this InsumosOtController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Insumos Ots',
);

$this->menu=array(
	array('label'=>'Crear InsumosOt', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->JP()||Yii::app()->user->SG()),
	array('label'=>'Administrar InsumosOt', 'url'=>array('admin')),
);
?>

<h1>Insumos Ots</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
