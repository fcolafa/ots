<?php
/* @var $this CentroDeCostosController */
/* @var $model CentroDeCostos */

$this->breadcrumbs=array(
	'Centro De Costoses'=>array('index'),
	$model->ID_CENTRO_COSTO,
);

$this->menu=array(
	array('label'=>'Ver Centro De Costos', 'url'=>array('index')),
	array('label'=>'Crear Centro De Costos', 'url'=>array('create')),
	array('label'=>'Actualizar Centro De Costos', 'url'=>array('update', 'id'=>$model->ID_CENTRO_COSTO)),
	array('label'=>'Borrar Centro De Costos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_CENTRO_COSTO),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar CentroDeCostos', 'url'=>array('admin')),
);
?>

<h2 class="text-center"> Centro De Costos #<?php echo $model->ID_CENTRO_COSTO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_CENTRO_COSTO',
		array(
			'name'=>'ID_EMPRESA',
			'value'=>$model->iDEMPRESA->NOMBRE_EMPRESA,
		 ),
		'ID_CLIENTE',
		'NUMERO_CENTRO',
		'NOMBRE_CENTRO_COSTO',
		'DESCRIPCION_CENTRO_COSTO',
	),
)); ?>
