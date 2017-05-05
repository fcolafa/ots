<?php
/* @var $this MarcaEquipoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Marca Equipos',
);

$this->menu=array(
	array('label'=>'Crear MarcaEquipo', 'url'=>array('create')),
	array('label'=>'Administrar MarcaEquipo', 'url'=>array('admin')),
);
?>

<h1>Marca Equipos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
