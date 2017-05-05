<?php
/* @var $this RegistroMantencionController */
/* @var $model RegistroMantencion */

$this->breadcrumbs=array(
	'Registro Mantencions'=>array('index'),
	$model->ID_REGISTRO,
);

$this->menu=array(
	array('label'=>'Ver RegistroMantencion', 'url'=>array('index')),
	array('label'=>'Crear RegistroMantencion', 'url'=>array('create')),
	array('label'=>'Actualizar RegistroMantencion', 'url'=>array('update', 'id'=>$model->ID_REGISTRO)),
	array('label'=>'Borrar RegistroMantencion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_REGISTRO),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar RegistroMantencion', 'url'=>array('admin')),
);
?>

<h1> RegistroMantencion #<?php echo $model->ID_REGISTRO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_REGISTRO',
		'ID_EQUIPO',
		'FECHA_REGISTRO',
		'REGISTRO_MARCADO',
		'COMENTARIO_REGISTRO',
	),
)); ?>
