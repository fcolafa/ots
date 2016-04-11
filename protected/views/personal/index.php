<?php
/* @var $this PersonalController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Personals',
);

$this->menu=array(
	array('label'=>'Crear Personal', 'url'=>array('create')),
	array('label'=>'Administrar Personal', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Personal</h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
