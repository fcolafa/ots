<?php
/* @var $this CargosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cargoses',
);

$this->menu=array(
	array('label'=>'Crear Cargos', 'url'=>array('create')),
	array('label'=>'Administrar Cargos', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Cargos</h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
