<?php
/* @var $this RegistroMantencionController */
/* @var $model RegistroMantencion */

$this->breadcrumbs=array(
	'Registro Mantencions'=>array('index'),
	$model->ID_REGISTRO=>array('view','id'=>$model->ID_REGISTRO),
	'Modificar',
);

$this->menu=array(
	array('label'=>' RegistroMantencion', 'url'=>array('index')),
	array('label'=>'Crear RegistroMantencion', 'url'=>array('create')),
	array('label'=>'Ver RegistroMantencion', 'url'=>array('view', 'id'=>$model->ID_REGISTRO)),
	array('label'=>'Administrar RegistroMantencion', 'url'=>array('admin')),
);
?>

<h1>Modificar RegistroMantencion <?php echo $model->ID_REGISTRO; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>