<?php
/* @var $this CotizacionController */
/* @var $data Cotizacion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_COTIZACION')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_COTIZACION), array('view', 'id'=>$data->ID_COTIZACION)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_ARCHIVO')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_ARCHIVO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_OT')); ?>:</b>
	<?php echo CHtml::encode($data->ID_OT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COMENTARIOS_COTIZACION')); ?>:</b>
	<?php echo CHtml::encode($data->COMENTARIOS_COTIZACION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEF_COT')); ?>:</b>
	<?php echo CHtml::encode($data->DEF_COT); ?>
	<br />


</div>