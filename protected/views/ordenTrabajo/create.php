<?php
/* @var $this OrdenTrabajoController */
/* @var $model Orden de Trabajo */

$this->breadcrumbs=array(
	'Orden de Trabajo'=>array('admin'),
	'Crear',
);

$this->menu=array(
//	array('label'=>'Ver Orden de Trabajo', 'url'=>array('index')),
	array('label'=>'Administrar Orden de Trabajo', 'url'=>array('admin')),
	);
?>

<h2 class="text-center">Crear Orden de Trabajo</h2>

<?php // $this->renderPartial('_form', array('model'=>$model,'items'=>$items,'validateItems'=>$validateItems)); ?>

<?php 	
	$this->widget('zii.widgets.jui.CJuiTabs',array(
   		'tabs'=>array(
   			'PASO 1: Crear Orden de Trabajo'=> $this->renderPartial('_encabezadoOT', array('model' =>$model),true),
   			'PASO 2: Crear Items y Subitems ' => $this->renderPartial('_detalleOTVacia', array('model'=>$model),true),
		  ),
   		'options'=>array(
       		'collapsible'=>true,
       		'disabled' => 1,
    	),
 	    'htmlOptions'=>array(
        'style'=>'min-width:1000px;'
    	),

    	'id'=>'MyTabOTs',
	));
?>

