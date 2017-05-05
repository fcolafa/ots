<?php
/* @var $this EquipoController */
/* @var $model Equipo */

$this->breadcrumbs=array(
	'Equipos'=>array('index'),
	'Administrar',
);

$this->menu=array(	
	array('label'=>'Crear Equipos', 'url'=>array('create')),
	array('label'=>'Registrar Horómetros', 'url'=>array('registroHorometro/create')),
	array('label'=>'Registrar Mantenciones', 'url'=>array('registroMantencion/create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#equipo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2 class="text-center">Administrar Equipos</h2>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'equipo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(

		array(	'header'=>'Nro Equipo',
						'name'=>'NUMERO_EQUIPO',
						'htmlOptions'=>array('width' =>	'5%'),
			),
		array(	'header'=>'Equipo',
						'name'=>'NOMBRE_EQUIPO',
						'htmlOptions'=>array('width' =>	'30%'),
			),
		array(	'header'=>'Frecuencia Mantención ',
						'name'=>'TIEMPO_MANTENCION',
						'htmlOptions'=>array('width' =>	'10%'),
			),
		array(	'header'=>'Última Mantención',
						'name'=>'ULTIMA_MANTENCION',
						'htmlOptions'=>array('width' =>	'10%'),
			),
		array(	'header'=>'Horómetro Mantenc.',
						'name'=>'HOROMETRO_MANTENCION',
						'htmlOptions'=>array('width' =>	'10%'),
			),
		array(	'header'=>'Fecha Horómetro',
						'name'=>'ULTIMO_REGISTRO',
						'htmlOptions'=>array('width' =>	'10%'),
			),
		array(	'header'=>'Último Horóm.',
						'name'=>'ULTIMO_HOROMETRO',
						'htmlOptions'=>array('width' =>	'10%'),
			),
		array(	'header'=>'Diferencia',
						'value' => '@$data->HOROMETRO_MANTENCION + @$data->TIEMPO_MANTENCION - @$data->ULTIMO_HOROMETRO',
						'htmlOptions'=>array('width' =>	'8%'),
			),


		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
