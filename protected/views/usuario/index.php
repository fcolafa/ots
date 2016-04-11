<?php
/* @var $this UsuarioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usuarios',
);

$this->menu=array(
	array('label'=>'Crear Usuario', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->SG()),
	array('label'=>'Administrar Usuarios', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Usuarios</h2>

<?php $this->widget('zii.widgets.EColumnListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'columns'=>4,
)); ?>
