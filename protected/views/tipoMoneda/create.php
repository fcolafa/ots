<?php
/* @var $this TipoMonedaController */
/* @var $model TipoMoneda */

$this->breadcrumbs=array(
	'Tipo Monedas'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver TipoMoneda', 'url'=>array('index')),
	array('label'=>'Administrar TipoMoneda', 'url'=>array('admin')),
);
?>

<h1>Crear TipoMoneda</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>