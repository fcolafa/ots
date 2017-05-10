<?php
/* @var $this PersonalController */
/* @var $model Personal */

$this->breadcrumbs=array(
	//'Personals'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Ver Personal', 'url'=>array('index')),
	array('label'=>'Crear Personal', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#personal-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h2 class="text-center">Administrar Personal</h2>
<div id="statusMsg">
	<?php if(Yii::app()->user->hasFlash('success')):?>
	        <?php echo Yii::app()->user->getFlash('success'); ?>
	<?php endif; ?>
	 
	<?php if(Yii::app()->user->hasFlash('error')){ ?>
	        <?php echo Yii::app()->user->getFlash('error'); ?>
	<?php } ?>
</div>
<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->

<div class="search-form" style="display:none">
	<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'personal-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID_PERSONA',
		array(
                    'name' => 'ID_EMPRESA',
                    'value' => '$data->iDEMPRESA->NOMBRE_EMPRESA',
                    'header'=>'Empresa',
                    'visible'=>  Yii::app()->user->A1(),
                    'filter'=> CHtml::listData(Empresa::model()->findAll(array('order'=>'ID_EMPRESA')),'ID_EMPRESA','NOMBRE_EMPRESA'),
                ),
		'RUT_PERSONA',
		'NOMBRE_PERSONA',
		'APELLIDO_PERSONA',
		'TELEFONO',
                    array(
                        'name'=>'DEBAJA',
                        'value'=>'$data->DEBAJA==1?"eliminado":"activo"',
                        'filter'=>array(0=>'Activo',1=>'eliminado'),
                        'visible'=>'Yii::app()->user->A1()',
                    ),
		/*
		'EMAIL',
		'ID_CARGO',
		'ID_DEPARTAMENTO',
		'ES_SUPERVISOR',
		'COD_TIPO_USUARIO',
		'CONTRASENA',
		'NIVEL_APROBACION',
		'MONTO_APROBACION',
		'ESTADO_TRABAJADOR',
		*/
		array(
			'class'=>'CButtonColumn',
			'afterDelete'=>'function(link,success,data){ 
				if(success){
					$("#statusMsg").html(data);
					$("#statusMsg .alert-danger, .alert-success").animate({opacity: 1.0}, 3000).fadeOut("slow");
				} 
			}',
		),
	),
)); ?>