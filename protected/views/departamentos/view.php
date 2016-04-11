<?php
/* @var $this DepartamentosController */
/* @var $model Departamentos */

$this->breadcrumbs=array(
	'Departamentos'=>array('index'),
	$model->NOMBRE_DEPARTAMENTO,
);

$this->menu=array(
	array('label'=>'Ver Departamentos', 'url'=>array('index')),
	array('label'=>'Crear Departamento', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->JA()||Yii::app()->user->SG()),
	array('label'=>'Actualizar Departamento', 'url'=>array('update', 'id'=>$model->ID_DEPARTAMENTO), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->JA()||Yii::app()->user->SG()),
	array('label'=>'Borrar Departamento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_DEPARTAMENTO),'confirm'=>'¿Está usted seguro que desea eliminar del sistema este elemento?'), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->JA()||Yii::app()->user->SG()),
	array('label'=>'Administrar Departamentos', 'url'=>array('admin')),
);
?>
<h2 class="text-center">Departamentos "<?php echo $model->NOMBRE_DEPARTAMENTO; ?>"</h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'NOMBRE_DEPARTAMENTO',
		'DESCRIPCION_DEPARTAMENTO',
	),
)); ?>
