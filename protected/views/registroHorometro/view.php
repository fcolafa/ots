<?php
/* @var $this RegistroHorometroController */
/* @var $model RegistroHorometro */

$this->breadcrumbs=array(
	'Registro Horometros'=>array('index'),
	$model->ID_REGISTRO_HOROM,
);

$this->menu=array(
	array('label'=>'Ver RegistroHorometro', 'url'=>array('index')),
	array('label'=>'Crear RegistroHorometro', 'url'=>array('create')),
	array('label'=>'Actualizar RegistroHorometro', 'url'=>array('update', 'id'=>$model->ID_REGISTRO_HOROM)),
	array('label'=>'Borrar RegistroHorometro', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_REGISTRO_HOROM),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar RegistroHorometro', 'url'=>array('admin')),
);
?>

<h1> RegistroHorometro #<?php echo $model->ID_REGISTRO_HOROM; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_REGISTRO_HOROM',
		'ID_EQUIPO',
		'FECHA_REGISTRO',
		'HOROMETRO',
		'ID_USUARIO',
		'OBSERVACION',
	),
)); ?>
