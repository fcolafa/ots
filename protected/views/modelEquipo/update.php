<?php
/* @var $this ModelEquipoController */
/* @var $model ModelEquipo */

$this->breadcrumbs=array(
	'Model Equipos'=>array('index'),
	$model->ID_MODELO_EQUIPO=>array('view','id'=>$model->ID_MODELO_EQUIPO),
	'Modificar',
);

$this->menu=array(
	array('label'=>' ModelEquipo', 'url'=>array('index')),
	array('label'=>'Crear ModelEquipo', 'url'=>array('create')),
	array('label'=>'Ver ModelEquipo', 'url'=>array('view', 'id'=>$model->ID_MODELO_EQUIPO)),
	array('label'=>'Administrar ModelEquipo', 'url'=>array('admin')),
);
?>

<h1>Modificar ModelEquipo <?php echo $model->ID_MODELO_EQUIPO; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>