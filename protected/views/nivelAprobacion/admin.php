<?php
/* @var $this NivelAprobacionController */
/* @var $model NivelAprobacion */

$this->breadcrumbs=array(
	'Nivel Aprobacions'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Ver NivelAprobacion', 'url'=>array('index')),
	array('label'=>'Crear NivelAprobacion', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#nivel-aprobacion-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Nivel Aprobacions</h1>

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
	'id'=>'nivel-aprobacion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID_NIVEL_APROB',
		'ID_TIPO_DOC',
		'NOMBRE_NIVEL',
		'NIVEL_APROB',
		'MONTO_APROB',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
