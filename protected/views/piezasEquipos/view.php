<?php
/* @var $this PiezasEquiposController */
/* @var $model PiezasEquipos */

$this->breadcrumbs=array(
	'Piezas Equiposes'=>array('index'),
	$model->ID_PIEZA,
);

$this->menu=array(
	array('label'=>'Ver PiezasEquipos', 'url'=>array('index')),
	array('label'=>'Crear PiezasEquipos', 'url'=>array('create')),
	array('label'=>'Actualizar PiezasEquipos', 'url'=>array('update', 'id'=>$model->ID_PIEZA)),
	array('label'=>'Borrar PiezasEquipos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_PIEZA),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar PiezasEquipos', 'url'=>array('admin')),
);
?>

<h1> PiezasEquipos #<?php echo $model->ID_PIEZA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_PIEZA',
		'ID_EQUIPO',
		'NOMBRE_PIEZA',
		'IMAGEN_PIEZA',
	),
)); ?>
