<?php
/* @var $this EspecifTecnicasController */
/* @var $model EspecifTecnicas */

$this->breadcrumbs=array(
	'Especif Tecnicases'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Ver EspecifTecnicas', 'url'=>array('index')),
	array('label'=>'Crear EspecifTecnicas', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#especif-tecnicas-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Especif Tecnicases</h1>

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
	'id'=>'especif-tecnicas-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID_ESPEC_TECNICA',
		'ID_EQUIPO',
		'ID_PIEZA',
		'CARACTERISTICA',
		'DESCRIPCION',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
