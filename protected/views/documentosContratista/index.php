<?php
/* @var $this DocumentosContratistaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'DocumentosContratistas',
);

$this->menu=array(
	array('label'=>'Crear Documentos Contratista', 'url'=>array('create')),
	array('label'=>'Administrar Documentos Contratista', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Documentos Contratista</h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
