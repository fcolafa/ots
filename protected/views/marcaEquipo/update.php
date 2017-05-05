<?php
/* @var $this MarcaEquipoController */
/* @var $model MarcaEquipo */

$this->breadcrumbs=array(
	'Marca Equipos'=>array('index'),
	$model->ID_MARCA_EQUIPO=>array('view','id'=>$model->ID_MARCA_EQUIPO),
	'Modificar',
);

$this->menu=array(
	array('label'=>' MarcaEquipo', 'url'=>array('index')),
	array('label'=>'Crear MarcaEquipo', 'url'=>array('create')),
	array('label'=>'Ver MarcaEquipo', 'url'=>array('view', 'id'=>$model->ID_MARCA_EQUIPO)),
	array('label'=>'Administrar MarcaEquipo', 'url'=>array('admin')),
);
?>

<h1>Modificar MarcaEquipo <?php echo $model->ID_MARCA_EQUIPO; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>