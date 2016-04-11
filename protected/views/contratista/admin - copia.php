<?php
/* @var $this ContratistaController */
/* @var $model Contratista */

$this->breadcrumbs=array(
	'Contratistas'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Ver Contratistas', 'url'=>array('index')),
	array('label'=>'Crear Contratista', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#contratista-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2 class="text-center">Administrar Contratistas</h2>

<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'contratista-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(	'header'=> 'Contratista',
						'name'=>'NOMBRE_CONTRATISTA',
						'value' => 'CHtml::link($data->NOMBRE_CONTRATISTA, array("contratista/view&id=".$data->ID_CONTRATISTA))',
            'type'  => 'raw',
            'htmlOptions'=>array('width' =>	'25%'),
			),		
		array(	'header'=>'Dirección',
						'name'=>'DIRECCION_CONTRATISTA',
						'htmlOptions'=>array('width' =>	'25%'),
			),
		array(	'name'=>'CIUDAD_CONTRATISTA',
						'htmlOptions'=>array('width' =>	'10%'),
			), 
		array(	'name'=>'TELEFONO_CONTRATISTA',
						'htmlOptions'=>array('width' =>	'10%'),
			),
		array(	'name'=>'ENCARGADO',
						'htmlOptions'=>array('width' =>	'10%'),
			),
		array(	'name'=>'AUTORIZADO',
						'value'=>'$data->AUTORIZADO==0? "NO":"SI"',
						'htmlOptions'=>array('width' =>	'10%'),
			),
		array(	'class'=>'CButtonColumn',
						'header'=> 'Opciones',
						'template'=>'{view}{update}{delete}',
						'buttons'=>array(
								'update' => array('visible'=> 'Yii::app()->user->A1()'),
								'delete' => array('visible'=> 'Yii::app()->user->A1()'),
   							),
						'htmlOptions'=>array('width' =>	'10%'),
		),
	),
)); ?>
