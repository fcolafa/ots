<?php
/* @var $this PersonalController */
/* @var $model Personal */

$this->breadcrumbs=array(
	//'Personals'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Ver Personal', 'url'=>array('index')),
	array('label'=>'Administrar Personal', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Crear Personal</h2>

<?php $this->renderPartial('_form', array('model'=>$model, 'usuario'=>$usuario,'aprovacion'=>$aprovacion)); ?>