<?php
/* @var $this ModelEquipoController */
/* @var $model ModelEquipo */

$this->breadcrumbs=array(
	'Model Equipos'=>array('index'),
	$model->ID_MODELO_EQUIPO,
);

$this->menu=array(
	array('label'=>'Ver ModelEquipo', 'url'=>array('index')),
	array('label'=>'Crear ModelEquipo', 'url'=>array('create')),
	array('label'=>'Actualizar ModelEquipo', 'url'=>array('update', 'id'=>$model->ID_MODELO_EQUIPO)),
	array('label'=>'Borrar ModelEquipo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_MODELO_EQUIPO),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar ModelEquipo', 'url'=>array('admin')),
);
?>

<h1> ModelEquipo #<?php echo $model->ID_MODELO_EQUIPO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_MODELO_EQUIPO',
		'ID_MARCA_EQUIPO',
		'NOMBRE_MODELO_EQUIPO',
	),
)); ?>
