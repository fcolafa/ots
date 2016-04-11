<?php
/* @var $this CargosController */
/* @var $model Cargos */

$this->breadcrumbs=array(
	'Cargoses'=>array('index'),
	$model->ID_CARGO,
);

$this->menu=array(
	array('label'=>'Ver Cargos', 'url'=>array('index')),
	array('label'=>'Crear Cargos', 'url'=>array('create')),
	array('label'=>'Actualizar Cargos', 'url'=>array('update', 'id'=>$model->ID_CARGO)),
	array('label'=>'Borrar Cargos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_CARGO),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar Cargos', 'url'=>array('admin')),
);
?>
<h2 class="text-center">Cargos #<?php echo $model->ID_CARGO; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_CARGO',
		array(
			'name'=>'ID_EMPRESA',
			'value'=>$model->iDEMPRESA->NOMBRE_EMPRESA,
		 ),
		array(
			'name'=>'DEPENDENCIA_CARGO',
			'value'=>@$model->cargos2->NOMBRE_CARGO,
		 ),
		'NOMBRE_CARGO',
		'DESCRIPCION_CARGO',
	),
)); ?>
