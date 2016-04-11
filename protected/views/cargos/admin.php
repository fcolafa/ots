<?php
/* @var $this CargosController */
/* @var $model Cargos */

$this->breadcrumbs=array(
	//'Cargoses'=>array('index'),
	'Administrar',
);

$this->menu=array(
	//array('label'=>'Ver Cargos', 'url'=>array('index')),
	array('label'=>'Crear Cargos', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cargos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h2 class="text-center">Administrar Cargos</h2>

<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->
<!--<div class="search-form" style="display:none">
<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
<?php //$this->renderPartial('_search',array(
	//'model'=>$model,
//)); ?>
</div>search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cargos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(	'header'=>'ID Cargo',
						'name'=>'ID_CARGO',
						'htmlOptions'=>array('width' =>	'10%'),
			),
//		array(
//						'name' => 'ID_EMPRESA',
//						'value' => '$data->iDEMPRESA->NOMBRE_EMPRESA',
//			            'header'=>'Empresa',
//			            'htmlOptions'=>array('width' =>	'23%'),
//			            'filter'=> CHtml::listData(Empresa::model()->findAll(array('order'=>'NOMBRE_EMPRESA')),'ID_EMPRESA','NOMBRE_EMPRESA'),
//			        ),

		array(	
						'header'=>'Dependencia',
						'value'=>'@$data->cargos2->NOMBRE_CARGO',
						'htmlOptions'=>array('width' =>	'15%'),
						'filter'=> CHtml::listData(Cargos::model()->findAll(array('order'=>'NOMBRE_CARGO')),'DEPENDENCIA_CARGO','NOMBRE_CARGO'),
			),

		array(	'header'=>'Nombre',
						'name'=>'NOMBRE_CARGO',
						'htmlOptions'=>array('width' =>	'15%'),
			),
		array(	'header'=>'Descripcion',
						'name'=>'DESCRIPCION_CARGO',
						'htmlOptions'=>array('width' =>	'30%'),
			),
		array(
			'class'=>'CButtonColumn',
			'header'=>'Opciones',
			'htmlOptions'=>array('width' =>	'7%'),
		),
	),
)); ?>
