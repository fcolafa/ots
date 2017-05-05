<?php
/* @var $this MarcaEquipoController */
/* @var $model MarcaEquipo */

$this->breadcrumbs=array(
	'Marca Equipos'=>array('index'),
	$model->ID_MARCA_EQUIPO,
);

$this->menu=array(
	array('label'=>'Ver MarcaEquipo', 'url'=>array('index')),
	array('label'=>'Crear MarcaEquipo', 'url'=>array('create')),
	array('label'=>'Actualizar MarcaEquipo', 'url'=>array('update', 'id'=>$model->ID_MARCA_EQUIPO)),
	array('label'=>'Borrar MarcaEquipo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_MARCA_EQUIPO),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar MarcaEquipo', 'url'=>array('admin')),
);
?>

<h1> MarcaEquipo #<?php echo $model->ID_MARCA_EQUIPO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_MARCA_EQUIPO',
		'NOMBRE_MARCA_EQUIPO',
	),
)); ?>
