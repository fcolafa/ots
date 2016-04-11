<?php
/* @var $this UsuarioAprobacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usuario Aprobacions',
);

$this->menu=array(
	array('label'=>'Crear UsuarioAprobacion', 'url'=>array('create')),
	array('label'=>'Administrar UsuarioAprobacion', 'url'=>array('admin')),
);
?>

<h1>Usuario Aprobacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
