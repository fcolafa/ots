<?php
/* @var $this RecepciondocumentosController */
/* @var $model Recepciondocumentos */

$this->breadcrumbs=array(
	'Recepciondocumentoses'=>array('index'),
);

/*$this->menu=array(
	array('label'=>'Ver Recepciondocumentos', 'url'=>array('index')),
	array('label'=>'Crear Recepciondocumentos', 'url'=>array('create')),
	array('label'=>'Actualizar Recepciondocumentos', 'url'=>array('update', 'id'=>$model->ID_RECEPCION)),
	array('label'=>'Borrar Recepciondocumentos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_RECEPCION),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar Recepciondocumentos', 'url'=>array('admin')),
);*/
?>

<h3> Recepcion Documentos Contratista : <?php  echo $model->NOMBRE_CONTRATISTA; ?></h3>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'recepciondocumentos-grid',
	'dataProvider'=>$contratista,
	//'filter'=>$contratista,
	'columns'=>array(
		'ID_RECEPCION',
		'FECHA_RECEPCION',
		array('name'=>'contratista','value'=>'$data->iDCONTRATISTAS->NOMBRE_CONTRATISTA'),
		//'ID_CONTRATISTA',
		array('name'=>'documento','value'=>'$data->iDDOCUMENTOS->NOMBRE_DOCUMENTO'),
		//'ID_DOCUMENTO',
		array('name'=>'documento','value'=>$data->ESTADO==0?"Pendiente":"Entregado"),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<!--<?php /*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_RECEPCION',
		'FECHA_RECEPCION',
		'ESTADO',
		'ID_CONTRATISTA',
		'ID_DOCUMENTO',
	),
)); */?>-->
