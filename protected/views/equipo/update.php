<?php
/* @var $this EquipoController */
/* @var $model Equipo */

$this->breadcrumbs=array(
  'Equipos'=>array('admin'),
  $model->ID_EQUIPO=>array('view','id'=>$model->ID_EQUIPO),
  'Modificar',
);

$this->menu=array(
  array('label'=>'Crear Equipo', 'url'=>array('create')),
  array('label'=>'Administrar Equipo', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Modificar Equipo <?php echo $model->ID_EQUIPO." - ".$model->NOMBRE_EQUIPO; ?></h2>



<?php   
  $this->widget('zii.widgets.jui.CJuiTabs',array(
      'tabs'=>array(
        'PASO 1: Modificar Equipo'=> $this->renderPartial('_headerEquipo', array('model' =>$model),true),
        'PASO 2: Crear/Modificar Especificaciones Técnicas' => $this->renderPartial('_detailEspecificaciones', array('model'=>$model, 'new_piezas'=>$new_piezas, 'piezas'=>$piezas, 'especificaciones'=>$especificaciones, 'especif_tec'=>$especif_tec),true),  
      ), 
      'options'=>array(
          'collapsible'=>true,
          'selected'=>1,
      ),
      'htmlOptions'=>array(
        'style'=>'min-width:800px;'
      ),

      'id'=>'MyTabEspTec',
  ));
?>