<?php
/* @var $this PiezasEquiposController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Piezas Equiposes',
);

$this->menu=array(
	array('label'=>'Crear PiezasEquipos', 'url'=>array('create')),
	array('label'=>'Administrar PiezasEquipos', 'url'=>array('admin')),
);
?>

<h1>Piezas Equiposes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
