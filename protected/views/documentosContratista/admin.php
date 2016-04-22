<?php
/* @var $this DocumentosContratistaController */
/* @var $model DocumentosContratista */

$this->breadcrumbs=array(
	'Administrar',
);

$this->menu=array(
	//array('label'=>'Ver Documentos Contratista', 'url'=>array('index')),
	array('label'=>'Crear Documentos Contratista', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#DocumentosContratista-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2 class="text-center">Administrar Documentos Contratistas</h2>
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
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'DocumentosContratista-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID_DOCUMENTO',
		'NOMBRE_DOCUMENTO',
		'DESCRIPCION',
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
