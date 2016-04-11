<?php
/* @var $this CentroDeCostosController */
/* @var $model CentroDeCostos */

$this->breadcrumbs=array(
	'Centro De Costoses'=>array('index'),
	$model->ID_CENTRO_COSTO=>array('view','id'=>$model->ID_CENTRO_COSTO),
	'Modificar',
);

$this->menu=array(
	array('label'=>' Centro De Costos', 'url'=>array('index')),
	array('label'=>'Crear Centro De Costos', 'url'=>array('create')),
	array('label'=>'Ver Centro De Costos', 'url'=>array('view', 'id'=>$model->ID_CENTRO_COSTO)),
	array('label'=>'Administrar Centro De Costos', 'url'=>array('admin')),
);
?>

<h2 class="text-center"> Modificar Centro De Costos <?php echo $model->ID_CENTRO_COSTO; ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>