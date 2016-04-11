<?php
/* @var $this ContratistaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Contratistas',
);

$this->menu=array(
	array('label'=>'Crear Contratista', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()),
	array('label'=>'Administrar Contratistas', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Contratistas</h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
