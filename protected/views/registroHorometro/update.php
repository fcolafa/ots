<?php
/* @var $this RegistroHorometroController */
/* @var $model RegistroHorometro */

$this->breadcrumbs=array(
	'Registro Horometros'=>array('index'),
	$model->ID_REGISTRO_HOROM=>array('view','id'=>$model->ID_REGISTRO_HOROM),
	'Modificar',
);

$this->menu=array(
	array('label'=>' RegistroHorometro', 'url'=>array('index')),
	array('label'=>'Crear RegistroHorometro', 'url'=>array('create')),
	array('label'=>'Ver RegistroHorometro', 'url'=>array('view', 'id'=>$model->ID_REGISTRO_HOROM)),
	array('label'=>'Administrar RegistroHorometro', 'url'=>array('admin')),
);
?>

<h1>Modificar RegistroHorometro <?php echo $model->ID_REGISTRO_HOROM; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>