<?php
/* @var $this TipoDeOtController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ordenes de Trabajo'=>array('ot/admin'),
	'Tipos de OT'=>array('admin'),
	'Listado',
);

$this->menu=array(
	array('label'=>'Crear Tipo de OT', 'url'=>array('create'),'visible'=>Yii::app()->user->A1()),
	array('label'=>'Administrar Tipos de OT', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Tipos de Orden de Trabajo</h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
