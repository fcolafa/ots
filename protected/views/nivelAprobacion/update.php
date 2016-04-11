<?php
/* @var $this NivelAprobacionController */
/* @var $model NivelAprobacion */

$this->breadcrumbs=array(
	'Nivel Aprobacions'=>array('index'),
	$model->ID_NIVEL_APROB=>array('view','id'=>$model->ID_NIVEL_APROB),
	'Modificar',
);

$this->menu=array(
	array('label'=>' NivelAprobacion', 'url'=>array('index')),
	array('label'=>'Crear NivelAprobacion', 'url'=>array('create')),
	array('label'=>'Ver NivelAprobacion', 'url'=>array('view', 'id'=>$model->ID_NIVEL_APROB)),
	array('label'=>'Administrar NivelAprobacion', 'url'=>array('admin')),
);
?>

<h1>Modificar NivelAprobacion <?php echo $model->ID_NIVEL_APROB; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>