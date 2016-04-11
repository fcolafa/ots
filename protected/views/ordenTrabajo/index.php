<?php
/* @var $this OrdenTrabajoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Orden Trabajos',
);

$this->menu=array(
	array('label'=>'Crear OrdenTrabajo', 'url'=>array('create')),
	array('label'=>'Administrar OrdenTrabajo', 'url'=>array('admin')),
);
?>

<h1>Orden Trabajos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
