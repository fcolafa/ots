<?php
/* @var $this TipoDeOtController */
/* @var $model TipoDeOt */

$this->breadcrumbs=array(
	'Ordenes de Trabajo'=>array('ot/admin'),
	'Tipos de OT'=>array('admin'),
	$model->NOMBRE_TIPO_OT,
);

$this->menu=array(
	array('label'=>'Ver Tipos de OT', 'url'=>array('index')),
	array('label'=>'Crear Tipo de OT', 'url'=>array('create'),'visible'=>Yii::app()->user->A1()),
	array('label'=>'Actualizar Tipo de OT', 'url'=>array('update', 'id'=>$model->ID_TIPO_OT),'visible'=>Yii::app()->user->A1()),
	array('label'=>'Borrar Tipo de OT', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_TIPO_OT),'confirm'=>'¿Está usted seguro que desea eliminar del sistema este elemento?'),'visible'=>Yii::app()->user->A1()),
	array('label'=>'Administrar Tipos de OT', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Tipo de Orden de Trabajo "<?php echo $model->NOMBRE_TIPO_OT; ?>"</h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'NOMBRE_TIPO_OT',
		'DESCRIPCION_TIPO_OP',
	),
)); ?>
