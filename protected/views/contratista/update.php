<?php
/* @var $this ContratistaController */
/* @var $model Contratista */

$this->breadcrumbs=array(
	'Contratistas'=>array('admin'),
	$model->ID_CONTRATISTA=>array('view','id'=>$model->ID_CONTRATISTA),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Contratista', 'url'=>array('index')),
	array('label'=>'Crear Contratista', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()),
	array('label'=>'Ver Contratistas', 'url'=>array('view', 'id'=>$model->ID_CONTRATISTA)),
	array('label'=>'Administrar Contratistas', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Modificar Contratista "<?php echo $model->NOMBRE_CONTRATISTA;?>"</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>