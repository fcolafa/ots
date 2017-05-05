<?php
/* @var $this PiezasEquiposController */
/* @var $model PiezasEquipos */

$this->breadcrumbs=array(
	'Piezas Equiposes'=>array('index'),
	$model->ID_PIEZA=>array('view','id'=>$model->ID_PIEZA),
	'Modificar',
);

$this->menu=array(
	array('label'=>' PiezasEquipos', 'url'=>array('index')),
	array('label'=>'Crear PiezasEquipos', 'url'=>array('create')),
	array('label'=>'Ver PiezasEquipos', 'url'=>array('view', 'id'=>$model->ID_PIEZA)),
	array('label'=>'Administrar PiezasEquipos', 'url'=>array('admin')),
);
?>

<h1>Modificar PiezasEquipos <?php echo $model->ID_PIEZA; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>