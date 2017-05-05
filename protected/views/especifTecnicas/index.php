<?php
/* @var $this EspecifTecnicasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Especif Tecnicases',
);

$this->menu=array(
	array('label'=>'Crear EspecifTecnicas', 'url'=>array('create')),
	array('label'=>'Administrar EspecifTecnicas', 'url'=>array('admin')),
);
?>

<h1>Especif Tecnicases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
