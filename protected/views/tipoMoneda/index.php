<?php
/* @var $this TipoMonedaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Monedas',
);

$this->menu=array(
	array('label'=>'Crear TipoMoneda', 'url'=>array('create')),
	array('label'=>'Administrar TipoMoneda', 'url'=>array('admin')),
);
?>

<h1>Tipo Monedas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
