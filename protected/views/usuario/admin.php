<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Ver Usuario', 'url'=>array('index')),
	array('label'=>'Crear Usuario', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->SG()),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#usuario-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2 class="text-center">Administrar Usuarios</h2>

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
	'id'=>'usuario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'NOMBRE_USUARIO',
			'htmlOptions'=>array('style' =>	'text-align:left'),
			),
		array(			
			'name'=>'cODTIPOUSUARIO.NOMBRE_TIPO_USUARIO',
			'htmlOptions'=>array('style' =>	'text-align:left'),
			),
		array(
			'name'=>'RUT_USUARIO',
			'htmlOptions'=>array('style' =>	'text-align:left'),
			),
		array(
			'name'=>'NOMBRE_PERSONA',
			'htmlOptions'=>array('style' =>	'text-align:left'),
			),
		array(
			'name'=>'APELLIDO_PERSONA',
			'htmlOptions'=>array('style' =>	'text-align:left'),
			),
		array(	'header'=>'Opciones',			
						'class'=>'CButtonColumn',
						'template'=>'{view}{update}{delete}',
						'buttons'=>array(
								'update' => array('visible'=> 'Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->SG()'),
								'delete' => array('visible'=> 'Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->SG()'),
   							),
		),
	),
)); ?>
