<?php
/* @var $this ContratistaController */
/* @var $model Contratista */

$this->breadcrumbs=array(
	'Contratistas'=>array('admin'),
	$model->NOMBRE_CONTRATISTA,
);

$this->menu=array(
	//array('label'=>'Ver Contratista', 'url'=>array('index')),
	array('label'=>'Crear Contratista', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()),
	array('label'=>'Actualizar Contratista', 'url'=>array('update', 'id'=>$model->ID_CONTRATISTA), 'visible'=>Yii::app()->user->A1()),
	array('label'=>'Borrar Contratista', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_CONTRATISTA),'confirm'=>'¿Está usted seguro que desea eliminar del sistema este elemento?'), 'visible'=>Yii::app()->user->A1()),
	array('label'=>'Administrar Contratistas', 'url'=>array('admin')),
);
?>

<h2 class="text-center"> Contratista "<?php echo $model->NOMBRE_CONTRATISTA; ?>"</h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'label'=>'Rut',
			'value' =>$model->RUT_CONTRATISTA,             
			),
		'DIRECCION_CONTRATISTA',
		'CIUDAD_CONTRATISTA',
		'TELEFONO_CONTRATISTA',
		'GIRO_AREA',
		'ENCARGADO',
		array(
			'label'=>'Estado',
			'value' => $model->AUTORIZADO==0? "No Autorizado":"Autorizado",
			),
	),
)); ?>
