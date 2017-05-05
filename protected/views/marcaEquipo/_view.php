<?php
/* @var $this MarcaEquipoController */
/* @var $data MarcaEquipo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_MARCA_EQUIPO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_MARCA_EQUIPO), array('view', 'id'=>$data->ID_MARCA_EQUIPO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_MARCA_EQUIPO')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_MARCA_EQUIPO); ?>
	<br />


</div>