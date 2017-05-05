<?php
/* @var $this EquipoController */
/* @var $model Equipo */

$this->breadcrumbs=array(
	'Equipos'=>array('index'),
	$model->ID_EQUIPO,
);

$this->menu=array(
	array('label'=>'Ver Equipo', 'url'=>array('index')),
	array('label'=>'Crear Equipo', 'url'=>array('create')),
	array('label'=>'Actualizar Equipo', 'url'=>array('update', 'id'=>$model->ID_EQUIPO)),
	array('label'=>'Borrar Equipo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_EQUIPO),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar Equipo', 'url'=>array('admin')),
);
?>

<h1> Equipo #<?php echo $model->ID_EQUIPO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_EQUIPO',
		'TAG_EQUIPO',
		'ID_TIPO_EQUIPO',
		'NOMBRE_EQUIPO',
		'ID_MODELO_EQUIPO',
		'TIEMPO_MANTENCION',
		'YEAR_EQUIPO',
		'NUMERO_EQUIPO',
		'UBICACION_EQUIPO',
		'CAPACIDAD',
		'FECHA_ADQUISICION',
		'FECHA_EMPRESA',
		'IMAGEN_EQUIPO',
		'ESTADO_EQUIPO',
	),
)); ?>
