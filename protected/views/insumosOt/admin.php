<?php
/* @var $this InsumosOtController */
/* @var $model InsumosOt */

$this->breadcrumbs=array(
	'Insumos Ots'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Ver InsumosOt', 'url'=>array('index')),
	array('label'=>'Crear InsumosOt', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->JDP()||Yii::app()->user->ADM()),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#insumos-ot-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Insumos Ots</h1>

<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->
<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'insumos-ot-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID_OT',
		'NUMERO_SUB_ITEM',
		'NOMBRE_SUB_ITEM',
		'COSTO_CONTRATISTA',
		/*
		'COSTO_CONTRATISTA',
		'TOTAL_CONTRATISTA',
		'FACTURA',
		*/
		array('class'=>'CButtonColumn',
			'template'=>'{view}{update}{delete}',
			'buttons'=>array(
					'update' => array('visible'=> 'Yii::app()->user->A1()||Yii::app()->user->JP()||Yii::app()->user->SG()'),
					'delete' => array('visible'=> 'Yii::app()->user->A1()||Yii::app()->user->JP()||Yii::app()->user->SG()'),
					),
		),
	),
)); ?>
