<?php
/* @var $this CentroDeCostosController */
/* @var $model CentroDeCostos */

$this->breadcrumbs=array(
	'Centro De Costoses'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Ver Centros De Costos', 'url'=>array('index')),
	array('label'=>'Crear Centro De Costos', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#centro-de-costos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h2 class="text-center">Administrar Centros de Costos</h2>

<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->

<div class="search-form" style="display:none">
<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'centro-de-costos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(

		array(	'header'=>'Nombre',
						'name'=>'NOMBRE_CENTRO_COSTO',
						'htmlOptions'=>array('width' =>	'25%'),
			),
		array(	'header'=>'Numero',
						'name'=>'NUMERO_CENTRO',
						'htmlOptions'=>array('width' =>	'15%'),
			),
		array(
						'name' => 'ID_EMPRESA',
						'value' => '$data->iDEMPRESA->NOMBRE_EMPRESA',
			            'header'=>'Empresa',
			            'htmlOptions'=>array('width' =>	'25%'),
			            'filter'=> CHtml::listData(Empresa::model()->findAll(array('order'=>'ID_EMPRESA')),'ID_EMPRESA','NOMBRE_EMPRESA'),
			            ),
		array(	'header'=>'Cliente',
						'name'=>'ID_CLIENTE',
						'htmlOptions'=>array('width' =>	'25%'),
			),
		array(
			'class'=>'CButtonColumn',
			'header'=>'Opciones',
			'htmlOptions'=>array('width' =>	'10%'),
		),
	),
)); ?>
