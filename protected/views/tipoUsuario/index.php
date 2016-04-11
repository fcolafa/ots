<?php
/* @var $this TipoUsuarioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Usuarios',
);

$this->menu=array(
	array('label'=>'Crear Tipo Usuario', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()),
	array('label'=>'Administrar Tipo Usuario', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Tipos de Usuarios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
