<?php
/* @var $this RegistroHorometroController */
/* @var $model RegistroHorometro */

$this->breadcrumbs=array(
	'Registro Horómetros'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Ver RegistroHorometro', 'url'=>array('index')),
	array('label'=>'Crear RegistroHorometro', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#registro-horometro-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>Administrar Registros de Horómetros</h2>

<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'registro-horometro-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(	'header'=>'Equipo',
						'name'=>'equipos.NOMBRE_EQUIPO',
						'htmlOptions'=>array('width' =>	'25%'),
			),
		array(	'header'=>'Fecha Registro',
						'name'=>'FECHA_REGISTRO',
						'htmlOptions'=>array('width' =>	'15%'),
			),
		array(	'header'=>'Horometro',
						'name'=>'HOROMETRO',
						'htmlOptions'=>array('width' =>	'15%'),
			),
		array(	'header'=>'Observación',
						'name'=>'OBSERVACION',
						'htmlOptions'=>array('width' =>	'15%'),
			),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
