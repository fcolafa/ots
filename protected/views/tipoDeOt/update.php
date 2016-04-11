<?php
/* @var $this TipoDeOtController */
/* @var $model TipoDeOt */

$this->breadcrumbs=array(
	'Ordenes de Trabajo'=>array('ot/admin'),
	'Tipos de OT'=>array('admin'),
	$model->ID_TIPO_OT=>array('view','id'=>$model->ID_TIPO_OT),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Tipos de OT', 'url'=>array('index')),
	array('label'=>'Crear Tipo de OT', 'url'=>array('create'),'visible'=>Yii::app()->user->A1()),
	array('label'=>'Ver Tipos de OT', 'url'=>array('view', 'id'=>$model->ID_TIPO_OT)),
	array('label'=>'Administrar Tipos de OT', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Modificar Tipo de OT "<?php echo $model->NOMBRE_TIPO_OT; ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>