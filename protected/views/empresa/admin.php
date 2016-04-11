<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->breadcrumbs=array(
	//'Empresas'=>array('index'),
	'Administrar',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#empresa-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2 class="text-center">Administrar Empresas</h2>

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
	'id'=>'empresa-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
//		array(
//			'name'=>'NOMBRE_EMPRESA',
//			'htmlOptions'=>array('width' =>	'30%'),
//			),
		array(
			'name'=>'RUT_EMPRESA',
			'htmlOptions'=>array('width' =>	'10%'),
			),
		array(
			'name'=>'CASA_MATRIZ',
			'htmlOptions'=>array('width' =>	'30%'),
			),
		array(
			'name'=>'CIUDAD',
			'htmlOptions'=>array('width' =>	'10%'),
			),
		array(
			'name'=>'FONO',
			'htmlOptions'=>array('width' =>	'10%'),
			),
		/*
		'PLANTA',
		'URL_LOGO',
		*/
		array(	'class'=>'CButtonColumn',
						'template'=>'{view}{update}',
						'buttons'=>array(
											'update' => array('visible'=> 'Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->SG()'),
			   							),
						'htmlOptions'=>array('width' =>	'10%'),
		),
	),
)); ?>
