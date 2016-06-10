<?php
/* @var $this CotizacionController */
/* @var $model Cotizacion */

$this->breadcrumbs=array(
	$model->ID_COTIZACION,
);

$this->menu=array(
	array('label'=>' volver', 'url'=>array('ordenTrabajo/view','id'=>$model->ID_OT)),
	array('label'=>' Aprobar Cotización', 'url'=>array('approveCot','id'=>$model->ID_COTIZACION)),);
?>


<h1> Cotizacion #<?php echo $model->ID_COTIZACION.' '.$model->NOMBRE_ARCHIVO; ?></h1>

<?php echo $model->getFile($model->ID_COTIZACION); ?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'NOMBRE_ARCHIVO',
		'COMENTARIOS_COTIZACION',
		array(
                    'header'=>'Estado',
                    'value'=>($model->DEF_COT=1)?"Aprobado":"No Figura",
                    
                )
	),
)); ?>
