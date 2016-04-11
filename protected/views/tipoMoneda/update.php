<?php
/* @var $this TipoMonedaController */
/* @var $model TipoMoneda */

$this->breadcrumbs=array(
	'Tipo Monedas'=>array('index'),
	$model->ID_TIPO_MONEDA=>array('view','id'=>$model->ID_TIPO_MONEDA),
	'Modificar',
);

$this->menu=array(
	array('label'=>' TipoMoneda', 'url'=>array('index')),
	array('label'=>'Crear TipoMoneda', 'url'=>array('create')),
	array('label'=>'Ver TipoMoneda', 'url'=>array('view', 'id'=>$model->ID_TIPO_MONEDA)),
	array('label'=>'Administrar TipoMoneda', 'url'=>array('admin')),
);
?>

<h1>Modificar TipoMoneda <?php echo $model->ID_TIPO_MONEDA; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>