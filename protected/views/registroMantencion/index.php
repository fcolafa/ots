<?php
/* @var $this RegistroMantencionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Registro Mantencions',
);

$this->menu=array(
	array('label'=>'Crear RegistroMantencion', 'url'=>array('create')),
	array('label'=>'Administrar RegistroMantencion', 'url'=>array('admin')),
);
?>

<h1>Registro Mantencions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
