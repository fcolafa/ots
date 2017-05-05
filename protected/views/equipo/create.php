<?php
/* @var $this EquipoController */
/* @var $model Equipo */

$this->breadcrumbs=array(
	'Administrar Equipos'=>array('admin'),
	'Crear',
);

$this->menu=array(
  array('label'=>'Ver Equipos', 'url'=>array('admin')),
  array('label'=>'Registrar Horómetros', 'url'=>array('registroHorometro/create')),
  array('label'=>'Registrar Mantenciones', 'url'=>array('registroMantencion/create')),
);
?>

<h2 class="text-center">Crear Equipo</h2>

<?php //$this->renderPartial('_form', array('model'=>$model)); ?>

<?php 	
	$this->widget('zii.widgets.jui.CJuiTabs',array(
   		'tabs'=>array(
   			'PASO 1: Crear Equipo'=> $this->renderPartial('_headerEquipo', array('model' =>$model),true),
   			'PASO 2: Ingresar Especificaciones ' => $this->renderPartial('_emptyEquipo', array('model'=>$model),true),
		  ),
   		'options'=>array(
       		'collapsible'=>true,
       		'disabled' => 1,
    	),
 	    'htmlOptions'=>array(
                  'style'=>'width:100%;'
        
    	),

    	'id'=>'MyTabEquipo',
	));
?>