<?php
/* @var $this RegistroHorometroController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Registro Horometros',
);

$this->menu=array(
	array('label'=>'Crear RegistroHorometro', 'url'=>array('create')),
	array('label'=>'Administrar RegistroHorometro', 'url'=>array('admin')),
);
?>

<h1>Registro Horometros</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
