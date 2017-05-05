<?php
/* @var $this ModelEquipoController */
/* @var $data ModelEquipo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_MODELO_EQUIPO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_MODELO_EQUIPO), array('view', 'id'=>$data->ID_MODELO_EQUIPO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_MARCA_EQUIPO')); ?>:</b>
	<?php echo CHtml::encode($data->ID_MARCA_EQUIPO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_MODELO_EQUIPO')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_MODELO_EQUIPO); ?>
	<br />


</div>