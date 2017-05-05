<?php
/* @var $this EspecifTecnicasController */
/* @var $model EspecifTecnicas */

$this->breadcrumbs=array(
	'Especif Tecnicases'=>array('index'),
	$model->ID_ESPEC_TECNICA,
);

$this->menu=array(
	array('label'=>'Ver EspecifTecnicas', 'url'=>array('index')),
	array('label'=>'Crear EspecifTecnicas', 'url'=>array('create')),
	array('label'=>'Actualizar EspecifTecnicas', 'url'=>array('update', 'id'=>$model->ID_ESPEC_TECNICA)),
	array('label'=>'Borrar EspecifTecnicas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_ESPEC_TECNICA),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar EspecifTecnicas', 'url'=>array('admin')),
);
?>

<h1> EspecifTecnicas #<?php echo $model->ID_ESPEC_TECNICA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_ESPEC_TECNICA',
		'ID_EQUIPO',
		'ID_PIEZA',
		'CARACTERISTICA',
		'DESCRIPCION',
	),
)); ?>
