<?php
/* @var $this RegistroHorometroController */
/* @var $model RegistroHorometro */

$this->breadcrumbs=array(
	'Registro Horometros'=>array('index'),
	'Crear',
);

$this->menu=array(

	array('label'=>'Crear Equipos', 'url'=>array('create')),
	array('label'=>'Ver Equipos', 'url'=>array('admin')),
	array('label'=>'Registrar Mantenciones', 'url'=>array('registroMantencion/create')),
);
?>

<h2 class="text-center">Crear Registro de Horómetros</h2>

<?php $this->renderPartial('_masive', array('model'=>$model, 'model_equipos'=>$model_equipos)); ?>