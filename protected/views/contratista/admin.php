<?php
/* @var $this ContratistaController */
/* @var $model Contratista */

$this->breadcrumbs=array(
	'Contratistas'=>array('index'),
	'Administrar',
);

$this->menu=array(
	
	array('label'=>'Crear Contratista', 'url'=>array('create')),
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

<h1>Administrar Contratistas</h1>

<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->
<?php //echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
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
		'ID_CONTRATISTA',
		array(
                    'name' => 'ID_EMPRESA',
                    'value' => '$data->empresa->NOMBRE_EMPRESA',
                    'header'=>'Empresa',
                    'visible'=>  Yii::app()->user->allCompany(),
                    'filter'=> CHtml::listData(Empresa::model()->findAll(array('order'=>'ID_EMPRESA')),'ID_EMPRESA','NOMBRE_EMPRESA'),
			        ),
		'NOMBRE_CONTRATISTA',
		'RUT_CONTRATISTA',
		'DIRECCION_CONTRATISTA',
		'CIUDAD_CONTRATISTA',
            
		/*
		'TELEFONO_CONTRATISTA',
		'GIRO_AREA',
		'ENCARGADO',
		'AUTORIZADO',
		*/
		array(	'class'=>'CButtonColumn',
					'template'=>'{view}{update}{delete}',
					'header'=>'Opciones',
					'buttons'=>array(
					/*	'more' => array(
							'label' => 'Mas',
							'options' => array('class'=>'mas_icon', 'prevent'=>'default'),
							'click' => 'js:function() { return false;}',
							'imageUrl'=>Yii::app()->theme->baseUrl.'/img/plus.png',
						),*/
						//'update' => array('visible'=> '$data->VOBO_GERENTE_GRAL!=1&&(Yii::app()->user->LOG()||Yii::app()->user->A1() || Yii::app()->user->ADM() || Yii::app()->user->GG() || Yii::app()->user->GOP() || Yii::app()->user->JDP())'),
						'delete' => array('visible'=> 'Yii::app()->user->A1()'),
						),),
	),
)); ?>
