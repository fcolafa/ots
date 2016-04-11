<?php
/* @var $this RecepciondocumentosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Recepciondocumentos',
);

$this->menu=array(
	array('label'=>'Crear Recepciondocumentos', 'url'=>array('create')),
	array('label'=>'Administrar Recepciondocumentos', 'url'=>array('admin')),
);
?>

<h1>Recepcion Documentos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
