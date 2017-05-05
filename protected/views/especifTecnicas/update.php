<?php
/* @var $this EspecifTecnicasController */
/* @var $model EspecifTecnicas */

$this->breadcrumbs=array(
	'Especif Tecnicases'=>array('index'),
	$model->ID_ESPEC_TECNICA=>array('view','id'=>$model->ID_ESPEC_TECNICA),
	'Modificar',
);

$this->menu=array(
	array('label'=>' EspecifTecnicas', 'url'=>array('index')),
	array('label'=>'Crear EspecifTecnicas', 'url'=>array('create')),
	array('label'=>'Ver EspecifTecnicas', 'url'=>array('view', 'id'=>$model->ID_ESPEC_TECNICA)),
	array('label'=>'Administrar EspecifTecnicas', 'url'=>array('admin')),
);
?>

<h1>Modificar EspecifTecnicas <?php echo $model->ID_ESPEC_TECNICA; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>