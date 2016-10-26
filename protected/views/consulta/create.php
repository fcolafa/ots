<?php
/* @var $this ConsultaController */
/* @var $model Consulta */

$this->breadcrumbs=array(
	'Consultas'=>array('index'),
	'Crear',
);
$this->menu=array(
	array('label'=>'Volver',  'url'=>array('ordenTrabajo/view', 'id'=>$id)),
);
?>

<h1>Crear Consulta</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>