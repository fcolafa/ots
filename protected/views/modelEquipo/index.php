<?php
/* @var $this ModelEquipoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Model Equipos',
);

$this->menu=array(
	array('label'=>'Crear ModelEquipo', 'url'=>array('create')),
	array('label'=>'Administrar ModelEquipo', 'url'=>array('admin')),
);
?>

<h1>Model Equipos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
