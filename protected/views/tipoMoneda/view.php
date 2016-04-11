<?php
/* @var $this TipoMonedaController */
/* @var $model TipoMoneda */

$this->breadcrumbs=array(
	'Tipo Monedas'=>array('index'),
	$model->ID_TIPO_MONEDA,
);

$this->menu=array(
	array('label'=>'Ver TipoMoneda', 'url'=>array('index')),
	array('label'=>'Crear TipoMoneda', 'url'=>array('create')),
	array('label'=>'Actualizar TipoMoneda', 'url'=>array('update', 'id'=>$model->ID_TIPO_MONEDA)),
	array('label'=>'Borrar TipoMoneda', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_TIPO_MONEDA),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar TipoMoneda', 'url'=>array('admin')),
);
?>

<h1> TipoMoneda #<?php echo $model->ID_TIPO_MONEDA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_TIPO_MONEDA',
		'TIPO_MONEDA',
	),
)); ?>
