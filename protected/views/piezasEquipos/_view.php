<?php
/* @var $this PiezasEquiposController */
/* @var $data PiezasEquipos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_PIEZA')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_PIEZA), array('view', 'id'=>$data->ID_PIEZA)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EQUIPO')); ?>:</b>
	<?php echo CHtml::encode($data->ID_EQUIPO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_PIEZA')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_PIEZA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IMAGEN_PIEZA')); ?>:</b>
	<?php echo CHtml::encode($data->IMAGEN_PIEZA); ?>
	<br />


</div>