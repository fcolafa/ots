<?php
/* @var $this RegistroMantencionController */
/* @var $model RegistroMantencion */

$this->breadcrumbs=array(
	'Registro Mantenciones'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Crear Equipos', 'url'=>array('create')),
	array('label'=>'Ver Equipos', 'url'=>array('admin')),
  	array('label'=>'Registrar Horómetros', 'url'=>array('registroHorometro/create')),
);
?>

<h2 class="text-center">Crear Registro de Mantenciones</h2>

<?php $this->renderPartial('_masive', array('model'=>$model, 'model_equipos'=>$model_equipos)); ?>