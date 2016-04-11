<?php
/* @var $this TipoDeOtController */
/* @var $model TipoDeOt */

$this->breadcrumbs=array(
	'Ordenes de Trabajo'=>array('ot/admin'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Ver Tipos de OT', 'url'=>array('index')),
	array('label'=>'Crear Tipo de OT', 'url'=>array('create'),'visible'=>Yii::app()->user->A1()),
);
?>

<h2 class="text-center">Administrar Tipos de Orden de Trabajo</h2>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<div class = "span8 offset2">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'tipo-de-ot-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			//'ID_TIPO_OT',
			array(
				'name'=>'NOMBRE_TIPO_OT',
				),
			array(
				'name'=>'DESCRIPCION_TIPO_OP',
				),
			
			array(
					'class'=>'CButtonColumn',
					'header'=>'Opciones',
					'template'=>'{view}{update}',
					'buttons'=>array(
							'update' => array('visible'=> 'Yii::app()->user->A1()'),
							),
			),
		),
	)); ?>
</div>