<?php
/* @var $this NivelAprobacionController */
/* @var $model NivelAprobacion */

$this->breadcrumbs=array(
	'Nivel Aprobacions'=>array('index'),
	$model->ID_NIVEL_APROB,
);

$this->menu=array(
	array('label'=>'Ver NivelAprobacion', 'url'=>array('index')),
	array('label'=>'Crear NivelAprobacion', 'url'=>array('create')),
	array('label'=>'Actualizar NivelAprobacion', 'url'=>array('update', 'id'=>$model->ID_NIVEL_APROB)),
	array('label'=>'Borrar NivelAprobacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_NIVEL_APROB),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar NivelAprobacion', 'url'=>array('admin')),
);
?>

<h1> NivelAprobacion #<?php echo $model->ID_NIVEL_APROB; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_NIVEL_APROB',
		'ID_TIPO_DOC',
		'NOMBRE_NIVEL',
		'NIVEL_APROB',
		'MONTO_APROB',
	),
)); ?>
