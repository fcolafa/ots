<?php
/* @var $this EspecifTecnicasController */
/* @var $model EspecifTecnicas */

$this->breadcrumbs=array(
	'Especif Tecnicases'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver EspecifTecnicas', 'url'=>array('index')),
	array('label'=>'Administrar EspecifTecnicas', 'url'=>array('admin')),
);
?>

<h1>Crear EspecifTecnicas</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>