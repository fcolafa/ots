<?php
/* @var $this PersonalController */
/* @var $model Personal */

$this->breadcrumbs=array(
	//'Personals'=>array('index'),
	$model->ID_PERSONA=>array('view','id'=>$model->ID_PERSONA),
	'Modificar',
);

$this->menu=array(
	//array('label'=>' Personal', 'url'=>array('index')),
	//array('label'=>'Crear Personal', 'url'=>array('create')),
	array('label'=>'Ver Personal', 'url'=>array('viewPersonal', 'id'=>$model->ID_PERSONA)),
	//array('label'=>'Administrar Personal', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Modificar Datos <?php echo $model->NOMBRE_PERSONA; ?></h2>

<?php $this->renderPartial('_formPersonal', array('model'=>$model,'usuario'=>$usuario)); ?>