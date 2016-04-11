<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->breadcrumbs=array(
	'Empresas'=>array('index'),
	$model->NOMBRE_EMPRESA,
);


?>

<h2 class="text-center"><?php echo $model->NOMBRE_EMPRESA; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		'NOMBRE_EMPRESA',
		'RUT_EMPRESA',
		'CASA_MATRIZ',
		'FONO',
		'FAX',
		'PLANTA',
		//'URL_LOGO',
		array(
			'name'=>'',
			'type'=>'raw',
			'value'=>CHtml::image(Yii::app()->baseUrl."/archivos/empresas/".$model->URL_LOGO,'imagen')
			),
	),
)); ?>
