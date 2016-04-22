<?php
/* @var $this PresupuestoController */
/* @var $model Presupuesto */

$this->breadcrumbs=array(
	'Orden de Trabajo'=>array('admin'),
	'Ver Orden de Trabajo'=>array('view','id'=>$model->ID_OT),
	'Modificar',
);

$this->menu=array(
//	array('label'=>'Presupuesto', 'url'=>array('index')),
	array('label'=>'Crear Orden de Trabajo', 'url'=>array('create'), 'visible'=>Yii::app()->user->JDP()||Yii::app()->user->ADM() || Yii::app()->user->A1()),
	array('label'=>'Ver OT', 'url'=>array('view', 'id'=>$model->ID_OT)),
	array('label'=>'Administrar Orden de Trabajo', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Modificar Orden de Trabajo <?php echo $model->ID_OT." - ".$model->contratista->NOMBRE_CONTRATISTA; ?></h2>

<?php //$this->renderPartial('_form', array('model'=>$model,'items'=>$items,'validateItems'=>$validateItems)); ?>

<?php 	
	$this->widget('zii.widgets.jui.CJuiTabs',array(
   		'tabs'=>array(
   			'PASO 1: Modificar Orden de Trabajo'=> $this->renderPartial('_encabezadoOT', array('model' =>$model),true),
   			'PASO 2: Crear/Modificar Detalle OT ' => $this->renderPartial('_detalleOT', array('model'=>$model, 'new_sub_item'=>$new_sub_item, 'sub_items'=>$sub_items),true),
		  ),																																										//el ppto 			para crear items 			 los items del ppto      para crear sub_items 		los subitems del ppto 
   		'options'=>array(
       		'collapsible'=>true,
       		'selected'=>1,
    	),
 	    'htmlOptions'=>array(
        'style'=>'min-width:1050px;'
    	),

    	'id'=>'MyTabPpto1',
	));
?>