<?php
/* @var $this CentroDeCostosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Centro De Costoses',
);

$this->menu=array(
	array('label'=>'Crear Centro De Costos', 'url'=>array('create')),
	array('label'=>'Administrar Centro De Costos', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Centro De Costos</h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
