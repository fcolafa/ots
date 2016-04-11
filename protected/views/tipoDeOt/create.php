<?php
/* @var $this TipoDeOtController */
/* @var $model TipoDeOt */

$this->breadcrumbs=array(
	'Ordenes de Trabajo'=>array('ot/admin'),
	'Tipos de OT'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver Tipos de OT', 'url'=>array('index')),
	array('label'=>'Administrar Tipos de OT', 'url'=>array('admin')),
);
?>
<h2 class="text-center">Crear Tipo de Orden de Trabajo</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>