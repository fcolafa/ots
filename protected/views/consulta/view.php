<?php
/* @var $this ConsultaController */
/* @var $model Consulta */

$this->breadcrumbs=array(
	'Consultas'=>array('index'),
	$model->ID_CONSULTA,
);

$this->menu=array(
	array('label'=>'Ver Consulta', 'url'=>array('index')),
	array('label'=>'Crear Consulta', 'url'=>array('create')),
	array('label'=>'Actualizar Consulta', 'url'=>array('update', 'id'=>$model->ID_CONSULTA)),
	array('label'=>'Borrar Consulta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_CONSULTA),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar Consulta', 'url'=>array('admin')),
);
?>

<h1> Consulta #<?php echo $model->ID_CONSULTA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_CONSULTA',
		'CONSULTA',
		'FECHA_CONSULTA',
		'TIPO_MENSAJE',
		'ID_PERSONA',
		'ID_OT',
		'ID_CONSULTADO',
	),
)); ?>
