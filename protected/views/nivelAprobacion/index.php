<?php
/* @var $this NivelAprobacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Nivel Aprobacions',
);

$this->menu=array(
	array('label'=>'Crear NivelAprobacion', 'url'=>array('create')),
	array('label'=>'Administrar NivelAprobacion', 'url'=>array('admin')),
);
?>

<h1>Nivel Aprobacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
