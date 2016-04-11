<?php
/* @var $this TipoUsuarioController */
/* @var $model TipoUsuario */

$this->breadcrumbs=array(
	'Tipo Usuarios'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Ver Tipo Usuario', 'url'=>array('index')),
	array('label'=>'Crear Tipo Usuario', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tipo-usuario-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2 class="text-center">Administrar Tipo Usuario</h2>

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
	'id'=>'tipo-usuario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'COD_TIPO_USUARIO',
			'htmlOptions'=>array('style' =>	'text-align:center'),
			),
		array(
			'name'=>'NOMBRE_TIPO_USUARIO',
			'htmlOptions'=>array('style' =>	'text-align:center'),
			),
		array(
			'name'=>'DESCRIPCION_TIPO_USUARIO',
			'htmlOptions'=>array('style' =>	'text-align:center'),
			),

		array(	'class'=>'CButtonColumn',
						'header'=>'Opciones',
						'template'=>'{view}{update}{delete}',
						'buttons'=>array(
								'update' => array('visible'=> 'Yii::app()->user->A1()'),
								'delete' => array('visible'=> 'Yii::app()->user->A1()'),
   							),
		),
	),
)); ?>
