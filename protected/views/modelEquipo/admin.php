<?php
/* @var $this ModelEquipoController */
/* @var $model ModelEquipo */

$this->breadcrumbs=array(
	'Model Equipos'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Ver ModelEquipo', 'url'=>array('index')),
	array('label'=>'Crear ModelEquipo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#model-equipo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Model Equipos</h1>

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
	'id'=>'model-equipo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID_MODELO_EQUIPO',
		'ID_MARCA_EQUIPO',
		'NOMBRE_MODELO_EQUIPO',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
