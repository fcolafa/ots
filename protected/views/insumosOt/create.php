<?php
/* @var $this InsumosOtController */
/* @var $model InsumosOt */

$this->breadcrumbs=array(
	'Insumos Ots'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver InsumosOt', 'url'=>array('index')),
	array('label'=>'Administrar InsumosOt', 'url'=>array('admin')),
);
?>

<h1>Crear InsumosOt</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>