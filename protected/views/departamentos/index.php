<?php
/* @var $this DepartamentosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Departamentos',
);

$this->menu=array(
	array('label'=>'Crear Departamento', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->JA()||Yii::app()->user->SG()),
	array('label'=>'Administrar Departamentos', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Departamentos</h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
